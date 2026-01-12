<?php

namespace App\Http\Controllers\WebControllers;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Exercise;
use App\Models\User;
use App\Models\Patient;
use App\Models\Allergy;
use App\Models\Symptom;
use App\Models\ExercisePatient;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Notas:
     * Este controlador é só para o ADMIN. Aqui tem as views quando o admin está logado, e só o admin pode ver.
     * Muitas das questies são feitas com o eloquent, e são subentendidas.
     * validatePatientUser($patientId) Função que valida se o patient existe, e retorna user com a relação de paciente já carregada.
     * Informação importante, o Laravel consegue atraves de metodos mágicos encontrar propriedades nas relações, se não existir
     */

    public function dashboard()
    {
        $todayAppointments = Appointment::whereDate('appointment_date_time', today())
            ->orderBy('appointment_date_time', 'asc')
            ->get();
        
        $pendingAppointments = Appointment::where('status', 'Pendente')
            ->where('appointment_date_time', '>=', now()->startOfDay())
            ->orderBy('appointment_date_time', 'asc')
            ->paginate(10);
        
        $newUsers = User::where('created_at', '>=', now()->subDays(30))
            ->orderByDesc('created_at')
            ->get();
        
        $newUsersCount = $newUsers->count();
        $pendingAppointmentsCount = Appointment::where('status', 'Pendente')
            ->where('appointment_date_time', '>=', now()->startOfDay())
            ->count();
        
        return view('admin.dashboard', [
            'pendingAppointments' => $pendingAppointments,
            'pendingAppointmentsCount' => $pendingAppointmentsCount,
            'todayAppointments' => $todayAppointments,
            'newUsers' => $newUsers,
            'newUsersCount' => $newUsersCount,
        ]);
    }

    /**
     * Controlador da View de todos os pacientes da clinica
     */
    public function patients()
    {
        //Query com o user porque preciso dos dados do user. 
        $patients = User::where('role_id', 3) 
            ->with('patient')
            ->orderBy('name', 'asc')
            ->orderBy('surname', 'asc')
            ->paginate(20);
        
        return view('admin.patients.index', [
            'patients' => $patients,
        ]);
    }

    /**
     * Controlador da da View dos detalhes de um paciente
     */
    public function patientDetail($patientId)
    {
        $user = $this->validatePatientUser($patientId);
        
        //Estrutura de deccisão, verifica se tem subscrição, se sim, compara à data atual, se a data atua for > que o expiring_subscrition_Date, dá update para false.
        if ($user->has_subscription) {
            if (now()->isAfter($this->expiring_subscription_date)) {
                $this->update([
                    'has_subscription' => false,
                    'expiring_subscription_date' => null,
                ]);
            }
        }
        
        $user->patient->load('appointments', 'conditions', 'allergies', 'exercises', 'diagnostics', 'treatmentGoals', 'weightTrackings', 'nutritionalGoals', 'progressNotes');
        
        
        $nextAppointment = $user->patient->appointments()
            ->where('status', 'Confirmado')
            ->where('appointment_date_time', '>=', now())
            ->orderBy('appointment_date_time', 'asc')
            ->first();
        
        
        $allergies = Allergy::orderBy('allergen', 'asc')->get();
    
        
        return view('admin.patients.detail', [
            'patient' => $user,
            'patientData' => $user->patient,
            'nextAppointment' => $nextAppointment,
            'allergies' => $allergies,
        ]);
    }


    /**
     * Controlador da da View dos das consultas de um paciente
     */
    public function patientAppointments($patientId)
    {
        $user = $this->validatePatientUser($patientId);
        $appointments = $user ->patient->appointments()->orderByDesc('appointment_date_time')->get();
        
        return view('admin.patients.appointments', [
            'patient' => $user ,
            'appointments' => $appointments,
        ]);
    }

    /**
     * Controlador da criar appointment for patient
     */
    public function storePatientAppointment($patientId)
    {
        $user = $this->validatePatientUser($patientId);
        
        $validated = request()->validate([
            'appointment_date' => [
                'required',
                'date_format:Y-m-d',
                'after_or_equal:' . now()->addDay()->format('Y-m-d'),
            ],
            'appointment_time' => [
                'required',
                'in:09,10,11,12,13,14,15,16,17',
            ],
            'type' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);
        
        //String manipulation. Juntar date + time, porque na base de dados é esperado dateTime
        $appointmentDateTime = $validated['appointment_date'] . ' ' . $validated['appointment_time'] . ':00:00';
        
        $data = [
            'patient_id' => $user->patient->id,
            'appointment_date_time' => $appointmentDateTime,
            'status' => 'Confirmado',
            'type' => $validated['type'],
            'notes' => $validated['notes'],
        ];
        
        Appointment::create($data);
        
        return redirect()->route('admin.patient.appointments', $patientId);
    }

    /**
     * Controlador de Editar uma consulta
     */
    public function updatePatientAppointment($patientId, $appointmentId)
    {
        $user = $this->validatePatientUser($patientId);
        $appointment = Appointment::findOrFail($appointmentId);
        
        if ($appointment->patient_id !== $user->patient->id) {
            abort(403, 'Acesso negado');
        }
        
        $validated = request()->validate([
            'appointment_date' => 'required|date_format:Y-m-d',
            'appointment_time' => 'required|in:09,10,11,12,13,14,15,16,17',
            'type' => 'nullable|string|max:255',
            'duration' => 'nullable|integer|min:1',
            'status' => 'required|in:Pendente,Confirmado,Cancelado,Concluído',
            'notes' => 'nullable|string',
        ]);
        
        //String manipulation. Juntar date + time, porque na base de dados é esperado dateTime. FAZ FUNÇÃO
        $appointmentDateTime = $validated['appointment_date'] . ' ' . $validated['appointment_time'] . ':00:00';
        
        $appointment->update([
            'appointment_date_time' => $appointmentDateTime,
            'type' => $validated['type'],
            'duration' => $validated['duration'],
            'status' => $validated['status'],
            'notes' => $validated['notes'],
        ]);
        
        return redirect()->route('admin.patient.appointments', $patientId);
    }

    /**
     * Controlador da View do diagnosticos do paciente
     */
    public function patientDiagnostics($patientId)
    {
        $user = $this->validatePatientUser($patientId);
        $diagnostics = $user->patient->diagnostics()->with('symptoms', 'treatments')->orderByDesc('diagnostic_date')->get();
        //Sintomas, para eu depois se quiser adicionar na página
        $symptoms = Symptom::orderBy('name', 'asc')->get();
        
        return view('admin.patients.diagnostics', [
            'patient' => $user,
            'diagnostics' => $diagnostics,
            'symptoms' => $symptoms,
        ]);
    }

    /**
     * Controlador de adicionar um diagnostico a um paciente
     */
    public function storePatientDiagnostic($patientId)
    {
        $user = $this->validatePatientUser($patientId);
        
        $validated = request()->validate([
            'diagnostic_date' => 'required|date_format:Y-m-d',
            'western_diagnosis' => 'nullable|string|max:255',
            'tcm_diagnosis' => 'nullable|string|max:255',
            'severity' => 'nullable|string|max:255',
            'pulse_quality' => 'nullable|string|max:255',
            'tongue_description' => 'nullable|string',
        ]);
        
        
        $diagnostic = $user->patient->diagnostics()->create($validated);
        
        return redirect()->route('admin.patient.diagnostics', $patientId);;
    }

    /**
     * Controlador de adicionar um sintoma a um diagnostico de um paciente
     */
    public function addSymptomToDiagnostic($patientId, $diagnosticId)
    {
        $user = $this->validatePatientUser($patientId);
        $diagnostic = $user->patient->diagnostics()->findOrFail($diagnosticId);
        
        $validated = request()->validate([
            'symptom_id' => 'required|exists:symptoms,id',
        ]);
        
        
        $exists = $diagnostic->symptoms()
            ->where('symptom_id', $validated['symptom_id'])
            ->exists();
        
        if ($exists) {
            return redirect()->route('admin.patient.diagnostics', $patientId);
        }
        
        $diagnostic->symptoms()->attach($validated['symptom_id']);
        
        return redirect()->route('admin.patient.diagnostics', $patientId);
    }

    /**
     * Controlador de remover um sintoma d eum dianostico
     */
    public function removeSymptomFromDiagnostic($patientId, $diagnosticId, $symptomId)
    {
        $user = $this->validatePatientUser($patientId);
        $diagnostic = $user->patient->diagnostics()->findOrFail($diagnosticId);
        $diagnostic->symptoms()->detach($symptomId);
        
        return redirect()->route('admin.patient.diagnostics', $patientId);
    }

    /**
     * Controlador de adicionar um tratamento a um diagnostico
     */
    public function addTreatmentToDiagnostic($patientId, $diagnosticId)
    {
        $user = $this->validatePatientUser($patientId);
        $diagnostic = $user->patient->diagnostics()->findOrFail($diagnosticId);
        
        $validated = request()->validate([
            'session_date_time' => 'nullable|date_format:Y-m-d\TH:i',
            'treatment_methods' => 'nullable|string',
            'acupoints_used' => 'nullable|string',
            'duration' => 'nullable|integer|min:1',
            'next_session' => 'nullable|date_format:Y-m-d',
            'notes' => 'nullable|string',
        ]);
        
        // dd($validated['session_date_time'])
        if ($validated['session_date_time']) {
            $validated['session_date_time'] = str_replace('T', ' ', $validated['session_date_time']) . ':00';
        }
        
        $diagnostic->treatments()->create([
            'patient_id' => $user->patient->id,
            'session_date_time' => $validated['session_date_time'],
            'treatment_methods' => $validated['treatment_methods'],
            'acupoints_used' => $validated['acupoints_used'],
            'duration' => $validated['duration'],
            'next_session' => $validated['next_session'],
            'notes' => $validated['notes'],
        ]);
        
        return redirect()->route('admin.patient.diagnostics', $patientId);
    }

    /**
     * Controlador de remover um tratamento de um diagnostico
     */
    public function removeTreatmentFromDiagnostic($patientId, $diagnosticId, $treatmentId)
    {
        $user = $this->validatePatientUser($patientId);
        $diagnostic = $user->patient->diagnostics()->findOrFail($diagnosticId);
        $treatment = $diagnostic->treatments()->findOrFail($treatmentId);
        $treatment->delete();
        
        return redirect()->route('admin.patient.diagnostics', $patientId);
    }

    /**
     * Controlador de mostrar todos os exercicios de um paciente
     */
    public function patientExercises($patientId)
    {
        $user = $this->validatePatientUser($patientId);
        $exercises = $user->patient->exercises()->orderByDesc('pivot_prescribed_date')->get();
        $allExercises = Exercise::orderBy('name', 'asc')->get();
        
        return view('admin.patients.exercises', [
            'patient' => $user,
            'exercises' => $exercises,
            'allExercises' => $allExercises,
        ]);
    }

    /**
     * Controlador de dar attach de um exercicio a um paciente
     */
    public function attachPatientExercise($patientId)
    {
        $user = $this->validatePatientUser($patientId);
        
        $validated = request()->validate([
            'exercise_id' => 'required|exists:exercises,id',
            'prescribed_date' => 'required|date_format:Y-m-d',
            'frequency' => 'nullable|string|max:255',
            'target_number' => 'required|integer|min:1',
            'status' => 'required|in:Em progresso,Concluído,Cancelado',
            'notes' => 'nullable|string',
        ]);
        
        //Verificação para ver se o exercicio passado, já está atribuido.
        $exists = $user->patient->exercises()
            ->where('exercise_id', $validated['exercise_id'])
            ->wherePivotNull('deleted_at')
            ->exists();
        
        //Return mais cedo
        if ($exists) {
            return redirect()->route('admin.patient.exercises', $patientId);
        }
        
        //Adicionar à tabela pivot os dados, (acutal Number e compliance rate default 0)
        ExercisePatient::create([
            'patient_id' => $user->patient->id,
            'exercise_id' => $validated['exercise_id'],
            'prescribed_date' => $validated['prescribed_date'],
            'frequency' => $validated['frequency'],
            'target_number' => $validated['target_number'],
            'actual_number' => 0,
            'compliance_rate' => 0,
            'status' => $validated['status'],
            'notes' => $validated['notes'],
        ]);
        
        return redirect()->route('admin.patient.exercises', $patientId);
    }

    /**
     * Controlador de mostrar os objetivos de saude do paciente
     */
    public function patientObjectives($patientId)
    {
        $user = $this->validatePatientUser($patientId);
        $objectives = $user->patient->treatmentGoals()->with('goalMilestones')->orderByDesc('created_at')->get();
        
        return view('admin.patients.objectives', [
            'patient' => $user,
            'objectives' => $objectives,
        ]);
    }

    /**
     * controlador de criar um objetivo para o paciente
     */
    public function storePatientObjective($patientId)
    {
        $user = $this->validatePatientUser($patientId);
        
        $validated = request()->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:Mínima,Média,Alta',
            'status' => 'required|in:Em progresso,Concluído,Cancelado',
            'target_date' => 'nullable|date_format:Y-m-d',
            'treatment_methods' => 'nullable|string|max:255',
        ]);
        
        $user->patient->treatmentGoals()->create($validated);
        
        return redirect()->route('admin.patient.objectives', $patientId);
    }

    /**
     * Controlador de adicionar uma meta para o objetivo do paciente
     */
    public function storeGoalMilestone($patientId, $objectiveId)
    {
        $user = $this->validatePatientUser($patientId);
        $objective = $user->patient->treatmentGoals()->findOrFail($objectiveId);
        
        $validated = request()->validate([
            'description' => 'required|string',
            'target_date' => 'required|date_format:Y-m-d',
        ]);
        
        $objective->goalMilestones()->create($validated);
        
        return redirect()->route('admin.patient.objectives', $patientId);
    }

    /**
     * Toggle milestone completion
     */
    public function toggleMilestoneCompletion($patientId, $milestoneId)
    {
        $user = $this->validatePatientUser($patientId);
        $milestone = \App\Models\GoalMilestone::findOrFail($milestoneId);
        
        // Verificação se o treatmentGoal é o mesmo do id do paciente.
        $objective = $milestone->treatmentGoal;
        if ($objective->patient_id !== $user->patient->id) {
            abort(403, 'Acesso negado');
        }
        
        $milestone->update([
            'completed' => !$milestone->completed,
            'completion_date' => !$milestone->completed ? now()->format('Y-m-d') : null,
        ]);
        
        return redirect()->route('admin.patient.objectives', $patientId);
    }

    /**
     *  Controlador de ver as notas de progresso de um cliente
     */
    public function patientProgressNotes($patientId)
    {
        $user = $this->validatePatientUser($patientId);
        $progressNotes = $user->patient->progressNotes()->orderByDesc('note_date')->get();
        
        return view('admin.patients.progress-notes', [
            'patient' => $user,
            'progressNotes' => $progressNotes,
        ]);
    }

    /**
     * Controlador de criar uma nota de progresso
     */
    public function storeProgressNote($patientId)
    {
        $user = $this->validatePatientUser($patientId);
        
        $validated = request()->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'subjective' => 'nullable|string',
            'objective' => 'nullable|string',
            'assessment' => 'nullable|string',
            'plan' => 'nullable|string',
        ]);
        
        // Verificação se o appointment patient_id é o mesmo que o patient id passado
        $appointment = Appointment::findOrFail($validated['appointment_id']);
        if ($appointment->patient_id !== $user->patient->id) {
            abort(403, 'Acesso negado');
        }
        
        $user->patient->progressNotes()->create([
            'appointment_id' => $validated['appointment_id'],
            'note_date' => now()->format('Y-m-d'),
            'subjective' => $validated['subjective'],
            'objective' => $validated['objective'],
            'assessment' => $validated['assessment'],
            'plan' => $validated['plan'],
        ]);
        
        return redirect()->route('admin.patient.appointments', $patientId);
    }

    /**
     * Controlador de criar condição num paciente
     */
    public function storePatientCondition($patientId)
    {
        $user = $this->validatePatientUser($patientId);
        
        $validated = request()->validate([
            'name' => 'required|string|max:255',
            'diagnosed_date' => 'required|date_format:Y-m-d',
            'status' => 'nullable|string|max:255',
        ]);
        
        $user->patient->conditions()->create($validated);
        
        return redirect()->route('admin.patient.detail', $patientId);
    }

    /**
     * Controlador de criar alergia num paciente
     */
    public function storePatientAllergy($patientId)
    {
        $user = $this->validatePatientUser($patientId);
        
        $validated = request()->validate([
            'allergy_id' => 'required|exists:allergies,id',
        ]);
        
        // verificação para ver se o paciente já tem a alergia.
        $exists = $user->patient->allergies()
            ->where('allergy_id', $validated['allergy_id'])
            ->exists();
        
        if ($exists) {
            return redirect()->route('admin.patient.detail', $patientId);
        }
        
        $user->patient->allergies()->attach($validated['allergy_id']);
        
        return redirect()->route('admin.patient.detail', $patientId);
    }

    /**
     * Controlador de eliminar condição de um paciente
     */
    public function deletePatientCondition($patientId, $conditionId)
    {
        $user = $this->validatePatientUser($patientId);
        $condition = $user->patient->conditions()->findOrFail($conditionId);
        $condition->delete();
        
        return redirect()->route('admin.patient.detail', $patientId);
    }

    /**
     * Controlador de eliminar alergia de um paciente
     */
    public function deletePatientAllergy($patientId, $allergyId)
    {
        $user = $this->validatePatientUser($patientId);
        $user->patient->allergies()->detach($allergyId);
        
        return redirect()->route('admin.patient.detail', $patientId);
    }

    /**
     * Controlador de adcionar uma subscrição a um paciente
     */
    public function addPatientSubscription($patientId)
    {
        $user = $this->validatePatientUser($patientId);
        
        $validated = request()->validate([
            'subscription_months' => 'required|in:1,3',
        ]);

        // Parse para int, porque subscription_months vem em string
        $months = (int)$validated['subscription_months'];
        // Calcular o expiringDate com base da data atual + os meses $months
        $expiringDate = now()->addMonths($months)->format('Y-m-d');
        // Operador ternario para ver se for 1 mes -> Plano de Transformação, se não for Programa completo (Provavelmente tenta adicionar um if, para dar no futuro mais planoss)
        $planType = $months === 1 ? 'Plano Transformação' : 'Programa Completo';
        
        $user->patient->update([
            'has_subscription' => true,
            'expiring_subscription_date' => $expiringDate,
            'plan_type' => $planType,
        ]);
        
        return redirect()->route('admin.patient.detail', $patientId);
    }

    /**
     * Controlador de remover uma subscrição a um paciente
     */
    public function removePatientSubscription($patientId)
    {
        $user = $this->validatePatientUser($patientId);
        
        // Se removida, tudo a null
        $user->patient->update([
            'has_subscription' => false,
            'expiring_subscription_date' => null,
        ]);
        
        return redirect()->route('admin.patient.detail', $patientId);
    }

    /**
     * Controlador da view de Controlo de saude de um paciente 
     */
    public function patientHealthControl($patientId)
    {
        $user = $this->validatePatientUser($patientId);
        $weightTrackings = $user->patient->weightTrackings()->orderByDesc('created_at')->get();
        $dailyNutrition = $user->patient->dailyNutritions()->orderByDesc('created_at')->paginate(15);
        
        return view('admin.patients.health-control', [
            'patient' => $user,
            'weightTrackings' => $weightTrackings,
            'dailyNutrition' => $dailyNutrition,
        ]);
    }

    /**
     * Controlador Geral da view de exercicios
     */
    public function exercises()
    {

        $exercises = Exercise::orderBy('name', 'asc')->get();
        
        return view('admin.exercises.index', [
            'exercises' => $exercises,
        ]);
    }

    /**
     * Controlador geral de criar exercicios
     */
    public function storeExercise()
    {
        $validated = request()->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string|max:255',
            'difficulty_level' => 'required|in:Fácil,Moderado,Difícil',
            'instructions' => 'nullable|string',
            'benefits' => 'nullable|string',
            'precautions' => 'nullable|string',
            'video_url' => 'nullable|url',
            'image_url' => 'nullable|url',
        ]);
        
        Exercise::create($validated);
        
        return redirect()->route('admin.exercises');
    }

    /**
     * Controlador geral de eliminar exercicios
     */
    public function deleteExercise($exerciseId)
    {
        $exercise = Exercise::findOrFail($exerciseId);
        $exercise->delete();
        
        return redirect()->route('admin.exercises');
    }

    /**
     * Controlador geral de mostrar todos os appointments (Hoje, Pendentes e Completos)
     */
    public function appointments()
    {
        
        //Hoje
        $todayAppointments = Appointment::whereDate('appointment_date_time', today())
            ->orderBy('appointment_date_time', 'asc')
            ->get();
        
        // Pendentes
        $pendingAppointments = Appointment::where('status', 'Pendente')
            ->where('appointment_date_time', '>=', now()->startOfDay())
            ->orderBy('appointment_date_time', 'asc')
            ->get();
        
        // Completos
        $completedAppointments = Appointment::where('status', 'Concluído')
            ->where('appointment_date_time', '<=', now()->endOfDay())
            ->orderByDesc('appointment_date_time')
            ->paginate(10);
        
        return view('admin.appointments.index', [
            'todayAppointments' => $todayAppointments,
            'pendingAppointments' => $pendingAppointments,
            'completedAppointments' => $completedAppointments,
        ]);
    }


    /**
     * Controlador Geral da view de Pacientes com planos
     */
    public function clientsWithPlan()
    {
        $clients = Patient::where('has_subscription', true)
            ->with('user')
            ->orderBy('user_id')
            ->paginate(20);
        
        return view('admin.clients-with-plan.index', [
            'clients' => $clients,
        ]);
    }

    /**
     * Controlador Geral da view de Sintomas.
     */
    public function symptoms()
    {
        $symptoms = Symptom::orderBy('name', 'asc')->get();
        
        return view('admin.symptoms.index', [
            'symptoms' => $symptoms,
        ]);
    }

    /**
     * Controlador Geral de adicionar de Sintomas.
     */
    public function storeSymptom()
    {
        $validated = request()->validate([
            'name' => 'required|string|max:255|unique:symptoms,name',
            'description' => 'nullable|string',
        ]);
        
        Symptom::create($validated);
        
        return redirect()->route('admin.symptoms')->with('success', 'Sintoma criado com sucesso!');
    }

    /**
     * Controlador Geral de remover de Sintomas.
     */
    public function deleteSymptom($symptomId)
    {
        $symptom = Symptom::findOrFail($symptomId);
        $symptom->delete();
        
        return redirect()->route('admin.symptoms');
    }

    /**
     * Controlador Geral da view de  Alergias.
     */
    public function allergies()
    {
  
        $allergies = Allergy::orderBy('allergen', 'asc')->get();
        
        return view('admin.allergies.index', [
            'allergies' => $allergies,
        ]);
    }

    /**
     * Controlador Geral de criar uma Alergia
     */
    public function storeAllergy()
    {
        $validated = request()->validate([
            'allergen' => 'required|string|max:255|unique:allergies,allergen',
            'description' => 'nullable|string',
        ]);
        
        Allergy::create($validated);
        
        return redirect()->route('admin.allergies');
    }

    /**
     * Controlador Geral de eliminar uma Alergia
     */
    public function deleteAllergy($allergyId)
    {
        $allergy = Allergy::findOrFail($allergyId);
        $allergy->delete();
        
        return redirect()->route('admin.allergies');
    }

    /**
     * Validar se o id existe nos pacientes, e verifica a role do user que está guardada no patient.
     */
    private function validatePatientUser($patientId)
    {
        $patient = User::with('patient')->findOrFail($patientId);
        //dd($patient);
        
        if ($patient->role_id !== 3) {
            abort(403, 'Utilizador não é um paciente');
        }
        
        return $patient;
    }
}
