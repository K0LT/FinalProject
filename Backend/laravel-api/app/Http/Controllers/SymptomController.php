<?php

namespace App\Http\Controllers;

use App\Models\Symptom;
use App\Http\Requests\StoreSymptomRequest;
use App\Http\Requests\UpdateSymptomRequest;

class SymptomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $symptoms = Symptom::all();
        return response()->json($symptoms);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSymptomRequest $request)
    {
        $data = $request->validated();

        $symptom = Symptom::create($data);
        return response()->json($symptom);
    }

    /**
     * Display the specified resource.
     */
    public function show(Symptom $symptom)
    {
        return response()->json($symptom);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSymptomRequest $request, Symptom $symptom)
    {
        $data = $request->validated();
        $symptom->update($data);
        return response()->json($symptom);
    }

    /**
     * Soft delete a symptom.
     */
    public function destroy(Symptom $symptom)
    {
        $symptom->delete();
        return response()->json(null, 204);
    }

    /**
     * List all soft deleted symptoms.
     */
    public function indexSoftDelete()
    {
        $symptoms = Symptom::onlyTrashed()->get();
        return response()->json($symptoms);
    }

    /**
     * Show a specific soft deleted symptom.
     */
    public function showSoftDelete($id)
    {
        $symptom = Symptom::onlyTrashed()->findOrFail($id);
        return response()->json($symptom);
    }

    /**
     * Restore a soft deleted symptom.
     */
    public function restoreSoftDelete($id)
    {
        $symptom = Symptom::onlyTrashed()->findOrFail($id);
        $symptom->restore();

        return response()->json($symptom);
    }
}
