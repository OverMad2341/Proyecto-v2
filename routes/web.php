<?php

use App\Http\Controllers\ActivosController;
use App\Http\Controllers\EmpleadosController;
use App\Http\Controllers\GerenciasController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('Activos', function () {
    return Inertia::render('activos/Activos');
})->middleware(['auth', 'verified'])->name('Activos');

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/ListaActivos', [ActivosController::class, 'index'])->name('activos.index');
    Route::get('/Activos/create', [ActivosController::class, 'create'])->name('activos.create');
    Route::post('/Activos', [ActivosController::class, 'store'])->name('activos.store');
    Route::get('/Activos/{activo}/edit', [ActivosController::class, 'edit'])->name('activos.edit');
    Route::put('/Activos/{activo}', [ActivosController::class, 'update'])->name('activos.update');
    Route::delete('/Activos/{activo}', [ActivosController::class, 'destroy'])->name('activos.destroy');
    // Endpoint para obtener empleados (usado por el formulario de activos)
    Route::get('/empleados', [EmpleadosController::class, 'index'])->name('empleados.index');
    Route::get('/gerencias', [GerenciasController::class, 'index'])->name('gerencias.index');
});


require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
