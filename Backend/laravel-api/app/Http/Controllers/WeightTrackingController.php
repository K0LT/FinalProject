<?php

namespace App\Http\Controllers;

use App\Models\WeightTracking;
use App\Http\Requests\StoreWeightTrackingRequest;
use App\Http\Requests\UpdateWeightTrackingRequest;

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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
     * Show the form for editing the specified resource.
     */
    public function edit(WeightTracking $weightTracking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWeightTrackingRequest $request, WeightTracking $weightTracking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WeightTracking $weightTracking)
    {
        //
    }
}
