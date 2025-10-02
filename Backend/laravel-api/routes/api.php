<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/clients', [\App\Http\Controllers\ClientController::class, 'index']);
Route::get('/clients/{client}', [\App\Http\Controllers\ClientController::class, 'show']);
