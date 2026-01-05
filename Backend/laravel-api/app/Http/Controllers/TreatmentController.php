<?php

namespace App\Http\Controllers;

use App\Models\Treatment;
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
        $treatments = Treatment::all();
        return response()->json($treatments);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTreatmentRequest $request)
    {
        $data = $request->validated();
        $treatment = Treatment::create($data);
        return response()->json($treatment);
    }

    /**
     * Display the specified resource.
     */
    public function show(Treatment $treatment)
    {
        return response()->json($treatment);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTreatmentRequest $request, Treatment $treatment)
    {
        $data = $request->validated();
        $treatment->update($data);
        return response()->json($treatment);
    }

    /**
     * Soft delete a treatment.
     */
    public function destroy(Treatment $treatment)
    {
        $treatment->delete();
        return response()->json(null, 204);
    }

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

    public function userTreaments(Request $request)
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

        $patient->load('treatments.treatmentGoals');

        return response()->json([
            'patient' => $patient
        ], 200);
    }
}
