<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');




Route::post('/users', [\App\Http\Controllers\UserController::class, 'store']);


Route::middleware('auth:sanctum')->group(function () {


});

//Allergies
Route::get('allergies', [\App\Http\Controllers\AllergyController::class, 'index']);
Route::get('allergies/{allergy}', [\App\Http\Controllers\AllergyController::class, 'show']);
Route::post('allergies', [\App\Http\Controllers\AllergyController::class, 'store']);
Route::patch('allergies/{allergy}', [\App\Http\Controllers\AllergyController::class, 'update']);
Route::delete('allergies/{allergy}', [\App\Http\Controllers\AllergyController::class, 'destroy']);
Route::get('soft_delete/allergies/', [\App\Http\Controllers\AllergyController::class, 'indexSoftDelete']);
Route::get('soft_delete/allergies/{id}', [\App\Http\Controllers\AllergyController::class, 'showSoftDelete']);
Route::patch('soft_delete/allergies/restore/{id}', [\App\Http\Controllers\AllergyController::class, 'restoreSoftDelete']);

//Appointments
Route::get('appointments', [\App\Http\Controllers\AppointmentController::class, 'index']);
    //->middleware('can:viewAny,App\Models\Appointment');
Route::post('appointments', [\App\Http\Controllers\AppointmentController::class, 'store']);
Route::get('appointments/{appointment}', [\App\Http\Controllers\AppointmentController::class, 'show']);
    //->middleware('can:view,appointment');
Route::patch('appointments/{appointment}', [\App\Http\Controllers\AppointmentController::class, 'update']);
Route::delete('appointments/{appointment}', [\App\Http\Controllers\AppointmentController::class, 'destroy']);
Route::get('soft_delete/appointments', [\App\Http\Controllers\AppointmentController::class, 'indexSoftDelete']);
Route::get('soft_delete/appointments/{id}', [\App\Http\Controllers\AppointmentController::class, 'showSoftDelete']);
Route::patch('soft_delete/appointments/restore/{id}', [\App\Http\Controllers\AppointmentController::class, 'restoreSoftDelete']);


//Conditions
Route::get('conditions', [\App\Http\Controllers\ConditionController::class, 'index']);
Route::get('conditions/{condition}', [\App\Http\Controllers\ConditionController::class, 'show']);
Route::post('conditions', [\App\Http\Controllers\ConditionController::class, 'store']);
Route::patch('conditions/{condition}', [\App\Http\Controllers\ConditionController::class, 'update']);
Route::delete('conditions/{condition}', [\App\Http\Controllers\ConditionController::class, 'destroy']);
Route::get('soft_delete/conditions', [\App\Http\Controllers\ConditionController::class, 'indexSoftDelete']);
Route::get('soft_delete/conditions/{id}', [\App\Http\Controllers\ConditionController::class, 'showSoftDelete']);
Route::patch('soft_delete/conditions/restore/{id}', [\App\Http\Controllers\ConditionController::class, 'restoreSoftDelete']);



//DailyNutritions
Route::get('daily_nutritions', [\App\Http\Controllers\DailyNutritionController::class, 'index']);
Route::get('daily_nutritions/{daily_nutrition}', [\App\Http\Controllers\DailyNutritionController::class, 'show']);
Route::post('daily_nutritions', [\App\Http\Controllers\DailyNutritionController::class, 'store']);
Route::patch('daily_nutritions/{daily_nutrition}', [\App\Http\Controllers\DailyNutritionController::class, 'update']);
Route::delete('daily_nutritions/{daily_nutrition}', [\App\Http\Controllers\DailyNutritionController::class, 'destroy']);
Route::get('soft_delete/daily_nutritions', [\App\Http\Controllers\DailyNutritionController::class, 'indexSoftDelete']);
Route::get('soft_delete/daily_nutritions/{id}', [\App\Http\Controllers\DailyNutritionController::class, 'showSoftDelete']);
Route::patch('soft_delete/daily_nutritions/restore/{id}', [\App\Http\Controllers\DailyNutritionController::class, 'restoreSoftDelete']);



//Diagnostics
Route::get('diagnostics', [\App\Http\Controllers\DiagnosticController::class, 'index']);
Route::get('diagnostics/{diagnostic}', [\App\Http\Controllers\DiagnosticController::class, 'show']);
Route::post('diagnostics', [\App\Http\Controllers\DiagnosticController::class, 'store']);
Route::patch('diagnostics/{diagnostic}', [\App\Http\Controllers\DiagnosticController::class, 'update']);
Route::delete('diagnostics/{diagnostic}', [\App\Http\Controllers\DiagnosticController::class, 'destroy']);
Route::get('soft_delete/diagnostics', [\App\Http\Controllers\DiagnosticController::class, 'indexSoftDelete']);
Route::get('soft_delete/diagnostics/{id}', [\App\Http\Controllers\DiagnosticController::class, 'showSoftDelete']);
Route::patch('soft_delete/diagnostics/restore/{id}', [\App\Http\Controllers\DiagnosticController::class, 'restoreSoftDelete']);



//Exercises
Route::get('exercises', [\App\Http\Controllers\ExerciseController::class, 'index']);
Route::get('exercises/{exercise}', [\App\Http\Controllers\ExerciseController::class, 'show']);
Route::post('exercises', [\App\Http\Controllers\ExerciseController::class, 'store']);
Route::patch('exercises/{exercise}', [\App\Http\Controllers\ExerciseController::class, 'update']);
Route::delete('exercises/{exercise}', [\App\Http\Controllers\ExerciseController::class, 'destroy']);
Route::get('soft_delete/exercises', [\App\Http\Controllers\ExerciseController::class, 'indexSoftDelete']);
Route::get('soft_delete/exercises/{id}', [\App\Http\Controllers\ExerciseController::class, 'showSoftDelete']);
Route::patch('soft_delete/exercises/restore/{id}', [\App\Http\Controllers\ExerciseController::class, 'restoreSoftDelete']);



