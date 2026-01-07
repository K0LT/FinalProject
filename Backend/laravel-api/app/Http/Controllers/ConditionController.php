<?php

namespace App\Http\Controllers;

use App\Models\Condition;
use App\Http\Requests\StoreConditionRequest;
use App\Http\Requests\UpdateConditionRequest;
use App\Models\Diagnostic;
use App\Models\Patient;
use Illuminate\Http\Request;

class ConditionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $conditions = Condition::all();
        return response()->json($conditions);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreConditionRequest $request)
    {
        $data = $request->validated();
        $condition = Condition::create($data);
        return response()->json($condition);
    }

    /**
     * Display the specified resource.
     */
    public function show(Condition $condition)
    {
        return response()->json($condition);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateConditionRequest $request, Condition $condition)
    {
        $data = $request->validated();
        $condition -> update($data);
        return response()->json($condition);
    }

    /**
     * Delete a condition (soft delete)
     */
    public function destroy(Condition $condition)
    {
        $condition->delete();
        return response()->json(null, 204);
    }

    /**
     * List all soft deleted conditions
     */
    public function indexSoftDelete()
    {
        $conditions = Condition::onlyTrashed()->get();
        return response()->json($conditions, 200);
    }

    /**
     * Show a specific soft deleted condition
     */
    public function showSoftDelete($id)
    {
        $condition = Condition::onlyTrashed()->findOrFail($id);
        return response()->json($condition, 200);
    }

    /**
     * Restore a soft deleted condition
     */
    public function restoreSoftDelete($id)
    {
        $condition = Condition::onlyTrashed()->findOrFail($id);
        $condition->restore();
        return response()->json($condition, 200);
    }

    public function userConditions(Request $request)
    {
        $user = auth('sanctum')->user();

        if (!$user) {
            return response()->json([
                'message' => 'Não'
            ], 401);
        }

        $patient = $user->patient;

        if (!$patient) {
            return response()->json([
                'message' => 'Patient not found for this user'
            ], 404);
        }

        $patient->load('conditions');

        return response()->json([
            'patient' => $patient
        ], 200);
    }

    public function patientConditions(Patient $patient)
    {
        $patient->load('conditions');

        return response()->json($patient, 200);
    }

    public function patientConditionsSoftDelete(Patient $patient)
    {
        $conditions = $patient->conditions()
            ->onlyTrashed()
            ->get();

        return response()->json([
            'patient' => $patient,
            'conditions' => $conditions
        ], 200);
    }

    public function adminAddConditionToDiagnostic(Request $request, Diagnostic $diagnostic)
    {
        $request->validate([
            'condition_id' => ['required', 'exists:conditions,id'],
        ]);

        $conditionId = $request->condition_id;

        if ($diagnostic->conditions()->where('conditions.id', $conditionId)->exists()) {
            return response()->json([
                'message' => 'Diagnostic já tem essa condition associada.'
            ], 409);
        }

        $diagnostic->conditions()->attach($conditionId);

        return response()->json([
            'message' => 'Added'
        ], 201);
    }


    public function adminRemoveConditionFromDiagnostic(Request $request, Diagnostic $diagnostic)
    {
        $request->validate([
            'condition_id' => ['required', 'exists:conditions,id'],
        ]);

        $conditionId = $request->condition_id;

        if (! $diagnostic->conditions()->where('conditions.id', $conditionId)->exists()) {
            return response()->json([
                'message' => 'Diagnostic não tem essa condition.'
            ], 404);
        }

        $diagnostic->conditions()->detach($conditionId);

        return response()->json([
            'message' => 'Removed'
        ], 200);
    }


}
