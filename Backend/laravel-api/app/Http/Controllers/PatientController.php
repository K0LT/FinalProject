<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = Patient::all();
        return response()->json($patients);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePatientRequest $request)
    {
        $data = $request->validated();
        $patient = Patient::create($data);
        return response()->json($patient);
    }

    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        $patient->load([
            'user',
            'diagnostics',
            'treatments',
            'treatmentGoals.symptoms',
            'treatmentGoals.goalMilestones',
            'exercises',
            'weightTrackings',
            'nutritionGoals',
            'dailyNutritions',
            'allergies',
            'conditions',
            'progressNotes',
        ]);
        return response()->json($patient);
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $patient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePatientRequest $request, Patient $patient)
    {
        $data = $request->validated();
        $patient->update($data);
        return response()->json($patient);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        //
    }
    public function get_relation(Patient $patient, $relation){
        $relationships = ['diagnostics', 'treatments', 'progress_notes','treatmentGoals',
            'exercises', 'weightTrackings', 'nutritionGoals', 'dailyNutritions', 'allergies', 'conditions'];

        foreach($relationships as $relationship){
            if($relationship === $relation){
                return response()->json($patient->$relation);
            }
        }

        return response()->json("Error", 404);
    }
}
