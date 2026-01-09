<?php

namespace App\Http\Controllers;

use App\Http\Resources\NutritionalGoalResource;
use App\Models\NutritionalGoal;
use App\Http\Requests\StoreNutritionalGoalRequest;
use App\Http\Requests\UpdateNutritionalGoalRequest;
use App\Models\Patient;
use Illuminate\Http\Request;

class NutritionalGoalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return NutritionalGoalResource::collection(NutritionalGoal::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNutritionalGoalRequest $request)
    {
        $data = $request->validated();
        $nutritionalGoal = NutritionalGoal::create($data);
        return new NutritionalGoalResource($nutritionalGoal);
    }

    /**
     * Display the specified resource.
     */
    public function show(NutritionalGoal $nutritionalGoal)
    {
        return new NutritionalGoalResource($nutritionalGoal);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNutritionalGoalRequest $request, NutritionalGoal $nutritionalGoal)
    {
        $data = $request->validated();
        $nutritionalGoal->update($data);
        return new NutritionalGoalResource($nutritionalGoal);
    }

    /**
     * Soft delete a nutritional goal
     */
    public function destroy(NutritionalGoal $nutritionalGoal)
    {
        $nutritionalGoal->delete();
        return response()->json([
            'message' => 'Eliminado'
        ], 204);
    }

    /**
     * User view: User Nutritional Goals
     */
    public function userNutritionalGoals(Request $request)
    {
        $user = auth('sanctum')->user();


        $patient = $user->patient;

        if (!$patient) {
            return response()->json([
                'message' => 'Paciente não encontrado'
            ], 404);
        }
        $nutritionalGoals = $patient->nutritionalGoals;
        ;

        return response()->json([
            'nutritionalGoals' => $nutritionalGoals
        ], 200);
    }

    /**
     * Admin view: User Nutritional Goals
     */
    public function patientNutritionalGoals(Patient $patient)
    {
        $nutritionalGoals = $patient->nutritionalGoals;

        return response()->json([
            'nutritionalGoals' => $nutritionalGoals
        ], 200);
    }




    /**
     * SOFT DELETES
     */


    /**
     * List all soft-deleted nutritional goals
     */
    public function indexSoftDelete()
    {
        $goals = NutritionalGoal::onlyTrashed()->get();
        return response()->json($goals, 200);

    }

    /**
     * Show a specific soft-deleted nutritional goal
     */
    public function showSoftDelete($id)
    {
        $goal = NutritionalGoal::onlyTrashed()->findOrFail($id);
        return response()->json($goal, 200);
    }

    /**
     * Restore a soft-deleted nutritional goal
     */
    public function restoreSoftDelete($id)
    {
        $goal = NutritionalGoal::onlyTrashed()->findOrFail($id);
        $goal->restore();
        return response()->json($goal, 200);
    }

    /**
     * Nutritional goals of the authenticated user's patient
     */
    public function patientNutritionalGoalsSoftDelete(Patient $patient)
    {
        $nutritionalGoals = $patient->nutritionalGoals()
            ->onlyTrashed()
            ->get();

        return response()->json([
            'patient' => $patient,
            'nutritional_goals' => $nutritionalGoals
        ], 200);
    }

}
