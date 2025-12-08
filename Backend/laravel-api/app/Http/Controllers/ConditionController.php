<?php

namespace App\Http\Controllers;

use App\Models\Condition;
use App\Http\Requests\StoreConditionRequest;
use App\Http\Requests\UpdateConditionRequest;

class ConditionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $conditions = Condition::all();
        return response()->json([$conditions], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreConditionRequest $request)
    {
        $data = $request->validated();
        $condition = Condition::create($data);
        return response()->json([$condition],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Condition $condition)
    {
        return response()->json([$condition],201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateConditionRequest $request, Condition $condition)
    {
        $data = $request->validated();
        $condition -> update($data);
        return response()->json([$condition], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Condition $condition)
    {
        //
    }

    public function patientConditions()
    {
        $patient = auth()->user()->patient;
        $patientWithConditions = $patient->load('conditions');
        return response()->json(['data'=>$patientWithConditions], 200);
    }
}
