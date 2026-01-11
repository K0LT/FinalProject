<?php

namespace App\Http\Controllers\WebControllers;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Exercise;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Show admin dashboard
     */
    public function dashboard()
    {
        $user = Auth::user();
        
        // Get pending appointments from today onwards
        $pendingAppointments = Appointment::where('status', 'Pendente')
            ->where('appointment_date_time', '>=', now()->startOfDay())
            ->orderBy('appointment_date_time', 'asc')
            ->get();
        
        // Get today's appointments
        $todayAppointments = Appointment::whereDate('appointment_date_time', today())
            ->orderBy('appointment_date_time', 'asc')
            ->get();
        
        // Get new users from last 30 days
        $newUsers = User::where('created_at', '>=', now()->subDays(30))
            ->orderByDesc('created_at')
            ->get();
        
        $newUsersCount = $newUsers->count();
        
        return view('admin.dashboard', [
            'user' => $user,
            'pendingAppointments' => $pendingAppointments,
            'todayAppointments' => $todayAppointments,
            'newUsers' => $newUsers,
            'newUsersCount' => $newUsersCount,
        ]);
    }

    /**
     * Show patients list
     */
    public function patients()
    {
        $user = Auth::user();
        
        $patients = User::where('role_id', 3) // Role 3 = Patient
            ->with('patient')
            ->orderByDesc('created_at')
            ->paginate(20);
        
        return view('admin.patients.index', [
            'user' => $user,
            'patients' => $patients,
        ]);
    }

    /**
     * Show patient details
     */
    public function patientDetail($patientId)
    {
        $user = Auth::user();
        
        $patient = User::findOrFail($patientId);
        
        if ($patient->role_id !== 3) {
            abort(403, 'Utilizador não é um paciente');
        }
        
        $patientData = $patient->patient;
        $patientData->load('appointments', 'conditions', 'allergies', 'exercises', 'diagnostics', 'treatmentGoals', 'weightTrackings', 'nutritionalGoals', 'progressNotes');
        
        // Get next confirmed appointment from today onwards
        $nextAppointment = $patientData->appointments()
            ->where('status', 'Confirmado')
            ->where('appointment_date_time', '>=', now())
            ->orderBy('appointment_date_time', 'asc')
            ->first();
        
        // Get all allergies for the dropdown
        $allergies = \App\Models\Allergy::orderBy('allergen', 'asc')->get();
        
        return view('admin.patients.detail', [
            'user' => $user,
            'patient' => $patient,
            'patientData' => $patientData,
            'nextAppointment' => $nextAppointment,
            'allergies' => $allergies,
        ]);
    }

    /**
     * Show patient appointments
     */
    public function patientAppointments($patientId)
    {
        $user = Auth::user();
        $patient = User::findOrFail($patientId);
        
        if ($patient->role_id !== 3) {
            abort(403, 'Utilizador não é um paciente');
        }
        
        $appointments = $patient->patient->appointments()->orderByDesc('appointment_date_time')->get();
        
        return view('admin.patients.appointments', [
            'user' => $user,
            'patient' => $patient,
            'appointments' => $appointments,
        ]);
    }

    /**
     * Store appointment for patient
     */
    public function storePatientAppointment($patientId)
    {
        $user = Auth::user();
        $patient = User::findOrFail($patientId);
        
        if ($patient->role_id !== 3) {
            abort(403, 'Utilizador não é um paciente');
        }
        
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
        
        $appointmentDateTime = $validated['appointment_date'] . ' ' . $validated['appointment_time'] . ':00:00';
        
        $data = [
            'patient_id' => $patient->patient->id,
            'appointment_date_time' => $appointmentDateTime,
            'status' => 'Confirmado',
            'type' => $validated['type'],
            'notes' => $validated['notes'],
        ];
        
        Appointment::create($data);
        
        return redirect()->route('admin.patient.appointments', $patientId)->with('success', 'Consulta criada com sucesso!');
    }

    /**
     * Show patient diagnostics
     */
    public function patientDiagnostics($patientId)
    {
        $user = Auth::user();
        $patient = User::findOrFail($patientId);
        
        if ($patient->role_id !== 3) {
            abort(403, 'Utilizador não é um paciente');
        }
        
        $diagnostics = $patient->patient->diagnostics()->with('symptoms', 'treatments')->orderByDesc('diagnostic_date')->get();
        
        return view('admin.patients.diagnostics', [
            'user' => $user,
            'patient' => $patient,
            'diagnostics' => $diagnostics,
        ]);
    }

    /**
     * Store diagnostic for patient
     */
    public function storePatientDiagnostic($patientId)
    {
        $user = Auth::user();
        $patient = User::findOrFail($patientId);
        
        if ($patient->role_id !== 3) {
            abort(403, 'Utilizador não é um paciente');
        }
        
        $validated = request()->validate([
            'diagnostic_date' => 'required|date_format:Y-m-d',
            'western_diagnosis' => 'nullable|string|max:255',
            'tcm_diagnosis' => 'nullable|string|max:255',
            'severity' => 'nullable|string|max:255',
            'pulse_quality' => 'nullable|string|max:255',
            'tongue_description' => 'nullable|string',
        ]);
        
        $diagnostic = $patient->patient->diagnostics()->create($validated);
        
        return redirect()->route('admin.patient.diagnostics', $patientId)->with('success', 'Diagnóstico criado com sucesso!');
    }

    /**
     * Show patient exercises
     */
    public function patientExercises($patientId)
    {
        $user = Auth::user();
        $patient = User::findOrFail($patientId);
        
        if ($patient->role_id !== 3) {
            abort(403, 'Utilizador não é um paciente');
        }
        
        $exercises = $patient->patient->exercises()->orderByDesc('pivot_prescribed_date')->get();
        $allExercises = Exercise::orderBy('name', 'asc')->get();
        
        return view('admin.patients.exercises', [
            'user' => $user,
            'patient' => $patient,
            'exercises' => $exercises,
            'allExercises' => $allExercises,
        ]);
    }

    /**
     * Attach exercise to patient
     */
    public function attachPatientExercise($patientId)
    {
        $user = Auth::user();
        $patient = User::findOrFail($patientId);
        
        if ($patient->role_id !== 3) {
            abort(403, 'Utilizador não é um paciente');
        }
        
        $validated = request()->validate([
            'exercise_id' => 'required|exists:exercises,id',
            'prescribed_date' => 'required|date_format:Y-m-d',
            'frequency' => 'nullable|string|max:255',
            'target_number' => 'required|integer|min:1',
            'status' => 'required|in:Em progresso,Concluído,Cancelado',
            'notes' => 'nullable|string',
        ]);
        
        // Check if exercise is already attached
        $exists = $patient->patient->exercises()
            ->where('exercise_id', $validated['exercise_id'])
            ->wherePivotNull('deleted_at')
            ->exists();
        
        if ($exists) {
            return redirect()->route('admin.patient.exercises', $patientId)
                ->with('error', 'Este exercício já está atribuído ao paciente!');
        }
        
        $patient->patient->exercises()->attach($validated['exercise_id'], [
            'prescribed_date' => $validated['prescribed_date'],
            'frequency' => $validated['frequency'],
            'target_number' => $validated['target_number'],
            'actual_number' => 0,
            'compliance_rate' => 0,
            'status' => $validated['status'],
        ]);
        
        return redirect()->route('admin.patient.exercises', $patientId)
            ->with('success', 'Exercício atribuído com sucesso!');
    }

    /**
     * Show patient objectives
     */
    public function patientObjectives($patientId)
    {
        $user = Auth::user();
        $patient = User::findOrFail($patientId);
        
        if ($patient->role_id !== 3) {
            abort(403, 'Utilizador não é um paciente');
        }
        
        $objectives = $patient->patient->treatmentGoals()->with('goalMilestones')->orderByDesc('created_at')->get();
        
        return view('admin.patients.objectives', [
            'user' => $user,
            'patient' => $patient,
            'objectives' => $objectives,
        ]);
    }

    /**
     * Store treatment objective for patient
     */
    public function storePatientObjective($patientId)
    {
        $user = Auth::user();
        $patient = User::findOrFail($patientId);
        
        if ($patient->role_id !== 3) {
            abort(403, 'Utilizador não é um paciente');
        }
        
        $validated = request()->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:Mínima,Média,Alta',
            'status' => 'required|in:Em progresso,Concluído,Cancelado',
            'target_date' => 'nullable|date_format:Y-m-d',
            'treatment_methods' => 'nullable|string|max:255',
        ]);
        
        $patient->patient->treatmentGoals()->create($validated);
        
        return redirect()->route('admin.patient.objectives', $patientId)
            ->with('success', 'Objetivo de tratamento criado com sucesso!');
    }

    /**
     * Store goal milestone for objective
     */
    public function storeGoalMilestone($patientId, $objectiveId)
    {
        $user = Auth::user();
        $patient = User::findOrFail($patientId);
        
        if ($patient->role_id !== 3) {
            abort(403, 'Utilizador não é um paciente');
        }
        
        $objective = $patient->patient->treatmentGoals()->findOrFail($objectiveId);
        
        $validated = request()->validate([
            'description' => 'required|string',
            'target_date' => 'required|date_format:Y-m-d',
        ]);
        
        $objective->goalMilestones()->create($validated);
        
        return redirect()->route('admin.patient.objectives', $patientId)
            ->with('success', 'Marco de progresso criado com sucesso!');
    }

    /**
     * Toggle milestone completion
     */
    public function toggleMilestoneCompletion($patientId, $milestoneId)
    {
        $user = Auth::user();
        $patient = User::findOrFail($patientId);
        
        if ($patient->role_id !== 3) {
            abort(403, 'Utilizador não é um paciente');
        }
        
        $milestone = \App\Models\GoalMilestone::findOrFail($milestoneId);
        
        // Verify the milestone belongs to this patient's objective
        $objective = $milestone->treatmentGoal;
        if ($objective->patient_id !== $patient->patient->id) {
            abort(403, 'Acesso negado');
        }
        
        $milestone->update([
            'completed' => !$milestone->completed,
            'completion_date' => !$milestone->completed ? now()->format('Y-m-d') : null,
        ]);
        
        return redirect()->route('admin.patient.objectives', $patientId)
            ->with('success', 'Marco atualizado com sucesso!');
    }

    /**
     * Show patient progress notes
     */
    public function patientProgressNotes($patientId)
    {
        $user = Auth::user();
        $patient = User::findOrFail($patientId);
        
        if ($patient->role_id !== 3) {
            abort(403, 'Utilizador não é um paciente');
        }
        
        $progressNotes = $patient->patient->progressNotes()->orderByDesc('note_date')->get();
        
        return view('admin.patients.progress-notes', [
            'user' => $user,
            'patient' => $patient,
            'progressNotes' => $progressNotes,
        ]);
    }

    /**
     * Store progress note for patient
     */
    public function storeProgressNote($patientId)
    {
        $user = Auth::user();
        $patient = User::findOrFail($patientId);
        
        if ($patient->role_id !== 3) {
            abort(403, 'Utilizador não é um paciente');
        }
        
        $validated = request()->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'subjective' => 'nullable|string',
            'objective' => 'nullable|string',
            'assessment' => 'nullable|string',
            'plan' => 'nullable|string',
        ]);
        
        // Verify appointment belongs to this patient
        $appointment = Appointment::findOrFail($validated['appointment_id']);
        if ($appointment->patient_id !== $patient->patient->id) {
            abort(403, 'Acesso negado');
        }
        
        $patient->patient->progressNotes()->create([
            'appointment_id' => $validated['appointment_id'],
            'note_date' => now()->format('Y-m-d'),
            'subjective' => $validated['subjective'],
            'objective' => $validated['objective'],
            'assessment' => $validated['assessment'],
            'plan' => $validated['plan'],
        ]);
        
        return redirect()->route('admin.patient.appointments', $patientId)
            ->with('success', 'Nota de progresso criada com sucesso!');
    }

    /**
     * Store condition for patient
     */
    public function storePatientCondition($patientId)
    {
        $user = Auth::user();
        $patient = User::findOrFail($patientId);
        
        if ($patient->role_id !== 3) {
            abort(403, 'Utilizador não é um paciente');
        }
        
        $validated = request()->validate([
            'name' => 'required|string|max:255',
            'diagnosed_date' => 'required|date_format:Y-m-d',
            'status' => 'nullable|string|max:255',
        ]);
        
        $patient->patient->conditions()->create($validated);
        
        return redirect()->route('admin.patient.detail', $patientId)
            ->with('success', 'Condição adicionada com sucesso!');
    }

    /**
     * Store allergy for patient
     */
    public function storePatientAllergy($patientId)
    {
        $user = Auth::user();
        $patient = User::findOrFail($patientId);
        
        if ($patient->role_id !== 3) {
            abort(403, 'Utilizador não é um paciente');
        }
        
        $validated = request()->validate([
            'allergy_id' => 'required|exists:allergies,id',
            ''
        ]);
        
        // Check if allergy is already attached
        $exists = $patient->patient->allergies()
            ->where('allergy_id', $validated['allergy_id'])
            ->exists();
        
        if ($exists) {
            return redirect()->route('admin.patient.detail', $patientId)
                ->with('error', 'Esta alergia já está registada para o paciente!');
        }
        
        $patient->patient->allergies()->attach($validated['allergy_id']);
        
        return redirect()->route('admin.patient.detail', $patientId)
            ->with('success', 'Alergia adicionada com sucesso!');
    }

    /**
     * Show patient health control
     */
    public function patientHealthControl($patientId)
    {
        $user = Auth::user();
        $patient = User::findOrFail($patientId);
        
        if ($patient->role_id !== 3) {
            abort(403, 'Utilizador não é um paciente');
        }
        
        $weightTrackings = $patient->patient->weightTrackings()->orderByDesc('created_at')->get();
        $dailyNutrition = $patient->patient->dailyNutritions()->orderByDesc('created_at')->paginate(15);
        
        return view('admin.patients.health-control', [
            'user' => $user,
            'patient' => $patient,
            'weightTrackings' => $weightTrackings,
            'dailyNutrition' => $dailyNutrition,
        ]);
    }

    /**
     * Show exercises list
     */
    public function exercises()
    {
        $user = Auth::user();
        
        return view('admin.exercises.index', [
            'user' => $user,
        ]);
    }

    /**
     * Show appointments list
     */
    public function appointments()
    {
        $user = Auth::user();
        
        return view('admin.appointments.index', [
            'user' => $user,
        ]);
    }

    /**
     * Show conditions list
     */
    public function conditions()
    {
        $user = Auth::user();
        
        return view('admin.conditions.index', [
            'user' => $user,
        ]);
    }

    /**
     * Show symptoms list
     */
    public function symptoms()
    {
        $user = Auth::user();
        
        return view('admin.symptoms.index', [
            'user' => $user,
        ]);
    }

    /**
     * Show allergies list
     */
    public function allergies()
    {
        $user = Auth::user();
        
        return view('admin.allergies.index', [
            'user' => $user,
        ]);
    }
}
