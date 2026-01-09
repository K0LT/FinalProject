<?php

namespace App\Http\Controllers;

use App\Http\Resources\TreatmentGoalResource;
use App\Models\Patient;
use App\Models\TreatmentGoal;
use App\Http\Requests\StoreTreatment_GoalRequest;
use App\Http\Requests\UpdateTreatment_GoalRequest;
use Illuminate\Http\Request;


class TreatmentGoalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TreatmentGoalResource::collection(TreatmentGoal::all());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTreatment_GoalRequest $request)
    {
        $data = $request->validated();
        $treatment_goal = TreatmentGoal::create($data);
        return new TreatmentGoalResource($treatment_goal);
    }

    /**
     * Display the specified resource.
     */
    public function show(TreatmentGoal $treatment_goal)
    {
        $treatment_goal -> load([
            'goalMilestones',
        ]);
        return new TreatmentGoalResource($treatment_goal);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTreatment_GoalRequest $request, TreatmentGoal $treatment_goal)
    {
        $data = $request->validated();
        $treatment_goal->update($data);
        return new TreatmentGoalResource($treatment_goal);
    }


    /**
     * Soft delete a treatment goal.
     */
    public function destroy(TreatmentGoal $treatment_goal)
    {
        $treatment_goal->delete();
        return response()->json([
            'message' => 'Eliminado'
        ], 204);
    }


    /**
     * User view: User TreamentGoals.
     */
    public function userTreatmentGoals(Request $request)
    {
        $user = auth('sanctum')->user();


        $patient = $user->patient;

        if (!$patient) {
            return response()->json([
                'message' => 'Paciente não encontrado'
            ], 404);
        }


        $treatmentGoals = $patient->treatmentGoals;

        $goalMilestones = $patient->appointments
            ->pluck('goalMilestones')
            ->flatten()
            ->values();

        return response()->json([
            'treatmentGoals' => $treatmentGoals
        ], 200);
    }

    /**
     * Admin View: user TreatmentGoals.
     */
    public function patientTreatmentGoals(Patient $patient)
    {
        $treatmentGoals = $patient->treatmentGoals;

        $goalMilestones = $patient->appointments
            ->pluck('goalMilestones')
            ->flatten()
            ->values();

        return response()->json([
            'treatmentGoals' => $treatmentGoals
        ], 200);
    }


    /**
     * Soft Deletes.
     */


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



    public function patientTreatmentGoalsSoftDelete(Patient $patient)
    {
        $treatmentGoals = $patient->treatmentGoals()
            ->onlyTrashed()
            ->with('goalMilestones')
            ->get();

        return response()->json([
            'patient' => $patient,
            'treatment_goals' => $treatmentGoals
        ], 200);
    }

}
