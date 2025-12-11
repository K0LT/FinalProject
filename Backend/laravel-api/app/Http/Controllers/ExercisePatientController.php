<?php

namespace App\Http\Controllers;

use App\Models\ExercisePatient;
use App\Http\Requests\StoreExercisePatientRequest;
use App\Http\Requests\UpdateExercisePatientRequest;

class ExercisePatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exercisesPatients = ExercisePatient::all();
        return response()->json($exercisesPatients);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExercisePatientRequest $request)
    {
        $data = $request->validated();
        $exercise_patient = ExercisePatient::create($data);
        return response()->json($exercise_patient);
    }

    /**
     * Display the specified resource.
     */
    public function show(ExercisePatient $exercisePatient)
    {
        return response()->json($exercisePatient);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExercisePatient $exercisePatient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExercisePatientRequest $request, ExercisePatient $exercisePatient)
    {
        $data = $request->validated();
        $exercisePatient->update($data);
        return response()->json($exercisePatient);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExercisePatient $exercisePatient)
    {
        //
    }
}
