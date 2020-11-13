<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('conductores/', [Controllers\ConductorController::class, 'index'])->name('conductores.index');
Route::post('conductores/', [Controllers\ConductorController::class, 'store'])->name('conductores.store');
Route::get('conductores/{id}', [Controllers\ConductorController::class, 'show'])->name('conductores.show');
Route::put('conductores/{id}', [Controllers\ConductorController::class, 'update'])->name('conductores.update');
Route::delete('conductores/{id}', [Controllers\ConductorController::class, 'destroy'])->name('conductores.delete');

Route::get('usuarios/', [Controllers\UserController::class, 'index'])->name('usuarios.index');
Route::post('usuarios/', [Controllers\UserController::class, 'store'])->name('usuarios.store');
Route::get('usuarios/{id}', [Controllers\UserController::class, 'show'])->name('usuarios.show');
Route::put('usuarios/{id}', [Controllers\UserController::class, 'update'])->name('usuarios.update');
Route::delete('usuarios/{id}', [Controllers\UserController::class, 'destroy'])->name('usuarios.delete');

Route::get('vehiculos/', [Controllers\VehiculoController::class, 'index'])->name('vehiculos.index');
Route::post('vehiculos/', [Controllers\VehiculoController::class, 'store'])->name('vehiculos.store');
Route::get('vehiculos/{id}', [Controllers\VehiculoController::class, 'show'])->name('vehiculos.show');
Route::put('vehiculos/{id}', [Controllers\VehiculoController::class, 'update'])->name('vehiculos.update');
Route::delete('vehiculos/{id}', [Controllers\VehiculoController::class, 'destroy'])->name('vehiculos.delete');

Route::get('horarios/conductor/{idConductor}', [Controllers\HorarioController::class, 'index'])->name('horarios.index');
Route::post('horarios/', [Controllers\HorarioController::class, 'store'])->name('horarios.store');
Route::get('horarios/{id}', [Controllers\HorarioController::class, 'show'])->name('horarios.show');
Route::put('horarios/{id}', [Controllers\HorarioController::class, 'update'])->name('horarios.update');
Route::delete('horarios/{id}', [Controllers\HorarioController::class, 'destroy'])->name('horarios.delete');