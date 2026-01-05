<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//
//})->middleware('auth:sanctum');





Route::post('/users', [\App\Http\Controllers\UserController::class, 'store']);
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [\App\Http\Controllers\UserController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::get('user/allergies', [\App\Http\Controllers\AllergyController::class, 'userAllergies'])
        ->middleware('can:isPatient');
    Route::get('user/appointments', [\App\Http\Controllers\AppointmentController::class, 'userAppointments'])
        ->middleware('can:isPatient');//Appointments + Progress Notes
    Route::get('user/conditions', [\App\Http\Controllers\ConditionController::class, 'userConditions'])
        ->middleware('can:isPatient');
    Route::get('user/daily_nutritions', [\App\Http\Controllers\DailyNutritionController::class, 'userDailyNutritions'])
        ->middleware('can:isPatient');
    Route::get('user/diagnostics', [\App\Http\Controllers\DiagnosticController::class, 'userDiagnostics'])
        ->middleware('can:isPatient');//Diagnostic + Symptoms
    Route::get('user/exercises', [\App\Http\Controllers\ExerciseController::class, 'userExercises'])
        ->middleware('can:isPatient');
    Route::get('user/treatment_goals', [\App\Http\Controllers\TreatmentGoalController::class, 'userTreatmentGoals'])
        ->middleware('can:isPatient');//TreatmnentGoals + GoalMilestones
    Route::get('user/nutritional_goals', [\App\Http\Controllers\NutritionalGoalController::class, 'userNutritionalGoals'])
        ->middleware('can:isPatient');
    Route::get('user/patient', [\App\Http\Controllers\PatientController::class, 'userPatient'])
        ->middleware('can:isPatient');
    Route::get('user/treatments', [\App\Http\Controllers\TreatmentController::class, 'userTreaments'])
        ->middleware('can:isPatient');
    Route::get('user/weight_trackings', [\App\Http\Controllers\WeightTrackingController::class, 'userWeightTrackings'])
        ->middleware('can:isPatient');


// APPOINTMENTS
    Route::get('appointments', [\App\Http\Controllers\AppointmentController::class, 'index'])
    ->middleware('can:viewAny,' . \App\Models\Appointment::class);
// STORE
    Route::post('appointments', [\App\Http\Controllers\AppointmentController::class, 'store'])
    ->middleware('can:create,' . \App\Models\Appointment::class);
// SHOW
    Route::get('appointments/{appointment}', [\App\Http\Controllers\AppointmentController::class, 'show'])
     ->middleware('can:view,appointment');
// UPDATE
    Route::patch('appointments/{appointment}', [\App\Http\Controllers\AppointmentController::class, 'update'])
    ->middleware('can:update,appointment');
// DELETE (soft delete)
    Route::delete('appointments/{appointment}', [\App\Http\Controllers\AppointmentController::class, 'destroy'])
    ->middleware('can:delete,appointment');
// INDEX SOFT DELETED
    Route::get('soft_delete/appointments', [\App\Http\Controllers\AppointmentController::class, 'indexSoftDelete'])
    ->middleware('can:viewAnySoftDeleted,' . \App\Models\Appointment::class);
// SHOW SOFT DELETED
    Route::get('soft_delete/appointments/{appointment}', [\App\Http\Controllers\AppointmentController::class, 'showSoftDelete'])
    ->middleware('can:viewSoftDeleted');
// RESTORE
    Route::patch('soft_delete/appointments/restore/{appointment}', [\App\Http\Controllers\AppointmentController::class, 'restoreSoftDelete'])
    ->middleware('can:restoreSoftDeleted');





// ALLERGIES
Route::get('allergies', [\App\Http\Controllers\AllergyController::class, 'index'])
    ->middleware('can:viewAny,' . \App\Models\Allergy::class);
// STORE
Route::post('allergies', [\App\Http\Controllers\AllergyController::class, 'store'])
    ->middleware('can:create,' . \App\Models\Allergy::class);
// SHOW
Route::get('allergies/{allergy}', [\App\Http\Controllers\AllergyController::class, 'show'])
    ->middleware('can:view,allergy');
// UPDATE
Route::patch('allergies/{allergy}', [\App\Http\Controllers\AllergyController::class, 'update'])
    ->middleware('can:update,allergy');
// DESTROY
Route::delete('allergies/{allergy}', [\App\Http\Controllers\AllergyController::class, 'destroy'])
    ->middleware('can:delete,allergy');
// INDEX SOFT DELETED
Route::get('soft_delete/allergies', [\App\Http\Controllers\AllergyController::class, 'indexSoftDelete'])
    ->middleware('can:viewAnySoftDeleted,' . \App\Models\Allergy::class);
// SHOW SOFT DELETED
Route::get('soft_delete/allergies/{allergy}', [\App\Http\Controllers\AllergyController::class, 'showSoftDelete'])
    ->middleware('can:viewSoftDeleted');
// RESTORE
Route::patch('soft_delete/allergies/restore/{allergy}', [\App\Http\Controllers\AllergyController::class, 'restoreSoftDelete'])
    ->middleware('can:restoreSoftDeleted');




// CONDITIONS
Route::get('conditions', [\App\Http\Controllers\ConditionController::class, 'index'])
    ->middleware('can:viewAny,' . \App\Models\Condition::class);
//STORE
Route::post('conditions', [\App\Http\Controllers\ConditionController::class, 'store'])
    ->middleware('can:create,' . \App\Models\Condition::class);
//SHOW
Route::get('conditions/{condition}', [\App\Http\Controllers\ConditionController::class, 'show'])
    ->middleware('can:view,condition');
//UPDATE
Route::patch('conditions/{condition}', [\App\Http\Controllers\ConditionController::class, 'update'])
    ->middleware('can:update,condition');
//DESTROY (SOFT DELETE)
Route::delete('conditions/{condition}', [\App\Http\Controllers\ConditionController::class, 'destroy'])
    ->middleware('can:delete,condition');
//INDEX SOFT DELETE
Route::get('soft_delete/conditions', [\App\Http\Controllers\ConditionController::class, 'indexSoftDelete'])
    ->middleware('can:viewAnySoftDeleted,' . \App\Models\Condition::class);
//SHOW SOFT DELETE
Route::get('soft_delete/conditions/{condition}', [\App\Http\Controllers\ConditionController::class, 'showSoftDelete'])
    ->middleware('can:viewSoftDeleted');
//RESTORE
Route::patch('soft_delete/conditions/restore/{condition}', [\App\Http\Controllers\ConditionController::class, 'restoreSoftDelete'])
    ->middleware('can:restoreSoftDeleted');




// DAILY NUTRITIONS
Route::get('daily_nutritions', [\App\Http\Controllers\DailyNutritionController::class, 'index'])
    ->middleware('can:viewAny,' . \App\Models\DailyNutrition::class);
//STORE
Route::post('daily_nutritions', [\App\Http\Controllers\DailyNutritionController::class, 'store'])
    ->middleware('can:create,' . \App\Models\DailyNutrition::class);
//SHOW
Route::get('daily_nutritions/{daily_nutrition}', [\App\Http\Controllers\DailyNutritionController::class, 'show'])
    ->middleware('can:view,daily_nutrition');
//UPDATE
Route::patch('daily_nutritions/{daily_nutrition}', [\App\Http\Controllers\DailyNutritionController::class, 'update'])
    ->middleware('can:update,daily_nutrition');
//DESTROY SOFT DELETE
Route::delete('daily_nutritions/{daily_nutrition}', [\App\Http\Controllers\DailyNutritionController::class, 'destroy'])
    ->middleware('can:delete,daily_nutrition');
//INDEX SOFT DELETE
Route::get('soft_delete/daily_nutritions', [\App\Http\Controllers\DailyNutritionController::class, 'indexSoftDelete'])
    ->middleware('can:viewAnySoftDeleted,' . \App\Models\DailyNutrition::class);
//SHOW SOFT DELETE
Route::get('soft_delete/daily_nutritions/{daily_nutrition}', [\App\Http\Controllers\DailyNutritionController::class, 'showSoftDelete'])
    ->middleware('can:viewSoftDeleted');
//RESTORES
Route::patch('soft_delete/daily_nutritions/restore/{daily_nutrition}', [\App\Http\Controllers\DailyNutritionController::class, 'restoreSoftDelete'])
    ->middleware('can:restoreSoftDeleted');




// DIAGNOSTICS
Route::get('diagnostics', [\App\Http\Controllers\DiagnosticController::class, 'index'])
    ->middleware('can:viewAny,' . \App\Models\Diagnostic::class);
//STORE
Route::post('diagnostics', [\App\Http\Controllers\DiagnosticController::class, 'store'])
    ->middleware('can:create,' . \App\Models\Diagnostic::class);
//SHOW
Route::get('diagnostics/{diagnostic}', [\App\Http\Controllers\DiagnosticController::class, 'show'])
    ->middleware('can:view,diagnostic');
//UPDATE
Route::patch('diagnostics/{diagnostic}', [\App\Http\Controllers\DiagnosticController::class, 'update'])
    ->middleware('can:update,diagnostic');
//DESTROY SOFT DELETE
Route::delete('diagnostics/{diagnostic}', [\App\Http\Controllers\DiagnosticController::class, 'destroy'])
    ->middleware('can:delete,diagnostic');
//INDEX SOFT DELETE
Route::get('soft_delete/diagnostics', [\App\Http\Controllers\DiagnosticController::class, 'indexSoftDelete'])
    ->middleware('can:viewAnySoftDeleted,' . \App\Models\Diagnostic::class);
//SHOW SOFT DELETE
Route::get('soft_delete/diagnostics/{diagnostic}', [\App\Http\Controllers\DiagnosticController::class, 'showSoftDelete'])
    ->middleware('can:viewSoftDeleted');
//RESTORE
Route::patch('soft_delete/diagnostics/restore/{diagnostic}', [\App\Http\Controllers\DiagnosticController::class, 'restoreSoftDelete'])
    ->middleware('can:restoreSoftDeleted');



// EXERCISES
Route::get('exercises', [\App\Http\Controllers\ExerciseController::class, 'index'])
    ->middleware('can:viewAny,' . \App\Models\Exercise::class);
// STORE
Route::post('exercises', [\App\Http\Controllers\ExerciseController::class, 'store'])
    ->middleware('can:create,' . \App\Models\Exercise::class);
// SHOW
Route::get('exercises/{exercise}', [\App\Http\Controllers\ExerciseController::class, 'show'])
    ->middleware('can:view,exercise');
// UPDATE
Route::patch('exercises/{exercise}', [\App\Http\Controllers\ExerciseController::class, 'update'])
    ->middleware('can:update,exercise');
// DELETE (soft delete)
Route::delete('exercises/{exercise}', [\App\Http\Controllers\ExerciseController::class, 'destroy'])
    ->middleware('can:delete,exercise');
// INDEX SOFT DELETED
Route::get('soft_delete/exercises', [\App\Http\Controllers\ExerciseController::class, 'indexSoftDelete'])
    ->middleware('can:viewAnySoftDeleted,' . \App\Models\Exercise::class);
// SHOW SOFT DELETED
Route::get('soft_delete/exercises/{exercise}', [\App\Http\Controllers\ExerciseController::class, 'showSoftDelete'])
    ->middleware('can:viewSoftDeleted');
// RESTORE
Route::patch('soft_delete/exercises/restore/{exercise}', [\App\Http\Controllers\ExerciseController::class, 'restoreSoftDelete'])
    ->middleware('can:restoreSoftDeleted');




// EXERCISE PATIENTS
Route::get('exercise_patients', [\App\Http\Controllers\ExercisePatientController::class, 'index'])
    ->middleware('can:viewAny,' . \App\Models\ExercisePatient::class);
// STORE
Route::post('exercise_patients', [\App\Http\Controllers\ExercisePatientController::class, 'store'])
    ->middleware('can:create,' . \App\Models\ExercisePatient::class);
// SHOW
Route::get('exercise_patients/{exercise_patient}', [\App\Http\Controllers\ExercisePatientController::class, 'show'])
    ->middleware('can:view,exercise_patient');
// UPDATE
Route::patch('exercise_patients/{exercise_patient}', [\App\Http\Controllers\ExercisePatientController::class, 'update'])
    ->middleware('can:update,exercise_patient');





// GOAL MILESTONES
Route::get('goal_milestones', [\App\Http\Controllers\GoalMilestoneController::class, 'index'])
    ->middleware('can:viewAny,' . \App\Models\GoalMilestone::class);
// STORE
Route::post('goal_milestones', [\App\Http\Controllers\GoalMilestoneController::class, 'store'])
    ->middleware('can:create,' . \App\Models\GoalMilestone::class);
// SHOW
Route::get('goal_milestones/{goal_milestone}', [\App\Http\Controllers\GoalMilestoneController::class, 'show'])
    ->middleware('can:view,goal_milestone');
// UPDATE
Route::patch('goal_milestones/{goal_milestone}', [\App\Http\Controllers\GoalMilestoneController::class, 'update'])
    ->middleware('can:update,goal_milestone');
// DELETE (soft delete)
Route::delete('goal_milestones/{goal_milestone}', [\App\Http\Controllers\GoalMilestoneController::class, 'destroy'])
    ->middleware('can:delete,goal_milestone');
// INDEX SOFT DELETED
Route::get('soft_delete/goal_milestones', [\App\Http\Controllers\GoalMilestoneController::class, 'indexSoftDelete'])
    ->middleware('can:viewAnySoftDeleted,' . \App\Models\GoalMilestone::class);
// SHOW SOFT DELETED
Route::get('soft_delete/goal_milestones/{goal_milestone}', [\App\Http\Controllers\GoalMilestoneController::class, 'showSoftDelete'])
    ->middleware('can:viewSoftDeleted');
// RESTORE
Route::patch('soft_delete/goal_milestones/restore/{goal_milestone}', [\App\Http\Controllers\GoalMilestoneController::class, 'restoreSoftDelete'])
    ->middleware('can:restoreSoftDeleted');




// NUTRITIONAL GOALS
Route::get('nutritional_goals', [\App\Http\Controllers\NutritionalGoalController::class, 'index'])
    ->middleware('can:viewAny,' . \App\Models\NutritionalGoal::class);
// STORE
Route::post('nutritional_goals', [\App\Http\Controllers\NutritionalGoalController::class, 'store'])
    ->middleware('can:create,' . \App\Models\NutritionalGoal::class);
// SHOW
Route::get('nutritional_goals/{nutritional_goal}', [\App\Http\Controllers\NutritionalGoalController::class, 'show'])
    ->middleware('can:view,nutritional_goal');
// UPDATE
Route::patch('nutritional_goals/{nutritional_goal}', [\App\Http\Controllers\NutritionalGoalController::class, 'update'])
    ->middleware('can:update,nutritional_goal');
// DELETE (soft delete)
Route::delete('nutritional_goals/{nutritional_goal}', [\App\Http\Controllers\NutritionalGoalController::class, 'destroy'])
    ->middleware('can:delete,nutritional_goal');
// INDEX SOFT DELETED
Route::get('soft_delete/nutritional_goals', [\App\Http\Controllers\NutritionalGoalController::class, 'indexSoftDelete'])
    ->middleware('can:viewAnySoftDeleted,' . \App\Models\NutritionalGoal::class);
// SHOW SOFT DELETED
Route::get('soft_delete/nutritional_goals/{nutritional_goal}', [\App\Http\Controllers\NutritionalGoalController::class, 'showSoftDelete'])
    ->middleware('can:viewSoftDeleted');
// RESTORE
Route::patch('soft_delete/nutritional_goals/restore/{nutritional_goal}', [\App\Http\Controllers\NutritionalGoalController::class, 'restoreSoftDelete'])
    ->middleware('can:restoreSoftDeleted');




// INDEX
Route::get('patients', [\App\Http\Controllers\PatientController::class, 'index'])
    ->middleware('can:viewAny,' . \App\Models\Patient::class);
// STORE
// Route::post('patients', [\App\Http\Controllers\PatientController::class, 'store'])
   // ->middleware('can:create,' . \App\Models\Patient::class);


// SHOW
Route::get('patients/{patient}', [\App\Http\Controllers\PatientController::class, 'show'])
    ->middleware('can:view,patient');
// UPDATE
Route::patch('patients/{patient}', [\App\Http\Controllers\PatientController::class, 'update'])
    ->middleware('can:update,patient');
// DELETE (soft delete)
Route::delete('patients/{patient}', [\App\Http\Controllers\PatientController::class, 'destroy'])
    ->middleware('can:delete,patient');
// INDEX SOFT DELETED
Route::get('soft_delete/patients', [\App\Http\Controllers\PatientController::class, 'indexSoftDelete'])
    ->middleware('can:viewAnySoftDeleted,' . \App\Models\Patient::class);
// SHOW SOFT DELETED
Route::get('soft_delete/patients/{patient}', [\App\Http\Controllers\PatientController::class, 'showSoftDelete'])
    ->middleware('can:viewSoftDeleted');
// RESTORE
Route::patch('soft_delete/patients/restore/{patient}', [\App\Http\Controllers\PatientController::class, 'restoreSoftDelete'])
    ->middleware('can:restoreSoftDeleted');



// INDEX
Route::get('progress_notes', [\App\Http\Controllers\ProgressNoteController::class, 'index'])
    ->middleware('can:viewAny,' . \App\Models\ProgressNote::class);
// STORE
Route::post('progress_notes', [\App\Http\Controllers\ProgressNoteController::class, 'store'])
    ->middleware('can:create,' . \App\Models\ProgressNote::class);
// SHOW
Route::get('progress_notes/{progress_note}', [\App\Http\Controllers\ProgressNoteController::class, 'show'])
    ->middleware('can:view,progress_note');
// UPDATE
Route::patch('progress_notes/{progress_note}', [\App\Http\Controllers\ProgressNoteController::class, 'update'])
    ->middleware('can:update,progress_note');
// DELETE (soft delete)
Route::delete('progress_notes/{progress_note}', [\App\Http\Controllers\ProgressNoteController::class, 'destroy'])
    ->middleware('can:delete,progress_note');
// INDEX SOFT DELETED
Route::get('soft_delete/progress_notes', [\App\Http\Controllers\ProgressNoteController::class, 'indexSoftDelete'])
    ->middleware('can:viewAnySoftDeleted,' . \App\Models\ProgressNote::class);
// SHOW SOFT DELETED
Route::get('soft_delete/progress_notes/{progress_note}', [\App\Http\Controllers\ProgressNoteController::class, 'showSoftDelete'])
    ->middleware('can:viewSoftDeleted');
// RESTORE
Route::patch('soft_delete/progress_notes/restore/{progress_note}', [\App\Http\Controllers\ProgressNoteController::class, 'restoreSoftDelete'])
    ->middleware('can:restoreSoftDeleted');



// INDEX
Route::get('roles', [\App\Http\Controllers\RoleController::class, 'index'])
    ->middleware('can:viewAny,' . \App\Models\Role::class);
// STORE
Route::post('roles', [\App\Http\Controllers\RoleController::class, 'store'])
    ->middleware('can:create,' . \App\Models\Role::class);
// SHOW
Route::get('roles/{role}', [\App\Http\Controllers\RoleController::class, 'show'])
    ->middleware('can:view,role');
// UPDATE
Route::patch('roles/{role}', [\App\Http\Controllers\RoleController::class, 'update'])
    ->middleware('can:update,role');
// DELETE (soft delete)
Route::delete('roles/{role}', [\App\Http\Controllers\RoleController::class, 'destroy'])
    ->middleware('can:delete,role');
// INDEX SOFT DELETED
Route::get('soft_delete/roles', [\App\Http\Controllers\RoleController::class, 'indexSoftDelete'])
    ->middleware('can:viewAnySoftDeleted,' . \App\Models\Role::class);
// SHOW SOFT DELETED
Route::get('soft_delete/roles/{role}', [\App\Http\Controllers\RoleController::class, 'showSoftDelete'])
    ->middleware('can:viewSoftDeleted');
// RESTORE
Route::patch('soft_delete/roles/restore/{role}', [\App\Http\Controllers\RoleController::class, 'restoreSoftDelete'])
    ->middleware('can:restoreSoftDeleted');



// INDEX
Route::get('treatments', [\App\Http\Controllers\TreatmentController::class, 'index'])
    ->middleware('can:viewAny,' . \App\Models\Treatment::class);
// STORE
Route::post('treatments', [\App\Http\Controllers\TreatmentController::class, 'store'])
    ->middleware('can:create,' . \App\Models\Treatment::class);
// SHOW
Route::get('treatments/{treatment}', [\App\Http\Controllers\TreatmentController::class, 'show'])
    ->middleware('can:view,treatment');
// UPDATE
Route::patch('treatments/{treatment}', [\App\Http\Controllers\TreatmentController::class, 'update'])
    ->middleware('can:update,treatment');
// DELETE (soft delete)
Route::delete('treatments/{treatment}', [\App\Http\Controllers\TreatmentController::class, 'destroy'])
    ->middleware('can:delete,treatment');
// INDEX SOFT DELETED
Route::get('soft_delete/treatments', [\App\Http\Controllers\TreatmentController::class, 'indexSoftDelete'])
    ->middleware('can:viewAnySoftDeleted,' . \App\Models\Treatment::class);
// SHOW SOFT DELETED
Route::get('soft_delete/treatments/{treatment}', [\App\Http\Controllers\TreatmentController::class, 'showSoftDelete'])
    ->middleware('can:viewSoftDeleted');
// RESTORE
Route::patch('soft_delete/treatments/restore/{treatment}', [\App\Http\Controllers\TreatmentController::class, 'restoreSoftDelete'])
    ->middleware('can:restoreSoftDeleted');



// INDEX
Route::get('treatment_goals', [\App\Http\Controllers\TreatmentGoalController::class, 'index'])
    ->middleware('can:viewAny,' . \App\Models\TreatmentGoal::class);
// STORE
Route::post('treatment_goals', [\App\Http\Controllers\TreatmentGoalController::class, 'store'])
    ->middleware('can:create,' . \App\Models\TreatmentGoal::class);
// SHOW
Route::get('treatment_goals/{treatment_goal}', [\App\Http\Controllers\TreatmentGoalController::class, 'show'])
    ->middleware('can:view,treatment_goal');
// UPDATE
Route::patch('treatment_goals/{treatment_goal}', [\App\Http\Controllers\TreatmentGoalController::class, 'update'])
    ->middleware('can:update,treatment_goal');
// DELETE (soft delete)
Route::delete('treatment_goals/{treatment_goal}', [\App\Http\Controllers\TreatmentGoalController::class, 'destroy'])
    ->middleware('can:delete,treatment_goal');
// INDEX SOFT DELETED
Route::get('soft_delete/treatment_goals', [\App\Http\Controllers\TreatmentGoalController::class, 'indexSoftDelete'])
    ->middleware('can:viewAnySoftDeleted,' . \App\Models\TreatmentGoal::class);
// SHOW SOFT DELETED
Route::get('soft_delete/treatment_goals/{treatment_goal}', [\App\Http\Controllers\TreatmentGoalController::class, 'showSoftDelete'])
    ->middleware('can:viewSoftDeleted');
// RESTORE
Route::patch('soft_delete/treatment_goals/restore/{treatment_goal}', [\App\Http\Controllers\TreatmentGoalController::class, 'restoreSoftDelete'])
    ->middleware('can:restoreSoftDeleted');



// INDEX
Route::get('weight_trackings', [\App\Http\Controllers\WeightTrackingController::class, 'index'])
    ->middleware('can:viewAny,' . \App\Models\WeightTracking::class);
// STORE
Route::post('weight_trackings', [\App\Http\Controllers\WeightTrackingController::class, 'store'])
    ->middleware('can:create,' . \App\Models\WeightTracking::class);
// SHOW
Route::get('weight_trackings/{weight_tracking}', [\App\Http\Controllers\WeightTrackingController::class, 'show'])
    ->middleware('can:view,weight_tracking');
// UPDATE
Route::patch('weight_trackings/{weight_tracking}', [\App\Http\Controllers\WeightTrackingController::class, 'update'])
    ->middleware('can:update,weight_tracking');
// DELETE (soft delete)
Route::delete('weight_trackings/{weight_tracking}', [\App\Http\Controllers\WeightTrackingController::class, 'destroy'])
    ->middleware('can:delete,weight_tracking');
// INDEX SOFT DELETED
Route::get('soft_delete/weight_trackings', [\App\Http\Controllers\WeightTrackingController::class, 'indexSoftDelete'])
    ->middleware('can:viewAnySoftDeleted,' . \App\Models\WeightTracking::class);
// SHOW SOFT DELETED
Route::get('soft_delete/weight_trackings/{weight_tracking}', [\App\Http\Controllers\WeightTrackingController::class, 'showSoftDelete'])
    ->middleware('can:viewSoftDeleted');
// RESTORE
Route::patch('soft_delete/weight_trackings/restore/{weight_tracking}', [\App\Http\Controllers\WeightTrackingController::class, 'restoreSoftDelete'])
    ->middleware('can:restoreSoftDeleted');



// INDEX
Route::get('symptoms', [\App\Http\Controllers\SymptomController::class, 'index'])
    ->middleware('can:viewAny,' . \App\Models\Symptom::class);
// STORE
Route::post('symptoms', [\App\Http\Controllers\SymptomController::class, 'store'])
    ->middleware('can:create,' . \App\Models\Symptom::class);
// SHOW
Route::get('symptoms/{symptom}', [\App\Http\Controllers\SymptomController::class, 'show'])
    ->middleware('can:view,symptom');
// UPDATE
Route::patch('symptoms/{symptom}', [\App\Http\Controllers\SymptomController::class, 'update'])
    ->middleware('can:update,symptom');
// DELETE (soft delete)
Route::delete('symptoms/{symptom}', [\App\Http\Controllers\SymptomController::class, 'destroy'])
    ->middleware('can:delete,symptom');
// INDEX SOFT DELETED
Route::get('soft_delete/symptoms', [\App\Http\Controllers\SymptomController::class, 'indexSoftDelete'])
    ->middleware('can:viewAnySoftDeleted,' . \App\Models\Symptom::class);
// SHOW SOFT DELETED
Route::get('soft_delete/symptoms/{symptom}', [\App\Http\Controllers\SymptomController::class, 'showSoftDelete'])
    ->middleware('can:viewSoftDeleted');
// RESTORE
Route::patch('soft_delete/symptoms/restore/{symptom}', [\App\Http\Controllers\SymptomController::class, 'restoreSoftDelete'])
    ->middleware('can:restoreSoftDeleted');


});


Route::get('patients/{patient}/allergies', [\App\Http\Controllers\AllergyController::class, 'patientAllergies']);

Route::get('patients/{patient}/allergies/soft-deleted', [\App\Http\Controllers\AllergyController::class, 'patientAllergiesSoftDelete']);








