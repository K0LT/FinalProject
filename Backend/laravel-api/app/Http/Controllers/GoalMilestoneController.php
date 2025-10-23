<?php

namespace App\Http\Controllers;

use App\Models\GoalMilestone;
use App\Http\Requests\StoreGoalMilestoneRequest;
use App\Http\Requests\UpdateGoalMilestoneRequest;

class GoalMilestoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $goalMilestone = GoalMilestone::all();
        return response()->json($goalMilestone);
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
    public function store(StoreGoalMilestoneRequest $request)
    {
        $data = $request->validated();
        $goal_milestone = GoalMilestone::create($data);
        return response()->json($goal_milestone );
    }

    /**
     * Display the specified resource.
     */
    public function show(GoalMilestone $goalMilestone)
    {
        return response()->json($goalMilestone);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GoalMilestone $goalMilestone)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGoalMilestoneRequest $request, GoalMilestone $goalMilestone)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GoalMilestone $goalMilestone)
    {
        //
    }
}
