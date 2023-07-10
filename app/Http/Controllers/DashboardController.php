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
        $clientes = Cliente::all('id');

        foreach($clientes as $cliente)
        {
            $embarques = Embarque::where('mes_id', $mesActual)->where('cliente_id', $cliente->id)->count();
            $ajaxCliente[] = $embarques;
        }
        return $ajaxCliente;
    }

    public function obtenerTopMesEmbarques()
    {
        $mes = date('m');
        $embarques = Embarque::where('mes_id', $mes)->get(['referencia', 'arribo', 'despacho', 'tipo_id', 'mes_id']);

        $arrayTopsMes = [];

        foreach($embarques as $embarque)
        {
            if(count($arrayTopsMes) == 10)
            {
                break;
            }
            if($embarque->arribo && $embarque->despacho)
            {
                $fechaArribo = Carbon::parse($embarque->arribo);
                $fechaDespacho = Carbon::parse($embarque->despacho);

                $diferencia = $fechaDespacho->diffInDays($fechaArribo);

                 if($embarque->tipo_id == 1)
                 {
                    $validarTresDiasMaximo = $diferencia < 3;
                    if($validarTresDiasMaximo)
                    {
                        $arrayTopsMes[] = array('referencia' =>$embarque->referencia, 'dias_arribo_despacho' => $diferencia);
                    }
                 }
                 else
                 {
                    $validarCincoDiasMaximo = $diferencia < 5;
                    if($validarCincoDiasMaximo)
                    {
                        $arrayTopsMes[] = array('referencia' =>$embarque->referencia, 'dias_arribo_despacho' => $diferencia);
                    }
                 }
            }
        }

        return $arrayTopsMes;
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
            $fechaDocumentacion = $embarque->documentacion;
            $ajaxReferencias[] = $embarque->referencia;
            if($embarque->documentacion && $embarque->arribo)
            {
                $fechaArribo = Carbon::parse($embarque->arribo);
                $fechaDocumentacion = Carbon::parse($embarque->documentacion);

                $diferencia = $fechaDocumentacion->diffInDays($fechaArribo);
                $ajaxDocArribo[] = $diferencia;
            }
            else
            {
                $ajaxDocArribo[] = 0;
            }
            if ($embarque->arribo && $embarque->despacho) {

                $fechaArribo = Carbon::parse($embarque->arribo);
                $fechaDespacho = Carbon::parse($embarque->despacho);

                $diferencia = $fechaArribo->diffInDays($fechaDespacho);
                $ajaxArrDespacho[] = $diferencia;

            }
            else
            {
                $ajaxArrDespacho[] = 0;
            }
            if($embarque->despacho && $embarque->cuenta_gastos)
            {
                $fechaDespacho = Carbon::parse($embarque->despacho);
                $FechaCG = Carbon::parse($embarque->cuenta_gastos);

                $diferencia = $FechaCG->diffInDays($fechaDespacho);

                $ajaxDespCG[] = $diferencia;
            }
            else
            {
                $ajaxDespCG[] = 0;
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
