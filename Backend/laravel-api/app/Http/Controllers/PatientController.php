<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use Illuminate\Http\Request;

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
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        $patient->load(['user', 'conditions', 'allergies']);

        return response()->json([
            'data' => $patient
        ], 200);
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
        $patient->delete();
        return response()->json(null, 204);
    }

    /**
     * List all soft deleted patients
     */
    public function indexSoftDelete()
    {
        $patients = Patient::onlyTrashed()->get();
        return response()->json($patients, 200);
    }

    /**
     * Show a specific soft deleted patient
     */
    public function showSoftDelete($id)
    {
        $patient = Patient::onlyTrashed()->findOrFail($id);
        return response()->json($patient, 200);
    }

    /**
     * Restore a soft deleted patient
     */
    public function restoreSoftDelete($id)
    {
        $patient = Patient::onlyTrashed()->findOrFail($id);
        $patient->restore();
        return response()->json($patient, 200);
    }

    /**
     * Restore a soft deleted patien*
     * public function get_relation(Patient $patient, $relation){
     * $relationships = ['diagnostics', 'treatments', 'progress_notes','treatmentGoals',
     * 'exercises', 'weightTrackings', 'nutritionGoals', 'dailyNutritions', 'allergies', 'conditions'];
     *
     * foreach($relationships as $relationship){
     * if($relationship === $relation){
     * return response()->json($patient->$relation);
     * }
     * }
     *
     * return response()->json("Error", 404);
     * }
     *
     */


    public function userPatient(Request $request)
    {
        $user = auth('sanctum')->user();

        if (!$user) {
            return response()->json([
                'message' => 'Unauthenticated'
            ], 401);
        }

        $patient = $user->patient;

        if (!$patient) {
            return response()->json([
                'message' => 'Patient not found for this user'
            ], 404);
        }


        return response()->json([
            'user' => $user,
            'patient' => $patient
        ], 200);
    }
}
