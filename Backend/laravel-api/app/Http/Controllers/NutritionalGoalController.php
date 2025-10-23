<?php

namespace App\Http\Controllers;

use App\Models\NutritionalGoal;
use App\Http\Requests\StoreNutritionalGoalRequest;
use App\Http\Requests\UpdateNutritionalGoalRequest;

class NutritionalGoalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nutritionalGoals = NutritionalGoal::all();
        return response()->json($nutritionalGoals);
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
    public function store(StoreNutritionalGoalRequest $request)
    {
        $data = $request->validated();
        $nutritional_goal = NutritionalGoal::create($data);
        return response()->json($nutritional_goal);
    }

    /**
     * Display the specified resource.
     */
    public function show(NutritionalGoal $nutritionalGoal)
    {
        return response()->json($nutritionalGoal);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NutritionalGoal $nutritionalGoal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNutritionalGoalRequest $request, NutritionalGoal $nutritionalGoal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NutritionalGoal $nutritionalGoal)
    {
        //
    }
}
