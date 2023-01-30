<?php

namespace App\Http\Controllers;

use App\Imagen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    public function store( Request $request) {

        // Leer la imagen
        $ruta_imagen = $request->file('file')->store('embarques', 'public');

        // Resize a la imagen
        $imagen = Image::make(public_path("storage/{$ruta_imagen}"));
        $imagen->save();

        // Almacenar con modelo
        $imagenDB = new Imagen;
        $imagenDB->id_embarque = $request['uuid'];
        $imagenDB->ruta_imagen = $ruta_imagen;

        $imagenDB->save();

        // Retornar Respuesta
        $respuesta = [
            'archivo' => $ruta_imagen
        ];

        return response()->json($respuesta);
    }

    // Elimina una imagen de la base de datos y del servidor
    public function destroy(Request $request)
    {

        $imagen = $request->get('imagen');

        if(File::exists('storage/' . $imagen)) {
            // Elimina imagen del Servidor
            File::delete('storage/' . $imagen);

            // Elimina la imagen de la DB
            Imagen::where('ruta_imagen', $imagen )->delete();

            $respuesta = [
                'mensaje' => 'Imagen eliminada',
                'imagen' => $imagen
            ];
        }

        return response()->json($respuesta);
    }
}
