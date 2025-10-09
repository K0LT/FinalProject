<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/clients', [\App\Http\Controllers\ClientController::class, 'index']);
Route::get('/clients/{client}', [\App\Http\Controllers\ClientController::class, 'show']);
//Route::get('/clients', [\App\Http\Controllers\ClientController::class, 'create ']);
Route::post('/clients', [\App\Http\Controllers\ClientController::class, 'store']);
Route::put('/clients/{client}', [\App\Http\Controllers\ClientController::class, 'update']);
Route::delete('/clients/{client}', [\App\Http\Controllers\ClientController::class, 'destroy']);

