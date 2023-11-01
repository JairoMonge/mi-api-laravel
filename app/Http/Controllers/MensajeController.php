<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MensajeController extends Controller
{
    public function enviarMensaje(Request $request) {
        $mensaje = $request->input('mensaje');

        // Puedes hacer lo que desees con el mensaje, por ejemplo, guardarlo en una base de datos o enviarlo a través de una cola.
        
        return response()->json(['mensaje' => 'Mensaje enviado desde Laravel']);
    }
}
