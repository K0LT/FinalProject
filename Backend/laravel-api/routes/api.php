<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Users
Route::get('/users', [\App\Http\Controllers\UserController::class, 'index']);
Route::post('/users', [\App\Http\Controllers\UserController::class, 'store']);
Route::get('users/{user}', [\App\Http\Controllers\UserController::class, 'show']);

//Profiles
Route::get('profiles', [\App\Http\Controllers\ProfileController::class, 'index']);
Route::get('profiles/{profile}', [\App\Http\Controllers\ProfileController::class, 'show']);
Route::post('profiles', [\App\Http\Controllers\ProfileController::class, 'store']);
//Roles
Route::get('roles', [\App\Http\Controllers\RoleController::class, 'index']);
Route::get('roles/{role}', [\App\Http\Controllers\RoleController::class, 'show']);

//Patients
Route::get('patients', [\App\Http\Controllers\PatientController::class, 'index']);
Route::get('patients/{patient}', [\App\Http\Controllers\PatientController::class, 'show']);

//Appointments
Route::get('appointments', [\App\Http\Controllers\AppointmentController::class, 'index']);
Route::post('appointments', [\App\Http\Controllers\AppointmentController::class, 'store']);
Route::get('appointments/{appointment}', [\App\Http\Controllers\AppointmentController::class, 'show']);

//Diagnostics
Route::get('diagnostics', [\App\Http\Controllers\DiagnosticController::class, 'index']);
Route::get('diagnostics/{diagnostic}', [\App\Http\Controllers\DiagnosticController::class, 'show']);

//Allergies
Route::get('allergies', [\App\Http\Controllers\AllergieController::class, 'index']);
Route::get('allergies/{allergie}', [\App\Http\Controllers\AllergieController::class, 'show']);

//Conditions
Route::get('conditions', [\App\Http\Controllers\ConditionController::class, 'index']);
Route::get('conditions/{condition}', [\App\Http\Controllers\ConditionController::class, 'show']);

//DailyNutritions
Route::get('daily_nutritions', [\App\Http\Controllers\DailyNutritionController::class, 'index']);
Route::get('daily_nutritions/{daily_nutrition}', [\App\Http\Controllers\DailyNutritionController::class, 'show']);

//Exercises
Route::get('exercises', [\App\Http\Controllers\ExerciseController::class, 'index']);
Route::get('exercises/{exercise}', [\App\Http\Controllers\ExerciseController::class, 'show']);

//ExercisesPatients
Route::get('exercise_patients', [\App\Http\Controllers\ExercisePatientController::class, 'index']);
Route::get('exercise_patients/{exercise_patient}', [\App\Http\Controllers\ExercisePatientController::class, 'show']);

//GoalMillestones
Route::get('goal_millestones', [\App\Http\Controllers\GoalMillestoneController::class, 'index']);
Route::get('goal_millestones/{goal_millestone}', [\App\Http\Controllers\GoalMillestoneController::class, 'show']);

//NutritionalGoals
Route::get('nutritional_goals', [\App\Http\Controllers\NutritionalGoalController::class, 'index']);
Route::get('nutritional_goals/{nutritional_goal}', [\App\Http\Controllers\NutritionalGoalController::class, 'show']);


//ProgressNotes
Route::get('progress_notes', [\App\Http\Controllers\ProgressNoteController::class, 'index']);
Route::get('progress_notes/{progress_note}', [\App\Http\Controllers\ProgressNoteController::class, 'show']);

//Treatments
Route::get('treatments', [\App\Http\Controllers\TreatmentController::class, 'index']);
Route::get('treatments/{treatment}', [\App\Http\Controllers\TreatmentController::class, 'show']);

//TreatmentGoals
Route::get('treatment_goals', [\App\Http\Controllers\TreatmentGoalController::class, 'index']);
Route::get('treatment_goals/{treatment_goal}', [\App\Http\Controllers\TreatmentGoalController::class, 'show']);

//WeightTrackings
Route::get('weight_trackings', [\App\Http\Controllers\WeightTrackingController::class, 'index']);
Route::get('weight_trackings/{weight_tracking}', [\App\Http\Controllers\WeightTrackingController::class, 'show']);

