<?php

namespace App\Http\Controllers;

use App\Http\Resources\DailyNutritionResource;
use App\Models\DailyNutrition;
use App\Http\Requests\StoreDailyNutritionRequest;
use App\Http\Requests\UpdateDailyNutritionRequest;
use App\Models\Patient;
use Illuminate\Http\Request;

class DailyNutritionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return DailyNutritionResource::collection(DailyNutrition::all());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDailyNutritionRequest $request)
    {
        $data = $request->validated();
        $daily_nutrition = DailyNutrition::create($data);
        return response()->json($daily_nutrition);
    }

    /**
     * Display the specified resource.
     */
    public function show(DailyNutrition $dailyNutrition)
    {
        return new DailyNutritionResource($dailyNutrition);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDailyNutritionRequest $request, DailyNutrition $dailyNutrition)
    {
        $data = $request->validated();
        $dailyNutrition -> update($data);
        return response()->json($dailyNutrition);
    }

    /**
     * Delete a DailyNutrition (soft delete)
     */
    public function destroy(DailyNutrition $dailyNutrition)
    {
        $dailyNutrition->delete();
        return response()->json(null, 204);
    }

    /**
     * List all soft deleted DailyNutritions
     */
    public function indexSoftDelete()
    {
        $dailyNutritions = DailyNutrition::onlyTrashed()->get();
        return response()->json($dailyNutritions, 200);
    }

    /**
     * Show a specific soft deleted DailyNutrition
     */
    public function showSoftDelete($id)
    {
        $dailyNutrition = DailyNutrition::onlyTrashed()->findOrFail($id);
        return response()->json($dailyNutrition, 200);
    }

    /**
     * Restore a soft deleted DailyNutrition
     */
    public function restoreSoftDelete($id)
    {
        $dailyNutrition = DailyNutrition::onlyTrashed()->findOrFail($id);
        $dailyNutrition->restore();
        return response()->json($dailyNutrition, 200);
    }

    public function userDailyNutritions(Request $request)
    {
        $user = auth('sanctum')->user();


        $patient = $user->patient;

        if (!$patient) {
            return response()->json([
                'message' => 'Paciente não encontrado'
            ], 404);
        }

        $dailyNutritions = $patient->dailyNutritions;

        return response()->json([
            'dailyNutritions' => $dailyNutritions
        ], 200);
    }

    public function patientDailyNutritions(Patient $patient)
    {
        $patient->load('dailyNutritions');

        return response()->json($patient, 200);
    }

    public function patientDailyNutritionsSoftDelete(Patient $patient)
    {
        $dailyNutritions = $patient->dailyNutritions()
            ->onlyTrashed()
            ->get();

        return response()->json([
            'patient' => $patient,
            'daily_nutritions' => $dailyNutritions
        ], 200);
    }

}
