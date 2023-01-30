<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Embarque;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //

    public function index()
    {
        $user = Auth::user()->rol_id;

        if($user == 3)
        {
            return back();
        }

        $embarques = Embarque::count();
        $clientes = Cliente::count();
        $nombre = Auth::user()->name;
        $rol = Auth::user()->rol_id;
        return view('dashboard.index', compact('embarques', 'clientes', 'nombre', 'rol'));
    }

    public function embarquesMes()
    {

        $user = Auth::user()->rol_id;

        if($user == 3)
        {
            return back();
        }
        $ajaxMes = [];
        for ($mes = 1; $mes <= 12; $mes++) {
            $embarques = Embarque::whereMonth('created_at', strval($mes))->count();
            $ajaxMes[] = $embarques;
        }

        return $ajaxMes;
    }

    public function embarquesMesCliente()
    {

        $user = Auth::user()->rol_id;

        if($user == 3)
        {
            return back();
        }
        $ajaxCliente = [];
        $clientes = Cliente::count();

        for ($i = 1; $i <= $clientes; $i++) {
            $embarques = Embarque::whereMonth('created_at', date('m'))->where('cliente_id', $i)->count();
            $ajaxCliente[] = $embarques;
        }
        return $ajaxCliente;
    }

    public function kpis()
    {

        $user = Auth::user()->rol_id;

        if($user == 3)
        {
            return back();
        }
        $ajaxDocArribo = [];
        $ajaxArrDespacho = [];
        $ajaxDespCG = [];
        $ajaxReferencias = [];
        $embarques = Embarque::whereMonth('created_at', date('m'))->get();
        foreach ($embarques as $embarque) {
            $arribo = $embarque->arribo;
            $despacho = $embarque->despacho;
            $fechaDocumentacion = $embarque->documentacion;
            $ajaxReferencias[] = $embarque->referencia;
            if($fechaDocumentacion && $arribo)
            {
                $fechaArribo = Carbon::parse($arribo);
                $fechaDocumentacion = Carbon::parse($fechaDocumentacion);

                $diferencia = $fechaDocumentacion->diffInDays($fechaArribo);
                $ajaxDocArribo[] = $diferencia;
            }
            if ($arribo && $despacho) {
                $fechaArribo = Carbon::parse($arribo);
                $fechaDespacho = Carbon::parse($despacho);

                $diferencia = $fechaDespacho->diffInDays($fechaArribo);
                $ajaxArrDespacho[] = $diferencia;

            }
            $cuentaGastos = $embarque->cuenta_gastos;
            if($despacho && $cuentaGastos)
            {
                $fechaDespacho = Carbon::parse($despacho);
                $FechaCG = Carbon::parse($cuentaGastos);

                $diferencia = $FechaCG->diffInDays($fechaDespacho);

                $ajaxDespCG[] = $diferencia;
            }
            $ajaxPrincipal = [];
            $ajaxPrincipal[]= $ajaxDocArribo;
            $ajaxPrincipal[]= $ajaxArrDespacho;
            $ajaxPrincipal[]= $ajaxDespCG;
            $ajaxPrincipal[]= $ajaxReferencias;

        }

        return $ajaxPrincipal;


    }
}
