<?php

use App\Http\Controllers\Api\UserControler;
use App\Http\Controllers\MensajeController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [UserControler::class, 'register']);
Route::post('login', [UserControler::class, 'login']);

Route::group(['middleware' => ["auth:sanctum"]], function(){
    //rutas
    Route::get('home', [UserControler::class, 'home']);
    Route::get('logout', [UserControler::class, 'logout']);
});

Route::get('/enviar-mensaje', [MensajeController::class, 'enviarMensaje']);