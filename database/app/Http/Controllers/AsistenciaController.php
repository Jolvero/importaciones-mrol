<?php

namespace App\Http\Controllers;

use App\Asistencia;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AsistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Asistencia $asistencia)
    {
        //
        $this->authorize('index', $asistencia);
        $asistencias = Asistencia::orderBy('created_at', 'desc')->paginate(5);

        return view('asistencia.index', compact('asistencias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Asistencia $asistencia)
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Asistencia $asistencia)
    {
          if ($_SERVER['REMOTE_ADDR'] !== '187.189.214.33') {
             return back()->with('asistencia', 'No se permite registrar asistencia ');
          }
        $fecha =  date('Y-m-d H:i:s');
        $formatoFecha = date('Y-m-d H:i:s', strtotime($fecha));

        //
        $validarUltimoRegistro = Asistencia::where('usuario', Auth::user()->email)->pluck('fecha')->last();
        if(strlen($validarUltimoRegistro ==0))
        {
            $asistencia = new Asistencia();
            $asistencia->usuario = Auth::user()->email;
            $asistencia->fecha = $formatoFecha;
            $asistencia->save();
            return back()->with('asistenciaCorrecta', 'Asistencia Registrada Correctamente');

        }
        $convertir = strtotime($validarUltimoRegistro);
        $obtenerDiaRegistroGuardado = date('d', $convertir);
        $convertirFormato = strtotime($formatoFecha);
        $obtenerDiaFechaActual = date('d', $convertirFormato);
        $asistencia = new Asistencia();
        $asistencia->usuario = Auth::user()->email;
        $asistencia->fecha = $formatoFecha;
        if ($obtenerDiaFechaActual !== $obtenerDiaRegistroGuardado) {
            $asistencia->save();
            return back()->with('asistenciaCorrecta', 'Checado');
            $request->session()->forget('asistencia');
        }
        return back()->with('asistencia', 'Ya Checaste');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Asistencia $asistencia)
    {
        //
        $this->authorize('view', $asistencia);
        $asistencias = Asistencia::where('usuario', $asistencia->usuario)->get()->take(3);
        $todasAsistencias = Asistencia::where('usuario', $asistencia->usuario)->orderBy('created_at', 'desc')->paginate(7);
        return view('asistencia.show', compact('asistencia', 'asistencias', 'todasAsistencias'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
