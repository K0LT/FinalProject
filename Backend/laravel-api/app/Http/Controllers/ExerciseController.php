<?php

namespace App\Http\Controllers;

use App\Http\Resources\ExerciseResource;
use App\Models\Exercise;
use App\Http\Requests\StoreExerciseRequest;
use App\Http\Requests\UpdateExerciseRequest;
use App\Models\Patient;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ExerciseResource::collection(Exercise::all());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExerciseRequest $request)
    {
        $data = $request->validated();
        $exercise = Exercise::create($data);
        return response()->json($exercise);
    }

    /**
     * Display the specified resource.
     */
    public function show(Exercise $exercise)
    {
        return new ExerciseResource($exercise);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExerciseRequest $request, Exercise $exercise)
    {
        $data = $request->validated();
        $exercise->update($data);
        return response()->json($exercise);
    }

    /**
     * Remove the specified resource from storage.
     */
    /**
     * Soft delete an exercise
     */
    public function destroy(Exercise $exercise)
    {
        $exercise->delete();
        return response()->json([
            'message' => 'Eliminado'
        ], 204);
    }

    /**
     * List all soft deleted exercises
     */
    public function indexSoftDelete()
    {
        $exercises = Exercise::onlyTrashed()->get();
        return response()->json($exercises, 200);
    }

    /**
     * Show a specific soft deleted exercise
     */
    public function showSoftDelete($id)
    {
        $exercise = Exercise::onlyTrashed()->findOrFail($id);
        return response()->json($exercise, 200);
    }

    /**
     * Restore a soft deleted exercise
     */
    public function restoreSoftDelete($id)
    {
        $exercise = Exercise::onlyTrashed()->findOrFail($id);
        $exercise->restore();
        return response()->json($exercise, 200);
    }

    public function userExercises(Request $request)
    {
        $user = auth('sanctum')->user();


        $patient = $user->patient;

        if (!$patient) {
            return response()->json([
                'message' => 'Paciente não encontrado'
            ], 404);
        }

        $exercises = $patient->exercises;

        return response()->json([
            'exercises' => $exercises
        ]);
    }

    public function patientExercises(Patient $patient)
    {
        $patient->load('exercises');

        return response()->json($patient, 200);
    }

    public function patientExercisesSoftDelete(Patient $patient)
    {
        $exercises = $patient->exercises()
            ->onlyTrashed()
            ->get();

        return response()->json([
            'patient' => $patient,
            'exercises' => $exercises
        ], 200);
    }

    public function adminAddExerciseToPatient(Request $request, Patient $patient)
    {
        $validated = $request->validate([
            'exercise_id'       => ['required', 'exists:exercises,id'],
            'prescribed_date'   => ['nullable', 'date'],
            'frequency'         => ['nullable', 'string'],
            'status'            => ['nullable', 'in:Em progresso,Concluído,Pendente'],
            'compliance_rate'   => ['nullable', 'integer', 'min:0', 'max:100'],
            'last_performed'    => ['nullable', 'date'],
            'notes'             => ['nullable', 'string'],
        ]);

        $exerciseId = $validated['exercise_id'];

        if ($patient->exercises()->where('exercise_id', $exerciseId)->exists()) {
            return response()->json([
                'message' => 'Este exercício já está associado ao paciente.'
            ], 409);
        }

        $patient->exercises()->attach($exerciseId, [
            'prescribed_date' => $validated['prescribed_date'] ?? now()->toDateString(),
            'frequency'       => $validated['frequency'] ?? null,
            'status'          => $validated['status'] ?? 'Pendente',
            'compliance_rate' => $validated['compliance_rate'] ?? 0,
            'last_performed'  => $validated['last_performed'] ?? null,
            'notes'           => $validated['notes'] ?? null,
        ]);

        return response()->json([
            'message' => 'Exercício atribuído ao paciente com sucesso.'
        ], 201);
    }


    public function adminRemoveExerciseFromPatient(Request $request, Patient $patient)
    {
        $request->validate([
            'exercise_id' => ['required', 'exists:exercises,id'],
        ]);

        $exerciseId = $request->exercise_id;

        if (! $patient->exercises()->where('exercises.id', $exerciseId)->exists()) {
            return response()->json([
                'message' => 'Paciente não tem esse exercício.'
            ], 404);
        }

        $patient->exercises()->detach($exerciseId);

        return response()->json([
            'message' => 'Removed'
        ], 200);
    }



}
