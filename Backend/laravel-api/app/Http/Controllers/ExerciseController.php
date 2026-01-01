<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Http\Requests\StoreExerciseRequest;
use App\Http\Requests\UpdateExerciseRequest;

class ExerciseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exercises = Exercise::all();
        return response()->json($exercises);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExerciseRequest $request)
    {
        $data = $request->validated();
        $exercise = Exercise::create($data);
        return response()->json($exercise);
    }

    /**
     * Display the specified resource.
     */
    public function show(Exercise $exercise)
    {
        return response()->json($exercise);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExerciseRequest $request, Exercise $exercise)
    {
        $data = $request->validated();
        $exercise->update($data);
        return response()->json($exercise);
    }

    /**
     * Remove the specified resource from storage.
     */
    /**
     * Soft delete an exercise
     */
    public function destroy(Exercise $exercise)
    {
        $exercise->delete();
        return response()->json(null, 204);
    }

    /**
     * List all soft deleted exercises
     */
    public function indexSoftDelete()
    {
        $exercises = Exercise::onlyTrashed()->get();
        return response()->json($exercises, 200);
    }

    /**
     * Show a specific soft deleted exercise
     */
    public function showSoftDelete($id)
    {
        $exercise = Exercise::onlyTrashed()->findOrFail($id);
        return response()->json($exercise, 200);
    }

    /**
     * Restore a soft deleted exercise
     */
    public function restoreSoftDelete($id)
    {
        $exercise = Exercise::onlyTrashed()->findOrFail($id);
        $exercise->restore();
        return response()->json($exercise, 200);
    }

}
