<?php

namespace App\Http\Controllers;

use App\Http\Resources\TreatmentResource;
use App\Http\Resources\WeightTrackingResource;
use App\Models\Patient;
use App\Models\WeightTracking;
use App\Http\Requests\StoreWeightTrackingRequest;
use App\Http\Requests\UpdateWeightTrackingRequest;
use Illuminate\Http\Request;

class WeightTrackingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return WeightTrackingResource::collection(WeightTracking::all());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWeightTrackingRequest $request)
    {
        $data = $request->validated();
        $weightTracking = WeightTracking::create($data);
        return new WeightTrackingResource($weightTracking);
    }

    /**
     * Display the specified resource.
     */
    public function show(WeightTracking $weightTracking)
    {
        return new WeightTrackingResource($weightTracking);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWeightTrackingRequest $request, WeightTracking $weightTracking)
    {
        $data = $request->validated();
        $weightTracking->update($data);
        return new WeightTrackingResource($weightTracking);
    }

    /**
     * Soft delete the specified resource.
     */
    public function destroy(WeightTracking $weight_tracking)
    {
        $weight_tracking->delete();
        return response()->json([
            'message' => 'Eliminado'
        ], 204);
    }



    /**
     * Soft Deletes.
     */


    /**
     * List all soft deleted weight trackings.
     */
    public function indexSoftDelete()
    {
        return response()->json(
            WeightTracking::onlyTrashed()->get()
        );
    }

    /**
     * Show a specific soft deleted weight tracking.
     */
    public function showSoftDelete($id)
    {
        $weightTracking = WeightTracking::onlyTrashed()->findOrFail($id);

        return response()->json($weightTracking);
    }

    /**
     * Restore a soft deleted weight tracking.
     */
    public function restoreSoftDelete($id)
    {
        $weightTracking = WeightTracking::onlyTrashed()->findOrFail($id);
        $weightTracking->restore();

        return response()->json($weightTracking);
    }

    public function userWeightTrackings(Request $request)
    {
        $user = auth('sanctum')->user();

        $patient = $user->patient;

        if (!$patient) {
            return response()->json([
                'message' => 'Paciente não encontrado'
            ], 404);
        }


        $weightTrackings = $patient->weightTrackings;
        return response()->json([
            'weightTrackings' => $weightTrackings
        ], 200);
    }

    public function patientWeightTrackings(Patient $patient)
    {
        $patient->load('weightTrackings');

        return response()->json($patient, 200);
    }

    public function patientWeightTrackingsSoftDelete(Patient $patient)
    {
        $weightTrackings = $patient->weightTrackings()
            ->onlyTrashed()
            ->get();

        return response()->json([
            'patient' => $patient,
            'weight_trackings' => $weightTrackings
        ], 200);
    }

}
