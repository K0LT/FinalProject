<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);




    // -----------------------------
    // Allergies
    // -----------------------------
    Route::get('allergies', [\App\Http\Controllers\AllergyController::class, 'index']);
    Route::get('allergies/{allergy}', [\App\Http\Controllers\AllergyController::class, 'show']);
    Route::middleware('auth:sanctum')->get('user/allergies', [\App\Http\Controllers\AllergyController::class, 'patientAllergies']);
    Route::post('allergies', [\App\Http\Controllers\AllergyController::class, 'store']);
    Route::patch('allergies/{allergy}', [\App\Http\Controllers\AllergyController::class, 'update']);


    // -----------------------------
    // Appointments
    // -----------------------------
    Route::get('appointments', [\App\Http\Controllers\AppointmentController::class, 'index']);
    Route::post('appointments', [\App\Http\Controllers\AppointmentController::class, 'store']);
    Route::get('appointments/{appointment}', [\App\Http\Controllers\AppointmentController::class, 'show']);
    Route::patch('appointments/{appointment}', [\App\Http\Controllers\AppointmentController::class, 'update']);
    Route::middleware('auth:sanctum')->post('user/createAppointment', [\App\Http\Controllers\AppointmentController::class, 'patientCreateAppointment']);
    Route::middleware('auth:sanctum')->get('/user/appointments', [\App\Http\Controllers\AppointmentController::class, 'patientAppointments']);

    // -----------------------------
    // Conditions
    // -----------------------------
    Route::get('conditions', [\App\Http\Controllers\ConditionController::class, 'index']);
    Route::get('conditions/{condition}', [\App\Http\Controllers\ConditionController::class, 'show']);
    Route::middleware('auth:sanctum')->get('user/conditions', [\App\Http\Controllers\ConditionController::class, 'patientConditions']);
    Route::post('conditions', [\App\Http\Controllers\ConditionController::class, 'store']);
    Route::patch('conditions/{condition}', [\App\Http\Controllers\ConditionController::class, 'update']);


    // -----------------------------
    // Daily Nutritions
    // -----------------------------
    Route::get('daily_nutritions', [\App\Http\Controllers\DailyNutritionController::class, 'index']);
    Route::get('daily_nutritions/{daily_nutrition}', [\App\Http\Controllers\DailyNutritionController::class, 'show']);
    Route::post('daily_nutritions', [\App\Http\Controllers\DailyNutritionController::class, 'store']);
    Route::patch('daily_nutritions/{daily_nutrition}', [\App\Http\Controllers\DailyNutritionController::class, 'update']);


    // -----------------------------
    // Diagnostics
    // -----------------------------
    Route::get('diagnostics', [\App\Http\Controllers\DiagnosticController::class, 'index']);
    Route::get('diagnostics/{diagnostic}', [\App\Http\Controllers\DiagnosticController::class, 'show']);
    Route::post('diagnostics', [\App\Http\Controllers\DiagnosticController::class, 'store']);
    Route::patch('diagnostics/{diagnostic}', [\App\Http\Controllers\DiagnosticController::class, 'update']);


    // -----------------------------
    // Exercises
    // -----------------------------
    Route::get('exercises', [\App\Http\Controllers\ExerciseController::class, 'index']);
    Route::get('exercises/{exercise}', [\App\Http\Controllers\ExerciseController::class, 'show']);
    Route::post('exercises', [\App\Http\Controllers\ExerciseController::class, 'store']);
    Route::patch('exercises/{exercise}', [\App\Http\Controllers\ExerciseController::class, 'update']);


    // -----------------------------
    // Exercise Patients
    // -----------------------------
    Route::get('exercise_patients', [\App\Http\Controllers\ExercisePatientController::class, 'index']);
    Route::get('exercise_patients/{exercise_patient}', [\App\Http\Controllers\ExercisePatientController::class, 'show']);
    Route::post('exercise_patients', [\App\Http\Controllers\ExercisePatientController::class, 'store']);
    Route::patch('exercise_patients/{exercise_patient}', [\App\Http\Controllers\ExercisePatientController::class, 'update']);


    // -----------------------------
    // Goal Milestones
    // -----------------------------
    Route::get('goal_milestones', [\App\Http\Controllers\GoalMilestoneController::class, 'index']);
    Route::get('goal_milestones/{goal_milestone}', [\App\Http\Controllers\GoalMilestoneController::class, 'show']);
    Route::post('goal_milestones', [\App\Http\Controllers\GoalMilestoneController::class, 'store']);
    Route::patch('goal_milestones/{goal_milestone}', [\App\Http\Controllers\GoalMilestoneController::class, 'update']);


    // -----------------------------
    // Nutritional Goals
    // -----------------------------
    Route::get('nutritional_goals', [\App\Http\Controllers\NutritionalGoalController::class, 'index']);
    Route::get('nutritional_goals/{nutritional_goal}', [\App\Http\Controllers\NutritionalGoalController::class, 'show']);
    Route::post('nutritional_goals', [\App\Http\Controllers\NutritionalGoalController::class, 'store']);
    Route::patch('nutritional_goals/{nutritional_goal}', [\App\Http\Controllers\NutritionalGoalController::class, 'update']);


    // -----------------------------
    // Patients
    // -----------------------------
    Route::get('patients', [\App\Http\Controllers\PatientController::class, 'index'])
        ->middleware('can:viewAny,App\Models\Patient');

    Route::get('patients/{patient}', [\App\Http\Controllers\PatientController::class, 'show'])
        ->middleware('can:view,patient');

    Route::post('patients', [\App\Http\Controllers\PatientController::class, 'store']);
    Route::patch('patients/{patient}', [\App\Http\Controllers\PatientController::class, 'update']);

    // Relação dinâmica: /patients/{patient}/{relation}
    Route::get('patients/{patient}/{relation}', [\App\Http\Controllers\PatientController::class, 'get_relation']);


    // -----------------------------
    // Progress Notes
    // -----------------------------
    Route::get('progress_notes', [\App\Http\Controllers\ProgressNoteController::class, 'index']);
    Route::get('progress_notes/{progress_note}', [\App\Http\Controllers\ProgressNoteController::class, 'show']);
    Route::post('progress_notes', [\App\Http\Controllers\ProgressNoteController::class, 'store']);
    Route::patch('progress_notes/{progress_note}', [\App\Http\Controllers\ProgressNoteController::class, 'update']);


    // -----------------------------
    // Roles
    // -----------------------------
    Route::get('roles', [\App\Http\Controllers\RoleController::class, 'index']);
    Route::get('roles/{role}', [\App\Http\Controllers\RoleController::class, 'show']);
    Route::post('roles', [\App\Http\Controllers\RoleController::class, 'store']);
    Route::patch('roles/{role}', [\App\Http\Controllers\RoleController::class, 'update']);


    // -----------------------------
    // Treatments
    // -----------------------------
    Route::get('treatments', [\App\Http\Controllers\TreatmentController::class, 'index']);
    Route::get('treatments/{treatment}', [\App\Http\Controllers\TreatmentController::class, 'show']);
    Route::post('treatments', [\App\Http\Controllers\TreatmentController::class, 'store']);
    Route::patch('treatments/{treatment}', [\App\Http\Controllers\TreatmentController::class, 'update']);


    // -----------------------------
    // Treatment Goals
    // -----------------------------
    Route::get('treatment_goals', [\App\Http\Controllers\TreatmentGoalController::class, 'index']);
    Route::get('treatment_goals/{treatment_goal}', [\App\Http\Controllers\TreatmentGoalController::class, 'show']);
    Route::post('treatment_goals', [\App\Http\Controllers\TreatmentGoalController::class, 'store']);
    Route::patch('treatment_goals/{treatment_goal}', [\App\Http\Controllers\TreatmentGoalController::class, 'update']);


    // -----------------------------
    // Users
    // -----------------------------
    Route::get('users', [\App\Http\Controllers\UserController::class, 'index']);
    Route::post('users', [\App\Http\Controllers\UserController::class, 'store']);
    Route::get('users/{user}', [\App\Http\Controllers\UserController::class, 'show']);


    // -----------------------------
    // Weight Trackings
    // -----------------------------
    Route::get('weight_trackings', [\App\Http\Controllers\WeightTrackingController::class, 'index']);
    Route::get('weight_trackings/{weight_tracking}', [\App\Http\Controllers\WeightTrackingController::class, 'show']);
    Route::post('weight_trackings', [\App\Http\Controllers\WeightTrackingController::class, 'store']);
    Route::patch('weight_trackings/{weight_tracking}', [\App\Http\Controllers\WeightTrackingController::class, 'update']);


    // -----------------------------
    // Symptoms
    // -----------------------------
    Route::get('symptoms', [\App\Http\Controllers\SymptomController::class, 'index']);
    Route::post('symptoms', [\App\Http\Controllers\SymptomController::class, 'store']);
    Route::get('symptoms/{symptom}', [\App\Http\Controllers\SymptomController::class, 'show']);
    Route::patch('symptoms/{symptom}', [\App\Http\Controllers\SymptomController::class, 'update']);


