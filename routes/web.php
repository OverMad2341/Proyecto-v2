<?php

use App\Http\Controllers\ActivosController;
use App\Http\Controllers\EmpleadosController;
use App\Http\Controllers\GerenciasController;
use App\Http\Controllers\SubcategoriaController;
use App\Http\Controllers\SubSubcategoriaController;
use App\Http\Controllers\CategoriaController;

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('activos', function () {
    return Inertia::render('activos/Activos');
})->middleware(['auth', 'verified'])->name('activos');

Route::middleware('auth', 'verified')->group(function () {
    Route::resource('Activo', ActivosController::class)
        ->parameters(['Activo' => 'activo']);
    Route::resource('empleados', EmpleadosController::class)
        ->parameters(['empleados' => 'empleado']);
    Route::resource('gerencias', GerenciasController::class)
        ->parameters(['gerencias' => 'gerencia']);
    Route::resource('categorias', CategoriaController::class)
        ->parameters(['categorias' => 'categoria']);
    Route::resource('subcategorias', SubcategoriaController::class)
        ->parameters(['subcategorias' => 'subcategoria']);
    Route::resource('subsubcategorias', SubSubcategoriaController::class)
        ->parameters(['subsubcategorias' => 'subsubcategoria']);
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
