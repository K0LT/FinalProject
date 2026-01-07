<?php

namespace App\Http\Controllers;

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
        $exercises = Exercise::all();
        return response()->json($exercises);
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
        return response()->json($exercise);
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
        return response()->json(null, 204);
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

        if (!$user) {
            return response()->json([
                'message' => 'Não está autenticado'
            ], 401);
        }

        $patient = $user->patient;

        if (!$patient) {
            return response()->json([
                'message' => 'Paciente não encontrado' //Caso o admin tente entrar
            ], 404);
        }

        return response()->json([
            'patient_id' => $patient->id,
            'exercises' => $patient->exercises
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
        $request->validate([
            'exercise_id' => ['required', 'exists:exercises,id'],
        ]);

        $exerciseId = $request->exercise_id;

        if ($patient->exercises()->where('exercises.id', $exerciseId)->exists()) {
            return response()->json([
                'message' => 'Paciente já tem esse exercício associado.'
            ], 409);
        }

        $patient->exercises()->attach($exerciseId);

        return response()->json([
            'message' => 'Added'
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
