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
        return PatientResource::collection(Patient::all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        return new PatientResource($patient);
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
            'patient' => $patient,
        ], 200);
    }
}
