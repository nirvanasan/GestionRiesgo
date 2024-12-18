<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DofaController;
use App\Http\Controllers\VerDofaController;
use App\Http\Controllers\ProcesoController;
use App\Http\Controllers\AnalisisDofaController;
use App\Http\Controllers\ClasificacionController;


Route::get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/users', [UserController::class, 'store']);
Route::post('/registro', [RegisterController::class, 'register']);
Route::post('/guardar-dofa', [DofaController::class, 'store']);
Route::post('/buscar-dofa', [VerDofaController::class, 'buscar']);
Route::post('/procesos', [ProcesoController::class, 'store']);
Route::get('/procesos-buscar', [ProcesoController::class, 'buscar']);
Route::post('/oportunidad-riesgo', [AnalisisDofaController::class, 'getAnalisisDofaByUser']);
Route::post('/clasificacion', [ClasificacionController::class, 'clasificacion']);