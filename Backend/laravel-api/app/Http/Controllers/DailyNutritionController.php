<?php

namespace App\Http\Controllers;

use App\Models\DailyNutrition;
use App\Http\Requests\StoreDailyNutritionRequest;
use App\Http\Requests\UpdateDailyNutritionRequest;

class DailyNutritionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dailyNutritions = DailyNutrition::all();
        return response()->json($dailyNutritions);
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
        return response ()->json($dailyNutrition);
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
     * Remove the specified resource from storage.
     */
    public function destroy(DailyNutrition $dailyNutrition)
    {
        //
    }

    public function patientDailyNutritions()
    {
        $patient = auth()->user()->patient;
        $patientWithDailyNutrition = $patient->load('dailyNutritions');
        return response()->json(['data'=>$patientWithDailyNutrition], 200);
    }
}
