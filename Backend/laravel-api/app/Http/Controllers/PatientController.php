<?php

namespace App\Http\Controllers;

use App\Http\Resources\PatientResource;
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
        $patients = Patient::with('user')
            ->join('users', 'patients.user_id', '=', 'users.id')
            ->orderBy('users.name', 'asc')
            ->select('patients.*')
            ->get();

        return response()->json([
            'data' => $patients
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        $patient->load('user');

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
        return new PatientResource($patient);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();
        return response()->json([
            'message' => 'Eliminado'
        ], 204);
    }

    /**
     * User view: User Patient.
     */
    public function userPatient(Request $request)
    {
        $user = auth('sanctum')->user();

        $patient = $user->patient;

        if (!$patient) {
            return response()->json([
                'message' => 'Paciente não encontrado'
            ], 404);
        }

        $patient->load('user');

        return response()->json([
            'patient' => $patient
        ], 200);
    }

    /**
     * User view: User Patient.
     */
    public function patientUser(Patient $patient)
    {
        $patient = $patient->load('user');

        return response()->json([
            'patient' => $patient
        ], 200);
    }



    /**
     * SOFT DELETES
     */




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
}
