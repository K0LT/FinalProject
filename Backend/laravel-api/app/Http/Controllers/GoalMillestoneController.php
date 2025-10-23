<?php

namespace App\Http\Controllers;

use App\Models\GoalMillestone;
use App\Http\Requests\StoreGoalMillestoneRequest;
use App\Http\Requests\UpdateGoalMillestoneRequest;

class GoalMillestoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $goalMillestone = GoalMillestone::all();
        return response()->json($goalMillestone);
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
    public function store(StoreGoalMillestoneRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(GoalMillestone $goalMillestone)
    {
        return response()->json($goalMillestone);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GoalMillestone $goalMillestone)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGoalMillestoneRequest $request, GoalMillestone $goalMillestone)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GoalMillestone $goalMillestone)
    {
        //
    }
}
