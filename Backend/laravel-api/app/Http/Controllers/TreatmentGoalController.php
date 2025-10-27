<?php

namespace App\Http\Controllers;

use App\Models\TreatmentGoal;
use App\Http\Requests\StoreTreatment_GoalRequest;
use App\Http\Requests\UpdateTreatment_GoalRequest;


class TreatmentGoalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $treatmentgoals = TreatmentGoal::all();
        return response()->json($treatmentgoals);
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
    public function store(StoreTreatment_GoalRequest $request)
    {
        $data = $request->validated();
        $treatment_goal = TreatmentGoal::create($data);
        return response()->json($treatment_goal);
    }

    /**
     * Display the specified resource.
     */
    public function show(TreatmentGoal $treatment_goal)
    {
        $treatment_goal -> load([
            'goalMilestones',

        ]);
        return response()->json($treatment_goal);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TreatmentGoal $treatment_Goal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTreatment_GoalRequest $request, TreatmentGoal $treatment_Goal)
    {
        $data = $request->validated();
        $treatment_Goal->update($data);
        return response()->json($treatment_Goal);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TreatmentGoal $treatment_Goal)
    {
        //
    }
}
