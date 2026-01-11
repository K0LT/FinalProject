<?php

namespace App\Http\Controllers\WebControllers;

use App\Http\Controllers\Controller;
use App\Models\Allergy;
use App\Models\Appointment;
use App\Models\Exercise;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    /**
     * Show the client profile/dashboard
     */
    public function profile()
    {
        $user = Auth::user();
        $patient = $user->patient;
        
        $patient->load('appointments', 'conditions', 'allergies');
        
        $appointments = $patient->appointments;
        $conditions = $patient->conditions;
        $userAllergies = $patient->allergies()->orderBy('allergen', 'asc')->get();
        $allAllergies = Allergy::orderBy('allergen', 'asc')->get();
        
        
        $lastVisit = $appointments
            ->where('status', 'Concluído')
            ->sortByDesc('appointment_date_time')
            ->first();
        
        
        $nextAppointment = $appointments
            ->where('status', 'Confirmado')
            ->where('appointment_date_time', '>=', now())
            ->sortBy('appointment_date_time')
            ->first();
        
        return view('client.profile.index', [
            'user' => $user,
            'patient' => $patient,
            'appointments' => $appointments,
            'conditions' => $conditions,
            'allergies' => $userAllergies,
            'allAllergies' => $allAllergies,
            'lastVisit' => $lastVisit,
            'nextAppointment' => $nextAppointment,
        ]);
    }


    /**
     * Show client appointments
     */
    public function appointments()
    {
        $user = Auth::user();
        $patient = $user->patient;
        
        
        $appointments = $patient->appointments()
            ->orderByDesc('appointment_date_time')
            ->get();
        
        return view('client.appointments.index', [
            'user' => $user,
            'patient' => $patient,
            'appointments' => $appointments,
        ]);
    }

    /**
     * Show client diagnostics and treatments
     */
    public function diagnostics()
    {
        $user = Auth::user();
        $patient = $user->patient;
        
        
        $diagnostics = $patient->diagnostics()
            ->with('treatments')
            ->orderByDesc('diagnostic_date')
            ->get();
        
        
        $progressNotes = $patient->progressNotes()
            ->orderByDesc('note_date')
            ->get();
        
        return view('client.diagnostics.index', [
            'user' => $user,
            'patient' => $patient,
            'diagnostics' => $diagnostics,
            'progressNotes' => $progressNotes,
        ]);
    }

    /**
     * Objetivos Page
     */
    public function objectives()
    {
        $user = Auth::user();
        $patient = $user->patient;
        
       
        $treatmentGoals = $patient->treatmentGoals()
            ->with('goalMilestones')
            ->orderByDesc('created_at')
            ->get();
        
        // Calcula a percentagem de um TreatmentGoal consoante quantos goalMilestones foram completos.
        //Foreach do PHP que isolamos um treatmengoGoal.
        $treatmentGoals->each(function ($treatmentGoal) {
            if ($treatmentGoal->goalMilestones->count() > 0) {   //Verifica quantos goalMilestones existem, se for maior que 0 faz a operação, se não vai para o else e fica a 0
                $completedMilestones = $treatmentGoal->goalMilestones->where('completed', true)->count(); // No treatmentGoal isolado, faz um query e pergunta quantos existem completos
                $totalMilestones = $treatmentGoal->goalMilestones->count(); //Verifica a contagem
                $treatmentGoal->progress_percentage = round(($completedMilestones / $totalMilestones) * 100); // Faz a divisão de completos e quantos existem * 100, dando a percentagem.
            } else {
                $treatmentGoal->progress_percentage = 0;
            }
        });
        
        return view('client.objectives.index', [
            'user' => $user,
            'patient' => $patient,
            'treatmentGoals' => $treatmentGoals,
        ]);
    }

    /**
     * Exercises Page
     */
    public function exercises()
    {
        $user = Auth::user();
        $patient = $user->patient;
        //Patient é N para N, logo temos de ir buscar à pivot table quando for prescribed o exercicio.
        $exercises = $patient->exercises()
            ->orderByDesc('pivot_prescribed_date')
            ->get();
        
        return view('client.exercises.index', [
            'user' => $user,
            'patient' => $patient,
            'exercises' => $exercises,
        ]);
    }

    /**
     * WeightControl Page
     */
    public function weightControl()
    {
        $user = Auth::user();
        $patient = $user->patient;
        
        $weightTrackings = $patient->weightTrackings()
            ->orderByDesc('created_at')
            ->get();
        
        $nutritionalGoals = $patient->nutritionalGoals()
            ->orderByDesc('created_at')
            ->first();
        
        $dailyNutrition = $patient->dailyNutritions()
            ->orderByDesc('created_at')
            ->paginate(15);
        
        // Calculo para a diferença de peso. TEmos o primeiro peso, e o ultimo. A diferença entre ele.
        $currentWeight = $weightTrackings->first()?->weight;
        $initialWeight = $weightTrackings->last()?->weight;
        $weightChange = $currentWeight && $initialWeight ? $currentWeight - $initialWeight : 0;
        
        return view('client.weight-control.index', [
            'user' => $user,
            'patient' => $patient,
            'weightTrackings' => $weightTrackings,
            'nutritionalGoals' => $nutritionalGoals,
            'dailyNutrition' => $dailyNutrition,
            'currentWeight' => $currentWeight,
            'weightChange' => $weightChange,
        ]);
    }

    /**
     * Show AI assistant
     */
    public function aiAssistant()
    {
        $user = Auth::user();
        
        return view('client.ai-assistant.index', [
            'user' => $user,
        ]);
    }

    /**
     * Show appointment request form
     */
    public function requestAppointmentForm()
    {
        $user = Auth::user();
        
        return view('client.request-appointment.index', [
            'user' => $user,
        ]);
    }

    /**
     * Store appointment request
     */
    public function storeAppointmentRequest()
    {
        $user = Auth::user();
        $patient = $user->patient;
        
        //Request que vê se a data de marcação é maior que o dia atual
        $validated = request()->validate([
            'appointment_date' => [
                'required',
                'date_format:Y-m-d',
                'after_or_equal:' . now()->addDay()->format('Y-m-d'),
            ],
            'appointment_time' => [
                'required',
                'in:09,10,11,12,13,14,15,16,17', //Maneira de verificar se as horas são as horas de atendimento ativas.
            ],
            'type' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);
        
        //String manipulation. Como recebemos a data e a hora em variaveis diferentes, depois temos de unir para ficar conforme com a base de dados. Date + Espaço + Time + :OO:OO(Segundos e Milisegundos)
        $appointmentDateTime = $validated['appointment_date'] . ' ' . $validated['appointment_time'] . ':00:00';
        
        $data = [
            'patient_id' => $patient->id,
            'appointment_date_time' => $appointmentDateTime,
            'status' => 'Pendente',
            'type' => $validated['type'],
            'notes' => $validated['notes'],
        ];
        
        
        Appointment::create($data);

        
        return redirect()->route('user.appointments')->with('success', 'Consulta solicitada com sucesso!');
    }

    /**
     * Mark exercise as complete and increase actual number
     */
    public function completeExercise(Exercise $exercise)
    {
        $user = Auth::user();
        $patient = $user->patient;
        
        $exercisePatient = $patient->exercises()
            ->where('exercise_id', $exercise->id)
            ->first();
        
        if (!$exercisePatient) {
            return redirect()->route('user.exercises')->with('error', 'Exercício não encontrado.');
        }
        
        // Increment actual_number (max target_number)
        $newActualNumber = min($exercisePatient->pivot->actual_number + 1, $exercisePatient->pivot->target_number);
        
        // Calculate new compliance rate (prevent division by zero)
        $newComplianceRate = $exercisePatient->pivot->target_number > 0 
            ? round(($newActualNumber / $exercisePatient->pivot->target_number) * 100)
            : 0;
        
        // Update the pivot record
        $patient->exercises()->updateExistingPivot($exercise->id, [
            'actual_number' => $newActualNumber,
            'compliance_rate' => $newComplianceRate,
            'last_performed' => now(),
        ]);
        
        return redirect()->route('user.exercises')->with('success', 'Exercício marcado como completo! ' . $newActualNumber . '/' . $exercisePatient->pivot->target_number);
    }



    /**
     * Add weight tracking record
     */
    public function addWeight()
    {
        $user = Auth::user();
        $patient = $user->patient;
        
        $validated = request()->validate([
            'weight' => 'required|numeric|min:20|max:300',
            'notes' => 'nullable|string|max:500',
        ]);
        
        $validated['patient_id'] = $patient->id;
        $validated['measurement_date'] = now();
        
        \App\Models\WeightTracking::create($validated);
        
        return redirect()->route('user.weight-control')->with('success', 'Peso registado com sucesso!');
    }

    /**
     * Add daily nutrition record
     */
    public function addNutrition()
    {
        $user = Auth::user();
        $patient = $user->patient;
        
        $validated = request()->validate([
            'calories_consumed' => 'nullable|numeric|min:0',
            'protein_consumed' => 'nullable|numeric|min:0',
            'carbs_consumed' => 'nullable|numeric|min:0',
            'fat_consumed' => 'nullable|numeric|min:0',
            'water_intake' => 'nullable|numeric|min:0',
            'steps' => 'nullable|integer|min:0',
            'sleep_hours' => 'nullable|numeric|min:0|max:24',
            'calories_burned' => 'nullable|numeric|min:0',
        ]);
        
        $validated['patient_id'] = $patient->id;
        $validated['date'] = now()->format('Y-m-d');
        
        \App\Models\DailyNutrition::create($validated);
        
        return redirect()->route('user.weight-control')->with('success', 'Registro de nutrição adicionado com sucesso!');
    }




    /**
     * Show edit profile form
     */
    public function editProfile()
    {
        $user = Auth::user();
        $patient = $user->patient;
        
        return view('client.profile.edit', [
            'user' => $user,
            'patient' => $patient,
        ]);
    }

    /**
     * Update user profile
     */
    public function updateProfile()
    {
        $user = Auth::user();
        $patient = $user->patient;
        
        $validated = request()->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'birth_date' => 'nullable|date',
            'gender' => 'nullable|string|max:50',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|string|max:20',
            'emergency_contact_relation' => 'nullable|string|max:100',
        ]);
        
        // Update user
        $user->update([
            'name' => $validated['name'],
            'surname' => $validated['surname'],
            'email' => $validated['email'],
        ]);
        
        // Update patient
        $patient->update([
            'phone_number' => $validated['phone_number'],
            'address' => $validated['address'],
            'birth_date' => $validated['birth_date'],
            'gender' => $validated['gender'],
            'emergency_contact_name' => $validated['emergency_contact_name'],
            'emergency_contact_phone' => $validated['emergency_contact_phone'],
            'emergency_contact_relation' => $validated['emergency_contact_relation'],
        ]);
        
        return redirect()->route('user.profile')->with('success', 'Perfil atualizado com sucesso!');
    }



    /**
     * Add allergy to patient
     */
    public function addAllergy()
    {
        $user = Auth::user();
        $patient = $user->patient;
        
        $validated = request()->validate([
            'allergy_id' => 'required|exists:allergies,id',
        ]);
        
        // Check if patient already has this allergy
        if ($patient->allergies()->where('allergy_id', $validated['allergy_id'])->exists()) {
            return redirect()->route('user.profile')->with('error', 'Já tem esta alergia registada!');
        }
        
        $patient->allergies()->attach($validated['allergy_id']);
        
        return redirect()->route('user.profile')->with('success', 'Alergia adicionada com sucesso!');
    }

    /**
     * Remove allergy from patient
     */
    public function removeAllergy()
    {
        $user = Auth::user();
        $patient = $user->patient;
        
        $validated = request()->validate([
            'allergy_id' => 'required|exists:allergies,id',
        ]);
        
        $patient->allergies()->detach($validated['allergy_id']);
        
        return redirect()->route('user.profile')->with('success', 'Alergia removida com sucesso!');
    }
}