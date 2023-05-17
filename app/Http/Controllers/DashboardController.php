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
            $embarques = Embarque::where('mes_id', $mes)->count();
            $ajaxMes[] = $embarques;
        }

        return $ajaxMes;
    }

    public function embarquesMesCliente()
    {
        $meses = ['01', '02', '03', '04', '05', '06', '07', '08', '09'];
        $mesActual = date('m');
        foreach($meses as $mes)
        {
            if($mesActual == $mes)
            {
                $mesActual = substr($mes, 1);
            }
        }

        $user = Auth::user()->rol_id;

        if($user == 3)
        {
            return back();
        }
        $ajaxCliente = [];
        $clientes = Cliente::count();

        for ($i = 1; $i <= $clientes; $i++) {
            $embarques = Embarque::where('mes_id', $mesActual)->where('cliente_id', $i)->count();
            $ajaxCliente[] = $embarques;
        }
        return $ajaxCliente;
    }

    public function kpis()
    {

        $meses = ['01', '02', '03', '04', '05', '06', '07', '08', '09'];
        $mesActual = date('m');
        foreach($meses as $mes)
        {
            if($mesActual == $mes)
            {
                $mesActual = substr($mes, 1);
            }
        }

        $user = Auth::user()->rol_id;

        if($user == 3)
        {
            return back();
        }
        $ajaxDocArribo = [];
        $ajaxArrDespacho = [];
        $ajaxDespCG = [];
        $ajaxReferencias = [];
        $embarques = Embarque::where('mes_id', $mesActual)->get();
        foreach ($embarques as $embarque) {
            $arribo = $embarque->arribo;
            $despacho = $embarque->despacho;
            $fechaDocumentacion = $embarque->documentacion;
            $ajaxReferencias[] = $embarque->referencia;

                $fechaArribo = Carbon::parse($arribo);
                $fechaDocumentacion = Carbon::parse($fechaDocumentacion);

                $diferencia = $fechaDocumentacion->diffInDays($fechaArribo);
                $ajaxDocArribo[] = $diferencia;
                $fechaArribo = Carbon::parse($arribo);
                $fechaDespacho = Carbon::parse($despacho);

                $diferencia = $fechaDespacho->diffInDays($fechaArribo);
                $ajaxArrDespacho[] = $diferencia;


            $cuentaGastos = $embarque->cuenta_gastos;

                $fechaDespacho = Carbon::parse($despacho);
                $FechaCG = Carbon::parse($cuentaGastos);

                $diferencia = $FechaCG->diffInDays($fechaDespacho);

                $ajaxDespCG[] = $diferencia;

            $ajaxPrincipal = [];
            $ajaxPrincipal[]= $ajaxDocArribo;
            $ajaxPrincipal[]= $ajaxArrDespacho;
            $ajaxPrincipal[]= $ajaxDespCG;
            $ajaxPrincipal[]= $ajaxReferencias;

        }

        return $ajaxPrincipal;


    }
}
