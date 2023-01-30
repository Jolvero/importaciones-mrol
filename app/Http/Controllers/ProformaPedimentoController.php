<?php

namespace App\Http\Controllers;

use App\ProformaPedimento;
use Illuminate\Http\Request;

class ProformaPedimentoController extends Controller
{
    //

    public function show($id)
    {
        //
        $proforma = ProformaPedimento::wherename($id)->firstOrFail();
        return redirect('/storage'. '/'  . $proforma->referencia  . '/' . $proforma->name);

    }

    public function destroy($id)
    {
        //
        $proforma = ProformaPedimento::wherename($id)->firstOrFail();
        // Borra el archivo del storage
        unlink(public_path('storage' . '/' .  $proforma->referencia . '/' . $proforma->name));
        // Borra el archivo de la base de datos
        $proforma->delete();

        return back();

    }}

