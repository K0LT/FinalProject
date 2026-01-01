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
        return response()->json($conditions);
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
    public function store(StoreConditionRequest $request)
    {
        $data = $request->validated();
        $condition = Condition::create($data);
        return response()->json($condition);
    }

    /**
     * Display the specified resource.
     */
    public function show(Condition $condition)
    {
        return response()->json($condition);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Condition $condition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateConditionRequest $request, Condition $condition)
    {
        $data = $request->validated();
        $condition -> update($data);
        return response()->json($condition);
    }

    /**
     * Delete a condition (soft delete)
     */
    public function destroy(Condition $condition)
    {
        $condition->delete();
        return response()->json(null, 204);
    }

    /**
     * List all soft deleted conditions
     */
    public function indexSoftDelete()
    {
        $conditions = Condition::onlyTrashed()->get();
        return response()->json($conditions, 200);
    }

    /**
     * Show a specific soft deleted condition
     */
    public function showSoftDelete($id)
    {
        $condition = Condition::onlyTrashed()->findOrFail($id);
        return response()->json($condition, 200);
    }

    /**
     * Restore a soft deleted condition
     */
    public function restoreSoftDelete($id)
    {
        $condition = Condition::onlyTrashed()->findOrFail($id);
        $condition->restore();
        return response()->json($condition, 200);
    }
}
