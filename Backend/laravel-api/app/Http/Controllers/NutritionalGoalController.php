<?php

namespace App\Http\Controllers;

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
        $nutritionalGoals = NutritionalGoal::all();
        return response()->json($nutritionalGoals);
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
     * Update the specified resource in storage.
     */
    public function update(UpdateNutritionalGoalRequest $request, NutritionalGoal $nutritionalGoal)
    {
        $data = $request->validated();
        $nutritionalGoal->update($data);
        return response()->json($nutritionalGoal);
    }

    /**
     * Nutritional goals of the authenticated user's patient
     */
    /**
     * Soft delete a nutritional goal
     */
    public function destroy(NutritionalGoal $nutritionalGoal)
    {
        $nutritionalGoal->delete();
        return response()->json($nutritionalGoal);
    }

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
    public function userNutritionalGoals(Request $request)
    {
        $user = auth('sanctum')->user();


        $patient = $user->patient;

        if (!$patient) {
            return response()->json([
                'message' => 'Paciente não encontrado'
            ], 404);
        }
        $patient->load('nutritionalGoals');

        return response()->json([
            'patient' => $patient,
        ], 200);
    }

    public function patientNutritionalGoals(Patient $patient)
    {
        $patient->load('nutritionalGoals');

        return response()->json($patient, 200);
    }

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
