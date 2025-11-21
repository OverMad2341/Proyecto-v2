<?php

use App\Http\Controllers\ActivosController;
use App\Http\Controllers\EmpleadosController;
use App\Http\Controllers\GerenciasController;
use App\Http\Controllers\SubcategoriaController;
use App\Http\Controllers\SubSubcategoriaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmailVerificationController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified']) 
    ->name('dashboard');

// Menú principal de Activos
Route::get('activos', function () {
    return Inertia::render('activos/Activos');
})->middleware(['auth', 'verified'])->name('activos');

Route::middleware('auth', 'verified')->group(function () {

    // --- RUTAS PERSONALIZADAS (Importación y Exportación) ---
    // Importante: Defínelas ANTES del resource 'Activo' para evitar conflictos de rutas.
    
    // 1. Exportar
    Route::get('activos/export', [ActivosController::class, 'export'])->name('activos.export');

    // 2. Importar (Vista)
    Route::get('activos/import', function () {
        return Inertia::render('activos/Import');
    })->name('activos.import.view');

    // 3. Importar (Previsualizar JSON)
    Route::post('activos/import-preview', [ActivosController::class, 'importPreview'])->name('activos.import.preview');

    // 4. Importar (Guardar en BD)
    Route::post('activos/import-store', [ActivosController::class, 'importStore'])->name('activos.import.store');

    // --- RESOURCE ROUTES ---
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

Route::get('/verify-email', function (Request $request) {
    return Inertia::render('auth/VerifyEmail', [
        'email' => $request->email,
        'status' => session('status')
    ]);
})->middleware('auth')->name('verification.notice'); 

Route::post('/verify-email', [EmailVerificationController::class, 'verifyCode'])
    ->middleware(['auth', 'throttle:6,1']) 
    ->name('verification.verify');

Route::post('/send-verification-code', [EmailVerificationController::class, 'sendCode'])
    ->middleware(['auth', 'throttle:1,1']) 
    ->name('verification.send');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';