<?php

namespace App\Http\Controllers;

use App\Http\Resources\ConditionResource;
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
        return ConditionResource::collection(
            Condition::orderBy('name', 'asc')->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreConditionRequest $request)
    {
        $data = $request->validated();
        $condition = Condition::create($data);
        return new ConditionResource($condition);
    }

    /**
     * Display the specified resource.
     */
    public function show(Condition $condition)
    {
        return new ConditionResource($condition);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateConditionRequest $request, Condition $condition)
    {
        $data = $request->validated();
        $condition -> update($data);
        return new ConditionResource($condition);
    }

    /**
     * User view: User conditions.
     */

    public function userConditions(Request $request)
    {
        $user = auth('sanctum')->user();


        $patient = $user->patient;

        if (!$patient) {
            return response()->json([
                'message' => 'Paciente não encontrado'
            ], 404);
        }

        $conditions = $patient->conditions;

        return response()->json([
            'conditions' => $conditions
        ], 200);
    }

    /**
     * Admin view: User conditions.
     */
    public function patientConditions(Patient $patient)
    {
        $patient->load('conditions');

        return response()->json($patient, 200);
    }

    /**
     * Delete a condition (soft delete)
     */
    public function destroy(Condition $condition)
    {
        $condition->delete();
        return response()->json([
            'message' => 'Eliminado'
        ], 204);
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

    /**
     * Admin view: Restore a soft deleted condition
     */

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

}
