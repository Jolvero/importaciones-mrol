<?php

namespace App\Http\Controllers;

use App\CuentaEmbarque;
use App\Embarque;
use Illuminate\Http\Request;

class CuentasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Embarque $embarque)
    {
        //
        $validarArchivo = ("storage" . "/" . $embarque->referencia);
        if(file_exists($validarArchivo))
        {
            $file = CuentaEmbarque::wherename($id)->firstOrFail();
            return redirect('/storage'. '/'  . $file->referencia  . '/' . $file->name);        }

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
        $file = CuentaEmbarque::wherename($id)->firstOrFail();


        unlink(public_path('storage' . '/' . $file->referencia . '/' . $file->name));

        $file->delete();

        return back();
    }
}
