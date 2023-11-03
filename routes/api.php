<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\MensajeController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);

Route::group(['middleware' => ["auth:sanctum"]], function(){
    //rutas
    Route::get('home', [UserController::class, 'home']);
    Route::get('logout', [UserController::class, 'logout']);
});

Route::get('/enviar-mensaje', [MensajeController::class, 'enviarMensaje']);