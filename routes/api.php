<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Rutas públicas (sin autenticación)
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);

// Rutas protegidas con JWT
Route::group(['middleware' => ['jwt.verify']], function () {
    // Rutas de autenticación
    Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout']);
    Route::post('/refresh', [App\Http\Controllers\AuthController::class, 'refresh']);
    Route::get('/me', [App\Http\Controllers\AuthController::class, 'me']);

    // Aquí se agregarán las rutas de recursos según el modelo de negocio
    // Ejemplo:
    // Route::apiResource('productos', App\Http\Controllers\ProductosController::class);
    // Route::apiResource('clientes', App\Http\Controllers\ClientesController::class);
    // Route::apiResource('proveedores', App\Http\Controllers\ProveedoresController::class);
});
