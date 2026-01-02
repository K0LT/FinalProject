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
     * Update the specified resource in storage.
     */
    public function update(UpdateTreatment_GoalRequest $request, TreatmentGoal $treatment_goal)
    {
        $data = $request->validated();
        $treatment_goal->update($data);
        return response()->json($treatment_goal);
    }

    /**
     * Remove the specified resource from storage.
     */
    /**
     * Soft delete a treatment goal.
     */
    public function destroy(TreatmentGoal $treatment_goal)
    {
        $treatment_goal->delete();
        return response()->json(null, 204);
    }

    /**
     * List all soft deleted treatment goals.
     */
    public function indexSoftDelete()
    {
        $goals = TreatmentGoal::onlyTrashed()->get();
        return response()->json($goals, 200);
    }

    /**
     * Show a specific soft deleted treatment goal.
     */
    public function showSoftDelete($id)
    {
        $goal = TreatmentGoal::onlyTrashed()->findOrFail($id);
        return response()->json($goal, 200);
    }

    /**
     * Restore a soft deleted treatment goal.
     */
    public function restoreSoftDelete($id)
    {
        $goal = TreatmentGoal::onlyTrashed()->findOrFail($id);
        $goal->restore();
        return response()->json($goal, 200);
    }
}
