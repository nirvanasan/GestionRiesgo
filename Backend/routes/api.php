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
use App\Http\Controllers\ControlController;
use App\Http\Controllers\AccionController;
use App\Http\Controllers\SeguimientoController;
use App\Http\Controllers\NotificacionController;

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
Route::post('/clasificacion', [ClasificacionController::class, 'store']);
Route::get('/cargar-clasificacion', [ClasificacionController::class, 'index']);
Route::post('/cargar-control', [ControlController::class, 'store']);
Route::get('/cargar-controles', [ControlController::class, 'index']);
Route::get('/cargar-usuarios', [UserController::class, 'index']);
Route::post('/acciones', [AccionController::class, 'store']);
Route::get('/buscar-acciones', [AccionController::class, 'buscar']);
Route::post('/seguimiento', [SeguimientoController::class, 'store']);

Route::get('/buscar', [DofaController::class, 'buscar']);
Route::get('/buscar-usuario', [DofaController::class, 'buscarUsuario']);


Route::post('/notificaciones', [NotificacionController::class, 'store']); // Crear notificación
Route::get('/notificaciones', [NotificacionController::class, 'index']); // Listar notificaciones del usuario
Route::put('/notificaciones/{id}/leida', [NotificacionController::class, 'marcarComoLeida']); // Marcar como leíd