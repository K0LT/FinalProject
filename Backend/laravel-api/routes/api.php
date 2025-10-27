<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


//Allergies
Route::get('allergies', [\App\Http\Controllers\AllergieController::class, 'index']);
Route::get('allergies/{allergie}', [\App\Http\Controllers\AllergieController::class, 'show']);
Route::post('allergies', [\App\Http\Controllers\AllergieController::class, 'store']);

//Appointments
Route::get('appointments', [\App\Http\Controllers\AppointmentController::class, 'index']);
Route::post('appointments', [\App\Http\Controllers\AppointmentController::class, 'store']);
Route::get('appointments/{appointment}', [\App\Http\Controllers\AppointmentController::class, 'show']);

//Conditions
Route::get('conditions', [\App\Http\Controllers\ConditionController::class, 'index']);
Route::get('conditions/{condition}', [\App\Http\Controllers\ConditionController::class, 'show']);
Route::post('conditions', [\App\Http\Controllers\ConditionController::class, 'store']);

//DailyNutritions
Route::get('daily_nutritions', [\App\Http\Controllers\DailyNutritionController::class, 'index']);
Route::get('daily_nutritions/{daily_nutrition}', [\App\Http\Controllers\DailyNutritionController::class, 'show']);
Route::post('daily_nutritions', [\App\Http\Controllers\DailyNutritionController::class, 'store']);

//Diagnostics
Route::get('diagnostics', [\App\Http\Controllers\DiagnosticController::class, 'index']);
Route::get('diagnostics/{diagnostic}', [\App\Http\Controllers\DiagnosticController::class, 'show']);
Route::post('diagnostics', [\App\Http\Controllers\DiagnosticController::class, 'store']);

//Exercises
Route::get('exercises', [\App\Http\Controllers\ExerciseController::class, 'index']);
Route::get('exercises/{exercise}', [\App\Http\Controllers\ExerciseController::class, 'show']);
Route::post('exercises', [\App\Http\Controllers\ExerciseController::class, 'store']);

//ExercisesPatients
Route::get('exercise_patients', [\App\Http\Controllers\ExercisePatientController::class, 'index']);
Route::get('exercise_patients/{exercise_patient}', [\App\Http\Controllers\ExercisePatientController::class, 'show']);
Route::post('exercise_patients', [\App\Http\Controllers\ExercisePatientController::class, 'store']);

//GoalMilestones
Route::get('goal_milestones', [\App\Http\Controllers\GoalMilestoneController::class, 'index']);
Route::get('goal_milestones/{goal_milestone}', [\App\Http\Controllers\GoalMilestoneController::class, 'show']);
Route::post('goal_milestones', [\App\Http\Controllers\GoalMilestoneController::class, 'store']);

//NutritionalGoals
Route::get('nutritional_goals', [\App\Http\Controllers\NutritionalGoalController::class, 'index']);
Route::get('nutritional_goals/{nutritional_goal}', [\App\Http\Controllers\NutritionalGoalController::class, 'show']);
Route::post('nutritional_goals', [\App\Http\Controllers\NutritionalGoalController::class, 'store']);

//Patients
Route::get('patients', [\App\Http\Controllers\PatientController::class, 'index']);
Route::get('patients/{patient}', [\App\Http\Controllers\PatientController::class, 'show']);
Route::post('patients', [\App\Http\Controllers\PatientController::class, 'store']);
Route::get('patients/{patient}/diagnostics', [\App\Http\Controllers\PatientController::class, 'index_diagnostics']);

//Profiles
Route::get('profiles', [\App\Http\Controllers\ProfileController::class, 'index']);
Route::get('profiles/{profile}', [\App\Http\Controllers\ProfileController::class, 'show']);
Route::post('profiles', [\App\Http\Controllers\ProfileController::class, 'store']);

//ProgressNotes
Route::get('progress_notes', [\App\Http\Controllers\ProgressNoteController::class, 'index']);
Route::get('progress_notes/{progress_note}', [\App\Http\Controllers\ProgressNoteController::class, 'show']);
Route::post('progress_notes', [\App\Http\Controllers\ProgressNoteController::class, 'store']);

//Roles
Route::get('roles', [\App\Http\Controllers\RoleController::class, 'index']);
Route::get('roles/{role}', [\App\Http\Controllers\RoleController::class, 'show']);
Route::post('roles', [\App\Http\Controllers\RoleController::class, 'store']);

//Treatments
Route::get('treatments', [\App\Http\Controllers\TreatmentController::class, 'index']);
Route::get('treatments/{treatment}', [\App\Http\Controllers\TreatmentController::class, 'show']);
Route::post('treatments', [\App\Http\Controllers\TreatmentController::class, 'store']);

//TreatmentGoals
Route::get('treatment_goals', [\App\Http\Controllers\TreatmentGoalController::class, 'index']);
Route::get('treatment_goals/{treatment_goal}', [\App\Http\Controllers\TreatmentGoalController::class, 'show']);
Route::post('treatment_goals', [\App\Http\Controllers\TreatmentGoalController::class, 'store']);

//Users
Route::get('/users', [\App\Http\Controllers\UserController::class, 'index']);
Route::post('/users', [\App\Http\Controllers\UserController::class, 'store']);
Route::get('users/{user}', [\App\Http\Controllers\UserController::class, 'show']);

//WeightTrackings
Route::get('weight_trackings', [\App\Http\Controllers\WeightTrackingController::class, 'index']);
Route::get('weight_trackings/{weight_tracking}', [\App\Http\Controllers\WeightTrackingController::class, 'show']);
Route::post('weight_trackings', [\App\Http\Controllers\WeightTrackingController::class, 'store']);














