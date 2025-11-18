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
    ->middleware(['auth', 'verified']) // O el middleware que uses
    ->name('dashboard');

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

Route::get('/verify-email', function (Request $request) {
    return Inertia::render('auth/VerifyEmail', [
        'email' => $request->email,
        'status' => session('status')
    ]);
})->middleware('auth')->name('verification.notice'); // 'auth' para que solo usuarios logueados pero no verificados

// 2. El formulario de "Ingresa tu código" se envía a esta ruta.
Route::post('/verify-email', [EmailVerificationController::class, 'verifyCode'])
    ->middleware(['auth', 'throttle:6,1']) // 'throttle' previene fuerza bruta
    ->name('verification.verify');

// 3. Para el botón de "Reenviar código"
Route::post('/send-verification-code', [EmailVerificationController::class, 'sendCode'])
    ->middleware(['auth', 'throttle:1,1']) // 1 vez por minuto
    ->name('verification.send');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
