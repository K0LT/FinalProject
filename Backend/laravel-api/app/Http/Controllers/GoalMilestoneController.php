<?php

namespace App\Http\Controllers;

use App\Http\Resources\GoalMilestoneResource;
use App\Models\GoalMilestone;
use App\Http\Requests\StoreGoalMilestoneRequest;
use App\Http\Requests\UpdateGoalMilestoneRequest;
use Illuminate\Http\Request;

class GoalMilestoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return GoalMilestoneResource::collection(GoalMilestone::all());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGoalMilestoneRequest $request)
    {
        $data = $request->validated();
        $goalMilestone = GoalMilestone::create($data);
        return new GoalMilestoneResource($goalMilestone);
    }

    /**
     * Display the specified resource.
     */
    public function show(GoalMilestone $goalMilestone)
    {
        return new GoalMilestoneResource($goalMilestone);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGoalMilestoneRequest $request, GoalMilestone $goalMilestone)
    {
        $data = $request->validated();
        $goalMilestone->update($data);
        return new GoalMilestoneResource($goalMilestone);
    }

    public function destroy(GoalMilestone $goalMilestone)
    {
        $goalMilestone->delete();
        return response()->json([
            'message' => 'Eliminado'
        ], 204);
    }




    /**
     * SOFT DELETES
     */



    /**
     * List all soft deleted goal milestones
     */
    public function indexSoftDelete()
    {
        $milestones = GoalMilestone::onlyTrashed()->get();
        return response()->json($milestones, 200);
    }

    /**
     * Show a specific soft deleted goal milestone
     */
    public function showSoftDelete($id)
    {
        $milestone = GoalMilestone::onlyTrashed()->findOrFail($id);
        return response()->json($milestone, 200);
    }

    /**
     * Restore a soft deleted goal milestone
     */
    public function restoreSoftDelete($id)
    {
        $milestone = GoalMilestone::onlyTrashed()->findOrFail($id);
        $milestone->restore();
        return response()->json($milestone, 200);
    }


}
