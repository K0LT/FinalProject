<?php

namespace App\Http\Controllers;

use App\Models\Treatment;
use App\Http\Requests\StoreTreatmentRequest;
use App\Http\Requests\UpdateTreatmentRequest;

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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
     * Show the form for editing the specified resource.
     */
    public function edit(Treatment $treatment)
    {
        //
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
}
