<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Embarque;
use App\InventarioEmbarques;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventarioEmbarquesController extends Controller
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

    public function inventario()
    {
        $validarUserAdmin = Auth::user()->rol_id;

        if($validarUserAdmin == 3)
        {
            return back();
        }

        $ajax = [];
        $obtenerClientes = Cliente::pluck('id');
        $contar = $obtenerClientes->count();
        for ($i = 0; $i < $contar; ++$i) {
            $inventarios = Embarque::where('cliente_id', $obtenerClientes[$i])->count();
            $inventarios = intval($inventarios);
            $ajax[] = $inventarios;
        }

        return $ajax;
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
     * @param  \App\InventarioEmbarques  $inventarioEmbarques
     * @return \Illuminate\Http\Response
     */
    public function show(InventarioEmbarques $inventarioEmbarques)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InventarioEmbarques  $inventarioEmbarques
     * @return \Illuminate\Http\Response
     */
    public function edit(InventarioEmbarques $inventarioEmbarques)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InventarioEmbarques  $inventarioEmbarques
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InventarioEmbarques $inventarioEmbarques)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InventarioEmbarques  $inventarioEmbarques
     * @return \Illuminate\Http\Response
     */
    public function destroy(InventarioEmbarques $inventarioEmbarques)
    {
        //
    }
}
