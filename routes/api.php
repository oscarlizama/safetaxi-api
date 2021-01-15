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

Route::get('conductores/estado/{estado}', [Controllers\ConductorController::class, 'index'])->name('conductores.index');
Route::post('conductoreshorarios/', [Controllers\ConductorController::class, 'getConductoresDisponibles'])->name('conductores.getConductoresDisponibles');
Route::post('conductores/', [Controllers\ConductorController::class, 'store'])->name('conductores.store');
Route::get('conductores/{id}', [Controllers\ConductorController::class, 'show'])->name('conductores.show');
Route::put('conductores/{id}', [Controllers\ConductorController::class, 'update'])->name('conductores.update');
Route::put('conductores/servicio/{id}', [Controllers\ConductorController::class, 'servicio'])->name('conductores.servicio');
Route::delete('conductores/{id}', [Controllers\ConductorController::class, 'destroy'])->name('conductores.delete');

Route::get('usuarios/', [Controllers\UserController::class, 'index'])->name('usuarios.index');
Route::post('usuarios/', [Controllers\UserController::class, 'store'])->name('usuarios.store');
Route::get('usuarios/{id}', [Controllers\UserController::class, 'show'])->name('usuarios.show');
Route::put('usuarios/{id}', [Controllers\UserController::class, 'update'])->name('usuarios.update');
Route::delete('usuarios/{id}', [Controllers\UserController::class, 'destroy'])->name('usuarios.delete');

Route::get('vehiculos/estado/{estado}', [Controllers\VehiculoController::class, 'index'])->name('vehiculos.index');
Route::post('vehiculos/', [Controllers\VehiculoController::class, 'store'])->name('vehiculos.store');
Route::get('vehiculos/{id}', [Controllers\VehiculoController::class, 'show'])->name('vehiculos.show');
Route::put('vehiculos/{id}', [Controllers\VehiculoController::class, 'update'])->name('vehiculos.update');
Route::put('vehiculos/servicio/{id}', [Controllers\VehiculoController::class, 'servicio'])->name('vehiculos.servicio');
//Route::post('vehiculos/upload/', [Controllers\VehiculoController::class, 'uploadFile'])->name('vehiculos.upload');
Route::delete('vehiculos/{id}', [Controllers\VehiculoController::class, 'destroy'])->name('vehiculos.delete');

Route::get('horarios/conductor/{idConductor}', [Controllers\HorarioController::class, 'index'])->name('horarios.index');
Route::post('horarios/', [Controllers\HorarioController::class, 'store'])->name('horarios.store');
Route::get('horarios/{id}', [Controllers\HorarioController::class, 'show'])->name('horarios.show');
Route::put('horarios/{id}', [Controllers\HorarioController::class, 'update'])->name('horarios.update');
Route::delete('horarios/{id}', [Controllers\HorarioController::class, 'destroy'])->name('horarios.delete');

Route::get('tarifas/', [Controllers\TarifaController::class, 'index'])->name('tarifas.index');
Route::get('tarifas/{id}', [Controllers\TarifaController::class, 'show'])->name('tarifas.show');
Route::post('tarifasviaje/', [Controllers\TarifaController::class, 'tarifasViaje'])->name('tarifas.tarifasViaje');
Route::post('tarifas/', [Controllers\TarifaController::class, 'store'])->name('tarifas.store');
Route::put('tarifas/{id}', [Controllers\TarifaController::class, 'update'])->name('tarifas.update');
Route::delete('tarifas/{id}', [Controllers\TarifaController::class, 'destroy'])->name('tarifas.delete');

Route::get('viajes/estado/{estado}', [Controllers\ViajeController::class, 'getSolicitudesViaje'])->name('viajes.index');
Route::post('viajesolicitar/', [Controllers\ViajeController::class, 'solicitarViaje'])->name('viajes.solicitarViaje');
Route::post('viajesasignar/{id}', [Controllers\ViajeController::class, 'asignarViaje'])->name('viajes.asignarViaje');
Route::get('viajesterminar/{id}', [Controllers\ViajeController::class, 'terminarViaje'])->name('viajes.terminarViaje');
Route::get('viajesrechazar/{id}', [Controllers\ViajeController::class, 'rechazarViaje'])->name('viajes.rechazarViaje');
Route::get('viajes/{id}', [Controllers\ViajeController::class, 'getViaje'])->name('viajes.getViaje');