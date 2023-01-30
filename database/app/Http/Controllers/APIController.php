<?php

namespace App\Http\Controllers;

use App\Embarque;
use App\Estados;
use App\Imagen;
use Illuminate\Http\Request;

class APIController extends Controller
{
    // Método para obtener todos los estados de embarques
   

    // Muestra un embarque en especifico
    public function show(Embarque $embarque)
    {
        $imagenes = Imagen::where('id_embarque', $embarque->uuid)->get();
        $embarque->imagenes = $imagenes;
        return response()->json($embarque);
    }
}
