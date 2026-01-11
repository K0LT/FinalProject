<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\WebControllers\AdminController;
use App\Http\Controllers\WebControllers\ClientController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');
Route::post('login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/user', [AuthController::class, 'user'])->middleware('auth:sanctum');



// Web Auth routes (new)
Route::get('/web-login', function () {
    return view('auth.login');
})->name('web.login')->middleware('guest');

Route::get('/web-register', function () {
    return view('auth.register');
})->name('web.register')->middleware('guest');

Route::post('/web-login', [AuthController::class, 'webLogin'])->name('web.login.post')->middleware('guest');
Route::post('/web-register', [AuthController::class, 'webRegister'])->name('web.register.post')->middleware('guest');
Route::post('/web-logout', [AuthController::class, 'webLogout'])->name('web.logout')->middleware('auth');

// Admin routes (protected by auth and isAdmin gate)
Route::middleware(['auth', 'can:isAdmin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/patients', [AdminController::class, 'patients'])->name('admin.patients');
    Route::get('/patients/{patientId}', [AdminController::class, 'patientDetail'])->name('admin.patient.detail');
    Route::post('/patients/{patientId}/conditions', [AdminController::class, 'storePatientCondition'])->name('admin.patient.conditions.store');
    Route::post('/patients/{patientId}/allergies', [AdminController::class, 'storePatientAllergy'])->name('admin.patient.allergies.store');
    Route::get('/patients/{patientId}/appointments', [AdminController::class, 'patientAppointments'])->name('admin.patient.appointments');
    Route::post('/patients/{patientId}/appointments', [AdminController::class, 'storePatientAppointment'])->name('admin.patient.appointments.store');
    Route::get('/patients/{patientId}/diagnostics', [AdminController::class, 'patientDiagnostics'])->name('admin.patient.diagnostics');
    Route::post('/patients/{patientId}/diagnostics', [AdminController::class, 'storePatientDiagnostic'])->name('admin.patient.diagnostics.store');
    Route::get('/patients/{patientId}/exercises', [AdminController::class, 'patientExercises'])->name('admin.patient.exercises');
    Route::post('/patients/{patientId}/exercises', [AdminController::class, 'attachPatientExercise'])->name('admin.patient.exercises.attach');
    Route::get('/patients/{patientId}/objectives', [AdminController::class, 'patientObjectives'])->name('admin.patient.objectives');
    Route::post('/patients/{patientId}/objectives', [AdminController::class, 'storePatientObjective'])->name('admin.patient.objectives.store');
    Route::post('/patients/{patientId}/objectives/{objectiveId}/milestones', [AdminController::class, 'storeGoalMilestone'])->name('admin.patient.objectives.milestone.store');
    Route::post('/patients/{patientId}/milestones/{milestoneId}/toggle', [AdminController::class, 'toggleMilestoneCompletion'])->name('admin.patient.objectives.milestone.toggle');
    Route::get('/patients/{patientId}/progress-notes', [AdminController::class, 'patientProgressNotes'])->name('admin.patient.progress-notes');
    Route::post('/patients/{patientId}/progress-notes', [AdminController::class, 'storeProgressNote'])->name('admin.patient.progress-notes.store');
    Route::get('/patients/{patientId}/health-control', [AdminController::class, 'patientHealthControl'])->name('admin.patient.health-control');
    Route::get('/exercises', [AdminController::class, 'exercises'])->name('admin.exercises');
    Route::get('/appointments', [AdminController::class, 'appointments'])->name('admin.appointments');
    Route::get('/conditions', [AdminController::class, 'conditions'])->name('admin.conditions');
    Route::get('/symptoms', [AdminController::class, 'symptoms'])->name('admin.symptoms');
    Route::get('/allergies', [AdminController::class, 'allergies'])->name('admin.allergies');
});

// Client routes (protected by auth and isPatient gate)
Route::middleware(['auth', 'can:isPatient'])->prefix('user')->group(function () {
    Route::get('/profile', [ClientController::class, 'profile'])->name('user.profile');
    Route::get('/profile/edit', [ClientController::class, 'editProfile'])->name('user.profile.edit');
    Route::post('/profile/update', [ClientController::class, 'updateProfile'])->name('user.profile.update');
    Route::post('/allergies/add', [ClientController::class, 'addAllergy'])->name('user.allergies.add');
    Route::post('/allergies/remove', [ClientController::class, 'removeAllergy'])->name('user.allergies.remove');
    Route::get('/appointments', [ClientController::class, 'appointments'])->name('user.appointments');
    Route::get('/diagnostics', [ClientController::class, 'diagnostics'])->name('user.diagnostics');
    Route::get('/objectives', [ClientController::class, 'objectives'])->name('user.objectives');
    Route::get('/exercises', [ClientController::class, 'exercises'])->name('user.exercises');
    Route::post('/exercises/{exercise}/complete', [ClientController::class, 'completeExercise'])->name('user.exercise.complete');
    Route::get('/weight-control', [ClientController::class, 'weightControl'])->name('user.weight-control');
    Route::post('/weight-control/add-weight', [ClientController::class, 'addWeight'])->name('user.weight-control.add-weight');
    Route::post('/weight-control/add-nutrition', [ClientController::class, 'addNutrition'])->name('user.weight-control.add-nutrition');
    Route::get('/ai-assistant', [ClientController::class, 'aiAssistant'])->name('user.ai-assistant');
    Route::get('/request-appointment', [ClientController::class, 'requestAppointmentForm'])->name('user.request-appointment');
    Route::post('/request-appointment', [ClientController::class, 'storeAppointmentRequest'])->name('user.request-appointment.store');
});
