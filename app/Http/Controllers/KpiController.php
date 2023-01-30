<?php

namespace App\Http\Controllers;

use App\Kpi;
use App\User;
use App\Cliente;
use App\Embarque;
use App\Mail\Kpis;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;

class KpiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $validarAdmin = Auth::user()->rol_id;

        if($validarAdmin !=1)
        {
            return back();
        }

        $tipos = DB::table('tipoimportación')->get();
        $meses = DB::table('meses')->get();
        $mes = Carbon::now()->locale('es');
        $mesEspanol = $mes->monthName;
        $clientes = Cliente::all();

        foreach($clientes as $cliente)
        {
            $cliente->cliente = Crypt::decryptString($cliente->cliente);
        }

        sleep(3);

        //
        return view('KPIs.index', compact('tipos', 'meses', 'mes', 'mesEspanol', 'clientes'));
    }

    public function obtenerKpis($mes, $tipo, $cliente)
    {

        $user = Auth::user()->rol_id;

        if($user == 3)
        {
            return back();
        }
        $ajaxPrincipal = [];
        $ajaxDocArribo = [];
        $ajaxArrDespacho = [];
        $ajaxDespCG = [];
        $ajaxReferencias = [];
        $embarques = Embarque::whereMonth('created_at', $mes)->where('tipo_id', $tipo)->where('cliente_id', $cliente)->get();
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
            $ajaxPrincipal[]= $ajaxDocArribo;
            $ajaxPrincipal[]= $ajaxArrDespacho;
            $ajaxPrincipal[]= $ajaxDespCG;
            $ajaxPrincipal[]= $ajaxReferencias;

        }


            return $ajaxPrincipal;




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

    public function enviarKpis(Request $request, Kpi $kpis)
    {
        if ($request['cliente'] == '0' && strlen($request['email'] == 0)) {
            return back()->with('form', 'Debes seleccionar un cliente y ingresar un Correo Electrónico');
        }

        if ($request['tipo'] == '0') {
            $kpisCliente = Kpi::where('id_mes', $request['mes'])->where('id_cliente', $request['cliente'])->get();

            if (strlen($kpisCliente) < 5) {
                return back()->with('form', 'No puedes enviar un Correo sin datos');
            }
            Mail::to($request['email'])->send(new Kpis($kpisCliente));

            return back()->with('successform', 'KPIs enviados');
        }


        if ($request['tipo'] !== '0') {
            $kpis = Kpi::where('id_mes', $request['mes'])->where('id_tipo', $request['tipo'])->where('id_cliente', $request['cliente'])->get();

            if (strlen($kpis) < 5) {

                return back()->with('form', 'No puedes enviar un Correo Vacío');
            }
            Mail::to($request['email'])->send(new Kpis($kpis));

            return back()->with('successform', 'KPIs enviados');

        }
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
     * @param  \App\Kpi  $kpi
     * @return \Illuminate\Http\Response
     */
    public function show(Kpi $kpi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kpi  $kpi
     * @return \Illuminate\Http\Response
     */
    public function edit(Kpi $kpi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kpi  $kpi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kpi $kpi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kpi  $kpi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kpi $kpi)
    {
        //
    }
}
