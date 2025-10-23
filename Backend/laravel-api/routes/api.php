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


