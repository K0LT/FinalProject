<?php

namespace App\Http\Controllers;

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
        $weightTrackings = WeightTracking::all();
        return response()->json($weightTrackings);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWeightTrackingRequest $request)
    {
        $data = $request->validated();
        $weight_tracking = WeightTracking::create($data);
        return response()->json($weight_tracking);
    }

    /**
     * Display the specified resource.
     */
    public function show(WeightTracking $weightTracking)
    {
        return response()->json($weightTracking);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWeightTrackingRequest $request, WeightTracking $weightTracking)
    {
        $data = $request->validated();
        $weightTracking->update($data);
        return response()->json($weightTracking);
    }

    /**
     * Soft delete the specified resource.
     */
    public function destroy(WeightTracking $weight_tracking)
    {
        $weight_tracking->delete();

        return response()->json(null, 204);
    }

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

        if (!$user) {
            return response()->json([
                'message' => 'Não'
            ], 401);
        }

        $patient = $user->patient;

        if (!$patient) {
            return response()->json([
                'message' => 'Patient not found for this user'
            ], 404);
        }

        $patient->load('weightTrackings');

        return response()->json([
            'patient' => $patient
        ], 200);
    }
}
