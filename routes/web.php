<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('Activos', function () {
    return Inertia::render('Activos');
})->middleware(['auth', 'verified'])->name('activos');


require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

Route::resource('/users', App\Http\Controllers\UserController::class);

Route::resource('/agents', App\Http\Controllers\AgentController::class);

Route::resource('/categories', App\Http\Controllers\CategoryController::class);

Route::resource('/depreciations', App\Http\Controllers\DepreciationController::class);

Route::resource('/employees', App\Http\Controllers\EmployeeController::class);

Route::resource('/federal_states', App\Http\Controllers\FederalStateController::class);

Route::resource('/locations', App\Http\Controllers\LocationController::class);

Route::resource('/movement_histories', App\Http\Controllers\MovementHistoryController::class);

Route::resource('/municipalities', App\Http\Controllers\MunicipalityController::class);

Route::resource('/national_assets', App\Http\Controllers\NationalAssetController::class);

Route::resource('/national_asset_assignaments', App\Http\Controllers\NationalAssetAssignamentController::class);

Route::resource('/organizational_unis', App\Http\Controllers\OrganizationalUniController::class);

Route::resource('/parishes', App\Http\Controllers\ParishController::class);

Route::resource('/people', App\Http\Controllers\PersonController::class);

Route::resource('/sub_categories', App\Http\Controllers\SubCategoryController::class);

Route::resource('/tables', App\Http\Controllers\TableController::class);

Route::resource('/teams', App\Http\Controllers\TeamController::class);