//ExercisesPatients
Route::get('exercise_patients', [\App\Http\Controllers\ExercisePatientController::class, 'index']);
Route::get('exercise_patients/{exercise_patient}', [\App\Http\Controllers\ExercisePatientController::class, 'show']);
Route::post('exercise_patients', [\App\Http\Controllers\ExercisePatientController::class, 'store']);
Route::patch('exercise_patients/{exercise_patient}', [\App\Http\Controllers\ExercisePatientController::class, 'update']);

//GoalMilestones
Route::get('goal_milestones', [\App\Http\Controllers\GoalMilestoneController::class, 'index']);
Route::get('goal_milestones/{goal_milestone}', [\App\Http\Controllers\GoalMilestoneController::class, 'show']);
Route::post('goal_milestones', [\App\Http\Controllers\GoalMilestoneController::class, 'store']);
Route::patch('goal_milestones/{goal_milestone}', [\App\Http\Controllers\GoalMilestoneController::class, 'update']);
Route::delete('goal_milestones/{goal_milestone}', [\App\Http\Controllers\GoalMilestoneController::class, 'destroy']);
Route::get('soft_delete/goal_milestones', [\App\Http\Controllers\GoalMilestoneController::class, 'indexSoftDelete']);
Route::get('soft_delete/goal_milestones/{id}', [\App\Http\Controllers\GoalMilestoneController::class, 'showSoftDelete']);
Route::patch('soft_delete/goal_milestones/restore/{id}', [\App\Http\Controllers\GoalMilestoneController::class, 'restoreSoftDelete']);



//NutritionalGoals
Route::get('nutritional_goals', [\App\Http\Controllers\NutritionalGoalController::class, 'index']);
Route::get('nutritional_goals/{nutritional_goal}', [\App\Http\Controllers\NutritionalGoalController::class, 'show']);
Route::post('nutritional_goals', [\App\Http\Controllers\NutritionalGoalController::class, 'store']);
Route::patch('nutritional_goals/{nutritional_goal}', [\App\Http\Controllers\NutritionalGoalController::class, 'update']);

//Patients
Route::get('patients', [\App\Http\Controllers\PatientController::class, 'index']);

Route::get('patients/{patient}', [\App\Http\Controllers\PatientController::class, 'show'])
    ->middleware('can:view,patient');

Route::post('patients', [\App\Http\Controllers\PatientController::class, 'store']);
Route::patch('patients/{patient}', [\App\Http\Controllers\PatientController::class, 'update']);
Route::get('patients/{patient}/{relation}', [\App\Http\Controllers\PatientController::class, 'get_relation']);

//ProgressNotes
Route::get('progress_notes', [\App\Http\Controllers\ProgressNoteController::class, 'index']);
Route::get('progress_notes/{progress_note}', [\App\Http\Controllers\ProgressNoteController::class, 'show']);
Route::post('progress_notes', [\App\Http\Controllers\ProgressNoteController::class, 'store']);
Route::patch('progress_notes/{progress_note}', [\App\Http\Controllers\ProgressNoteController::class, 'update']);

//Roles
Route::get('roles', [\App\Http\Controllers\RoleController::class, 'index']);
Route::get('roles/{role}', [\App\Http\Controllers\RoleController::class, 'show']);
Route::post('roles', [\App\Http\Controllers\RoleController::class, 'store']);
Route::patch('roles/{role}', [\App\Http\Controllers\RoleController::class, 'update']);

//Treatments
Route::get('treatments', [\App\Http\Controllers\TreatmentController::class, 'index']);
Route::get('treatments/{treatment}', [\App\Http\Controllers\TreatmentController::class, 'show']);
Route::post('treatments', [\App\Http\Controllers\TreatmentController::class, 'store']);
Route::patch('treatments/{treatment}', [\App\Http\Controllers\TreatmentController::class, 'update']);

//TreatmentGoals
Route::get('treatment_goals', [\App\Http\Controllers\TreatmentGoalController::class, 'index']);
Route::get('treatment_goals/{treatment_goal}', [\App\Http\Controllers\TreatmentGoalController::class, 'show']);
Route::post('treatment_goals', [\App\Http\Controllers\TreatmentGoalController::class, 'store']);
Route::patch('treatment_goals/{treatment_goal}', [\App\Http\Controllers\TreatmentGoalController::class, 'update']);

//Users
Route::get('/users', [\App\Http\Controllers\UserController::class, 'index']);
// Temporarily moved outside the group to test
Route::get('users/{user}', [\App\Http\Controllers\UserController::class, 'show']);

//WeightTrackings
Route::get('weight_trackings', [\App\Http\Controllers\WeightTrackingController::class, 'index']);
Route::get('weight_trackings/{weight_tracking}', [\App\Http\Controllers\WeightTrackingController::class, 'show']);
Route::post('weight_trackings', [\App\Http\Controllers\WeightTrackingController::class, 'store']);
Route::patch('weight_trackings/{weight_tracking}', [\App\Http\Controllers\WeightTrackingController::class, 'update']);

//Symptom
Route::get('symptoms', [\App\Http\Controllers\SymptomController::class, 'index']);
Route::post('symptoms', [\App\Http\Controllers\SymptomController::class, 'store']);
Route::get('symptoms/{symptom}', [\App\Http\Controllers\SymptomController::class, 'show']);
Route::patch('symptoms/{symptom}', [\App\Http\Controllers\SymptomController::class, 'update']);








