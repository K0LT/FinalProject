<?php

namespace App\Http\Controllers;

use App\Http\Resources\TreatmentResource;
use App\Models\Treatment;
use App\Models\Patient;
use App\Http\Requests\StoreTreatmentRequest;
use App\Http\Requests\UpdateTreatmentRequest;
use Illuminate\Http\Request;

class TreatmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TreatmentResource::collection(
            Treatment::orderBy('name', 'asc')->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTreatmentRequest $request)
    {
        $data = $request->validated();
        $treatment = Treatment::create($data);
        return new TreatmentResource($treatment);
    }

    /**
     * Display the specified resource.
     */
    public function show(Treatment $treatment)
    {
        return new TreatmentResource($treatment);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTreatmentRequest $request, Treatment $treatment)
    {
        $data = $request->validated();
        $treatment->update($data);
        return new TreatmentResource($treatment);
    }

    /**
     * Soft delete a treatment.
     */
    public function destroy(Treatment $treatment)
    {
        $treatment->delete();
        return response()->json([
            'message' => 'Eliminado'
        ], 204);
    }




    /**
     * Soft Deletes.
     */




    /**
     * List all soft deleted treatments.
     */
    public function indexSoftDelete()
    {
        $treatments = Treatment::onlyTrashed()->get();
        return response()->json($treatments, 200);
    }

    /**
     * Show a specific soft deleted treatment.
     */
    public function showSoftDelete($id)
    {
        $treatment = Treatment::onlyTrashed()->findOrFail($id);
        return response()->json($treatment, 200);
    }

    /**
     * Restore a soft deleted treatment.
     */
    public function restoreSoftDelete($id)
    {
        $treatment = Treatment::onlyTrashed()->findOrFail($id);
        $treatment->restore();
        return response()->json($treatment, 200);
    }

    public function userTreatments(Request $request)
    {
        $user = auth('sanctum')->user();


        $patient = $user->patient;

        if (!$patient) {
            return response()->json([
                'message' => 'Paciente não encontrado'
            ], 404);
        }

        $treatments = $patient->treatments;

        return response()->json([
            'treatments' => $treatments
        ], 200);
    }

    public function patientTreatments(Patient $patient)
    {
        $patient->load('treatments');

        return response()->json($patient, 200);
    }

    public function patientTreatmentsSoftDelete(Patient $patient)
    {
        $treatments = $patient->treatments()
            ->onlyTrashed()
            ->get();

        return response()->json([
            'patient' => $patient,
            'treatments' => $treatments
        ], 200);
    }

}
