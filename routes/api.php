<?php

use Illuminate\Support\Facades\Route;

Route::apiResource('/users', App\Http\Controllers\API\UserController::class);
Route::resource('/agents', App\Http\Controllers\AgentController::class);