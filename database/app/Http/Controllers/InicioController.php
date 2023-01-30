<?php

namespace App\Http\Controllers;

use App\Embarque;
use App\EstadoEmbarque;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class InicioController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function index()
    {
        // Obtener los ultimos embarques
        $nuevos = Embarque::latest()->take(7)->get();

        // obtener todos los estatus
        $estados = EstadoEmbarque::all();

        // agrupar Embarques por estatus
        $embarques = [];

        foreach($estados as $estado) {
            $embarques[ Str::slug( $estado->nombre) ][] = Embarque::where('estado_id', $estado->id)->take(10)->get();
        }

        // return $embarques;

        return view('inicio.index', compact('nuevos', 'embarques'));
    }
}
