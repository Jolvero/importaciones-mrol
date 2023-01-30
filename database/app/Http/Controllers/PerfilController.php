<?php

namespace App\Http\Controllers;

use App\Perfil;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Display the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show(Perfil $perfil)
    {
        return view('perfiles.show', compact('perfil'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $perfil)
    {


        // Ejecutar el Policy
        $this->authorize('view', $perfil);
        return view('perfiles.edit', compact('perfil'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perfil $perfil)
    {

        // Ejecutar el Policy

        $this->authorize('update', $perfil);

        // validar
        $data = request()->validate([
            'nombre' => 'required',
            'puesto' => 'nullable',
            'ingreso' => 'required|date',

        ]);

        // Si el usuario sube una imagen

        if($request['imagen']) {
             // obtener la ruta de la imagen
             $ruta_imagen = $request['imagen']->store('upload-perfiles', 'public');

             // Resize a la imagen
             $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(600, 600);
             $img->save();

             // crear un arreglo de imagen
             $array_imagen = ['imagen' => $ruta_imagen];
        }

        // Asignar nombre
        auth()->user()->name = $data['nombre'];
        auth()->user()->save();

        // Eliminar nombre  de $data
        unset($data['nombre']);

        // Guardar Información
        // asignar imagen, fecha de ingreso y puesto
       auth()->user()->perfil()->update( array_merge(
           $data,
           $array_imagen ?? []
       ));

        // redireccionar

        return redirect()->action('EmbarqueController@index');
       }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perfil $perfil)
    {
        //
    }
}
