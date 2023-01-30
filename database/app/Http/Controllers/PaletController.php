<?php

namespace App\Http\Controllers;

use App\Imei;
use App\Palet;
use App\Almacen;
use App\paletOpo;
use App\paletsOpo;
use App\paletsZte;
use App\CajaMaster;
use App\ClienteAlmacen;
use App\PaletOppo;
use App\PaletZte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Mockery\Generator\StringManipulation\Pass\Pass;

class PaletController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $palets = Palet::orderBy('created_at', 'desc')->paginate(7);
        return view('palet.index', compact('palets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Almacen $almacen, Palet $palet)
    {
        //
        $modelos = Almacen::all(['id', 'modelo', 'cant_palet', 'color']);
        $clientes = ClienteAlmacen::all(['id', 'nombre']);
        $colores = Almacen::all(['id', 'color']);
        $week = date('W');
        // if ($week <= '7') {
        //     $weekCorrespondiente = 'week_1';
        // }
        // if ($week >= '8' && $week <= '14') {
        //     $weekCorrespondiente = 'week_2';
        // }
        // if ($week >= '15' && $week <= '21') {
        //     $weekCorrespondiente = 'week_3';
        // }
        // if ($week >= '22' && $week <= '28') {
        //     $weekCorrespondiente = 'week_4';
        // }
        // if ($week >= '29' && $week <= '31') {
        //     $weekCorrespondiente = 'week_5';
        // }

        return view('palet.create', compact('modelos', 'clientes', 'week', 'week', 'colores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Palet $palet, Almacen $almacen, Request $request)
    {
        $facturas = Palet::where('factura', $request['factura'])->get();
        //

        $data = $request->validate([
            'factura' => 'required',
            'n°_palet' => 'nullable',
            'week' => 'required',
            'modelo_id' => 'required',
            'total' => 'required',
            'cliente_id' => 'required'
        ]);
        $definirProvedor = '0';



        if ($request['cliente_id'] == '1') {
            $definirProvedor = 'ZTE';
            $definirProvedorMaster = 'DO';
            $idZte = IdGenerator::generate(['table' => 'palets', 'field' => 'n°_palet', 'length' => 14, 'prefix' => 'P' . date('y') . $definirProvedor . '0000000']);
            $id = 'P' . date('y') . $definirProvedor . '00000001';
            $idMaster = 'K' . date('y') . $definirProvedorMaster . '0000001';

            $contador = 0;
            $recortarId = substr($id, 13, 1);
            $recortarId = intval($recortarId);
            $recortarId = $recortarId - 1;
            $idAnterior = substr($id, 0, 13);
            $idCompuesto = $idAnterior . $recortarId;

            $idAnteriorMaster = substr($idMaster, 0, 11);

            $lastRecordDate = Palet::where('cliente_id', $request['cliente_id'])->pluck('n°_palet')->last();
            $lastRecordDateMaster = DB::table('caja_masters')->pluck('n°_caja_master')->last();
            $idUltimo = $lastRecordDate;
            $idUltimoMaster = $lastRecordDateMaster;
            if (strlen($lastRecordDate) <= 2) {

                $palet = new Palet($data);
                $palet->n°_palet = $id;
                $palet->save();
                // $palet = new Palet($data);
                // $palet->n°_palet = $id . $inicio;
                // $palet->save();
                if (strlen($lastRecordDateMaster) <= 2) {
                    CajaMaster::create(array(
                        'n°_caja_master' => $idMaster,
                        'factura' => $request['factura'],
                        'palet_id' => $palet->id,
                    ));
                }


                return redirect()->action('PaletController@index');
            }

            $idUltimo = substr($idUltimo, 12, 1);
            $idUltimo = intval($idUltimo);
            $idUltimo = $idUltimo + 1;
            $idUltimo = strval($idUltimo);
            $idUltimo = $idAnterior . $idUltimo;
            $palet = new Palet($data);
            $palet->n°_palet = $idUltimo;
            $palet->save();


            $idUltimoMaster = substr($idUltimoMaster, 12, 1);
            $idUltimoMaster = intval($idUltimoMaster);
            $idUltimoMaster = $idUltimoMaster + 1;
            $idUltimoMaster = strval($idUltimoMaster);
            $idUltimoMaster = $idAnteriorMaster . $idUltimoMaster;

            CajaMaster::create(array(
                'n°_caja_master' => $idUltimoMaster,
                'factura' => $request['factura'],
                'palet_id' => $palet->id,
            ));
        }

        if ($request['cliente_id'] == '2') {
            $definirProvedor = 'OPP';
            $idOppo = IdGenerator::generate(['table' => 'palets', 'field' => 'n°_palet', 'length' => 14, 'prefix' => 'P' . date('y') . $definirProvedor . '0000000']);
            $id = 'P' . date('y') . $definirProvedor . '00000001';
            $inicio = 1;
            $recortarId = substr($id, 13, 1);
            $recortarId = intval($recortarId);
            $recortarId = $recortarId - 1;
            $idAnterior = substr($id, 0, 13);
            $lastRecordDate = Palet::where('cliente_id', $request['cliente_id'])->pluck('n°_palet')->last();
            $idUltimo = $lastRecordDate;
            if (strlen($lastRecordDate) <= 2) {

                $palet = new Palet($data);
                $palet->n°_palet = $id;
                $palet->save();
                // $palet = new Palet($data);
                // $palet->n°_palet = $id . $inicio;
                // $palet->save();
                return redirect()->action('PaletController@index');
            }

            $idUltimo = substr($idUltimo, 13, 1);
            $idUltimo = intval($idUltimo);
            $idUltimo = $idUltimo + 1;
            $idUltimo = strval($idUltimo);
            $idUltimo = $idAnterior . $idUltimo;
            $palet = new Palet($data);
            $palet->n°_palet = $idUltimo;
            $palet->save();
            // dd(substr($iZte, -2, -1));
        }


        if ($request['cliente_id'] == '3') {
            $definirProvedor = 'VIV';
            $idViv = IdGenerator::generate(['table' => 'palets', 'field' => 'n°_palet', 'length' => 14, 'prefix' => 'P' . date('y') . $definirProvedor . '0000000']);
            $id = 'P' . date('y') . $definirProvedor . '00000001';
            $inicio = 1;
            $recortarId = substr($id, 13, 1);
            $recortarId = intval($recortarId);
            $recortarId = $recortarId - 1;
            $idAnterior = substr($id, 0, 13);
            $idCompuesto = $idAnterior . $recortarId;
            $lastRecordDate = Palet::where('cliente_id', $request['cliente_id'])->pluck('n°_palet')->last();
            $idUltimo = $lastRecordDate;
            if (strlen($lastRecordDate) <= 2) {

                $palet = new Palet($data);
                $palet->n°_palet = $id;
                $palet->save();
                // $palet = new Palet($data);
                // $palet->n°_palet = $id . $inicio;
                // $palet->save();
                return redirect()->action('PaletController@index');
            }

            $idUltimo = substr($idUltimo, 13, 1);
            $idUltimo = intval($idUltimo);
            $idUltimo = $idUltimo + 1;
            $idUltimo = strval($idUltimo);
            $idUltimo = $idAnterior . $idUltimo;
            $palet = new Palet($data);
            $palet->n°_palet = $idUltimo;
            $palet->save();
        }



        if ($request['cliente_id'] == '4') {
            $definirProvedor = 'CLO';
            $idViv = IdGenerator::generate(['table' => 'palets', 'field' => 'n°_palet', 'length' => 14, 'prefix' => 'P' . date('y') . $definirProvedor . '0000000']);
            $id = 'P' . date('y') . $definirProvedor . '00000001';
            $inicio = 1;
            $recortarId = substr($id, 13, 1);
            $recortarId = intval($recortarId);
            $recortarId = $recortarId - 1;
            $idAnterior = substr($id, 0, 13);
            $idCompuesto = $idAnterior . $recortarId;
            $lastRecordDate = Palet::where('cliente_id', $request['cliente_id'])->pluck('n°_palet')->last();
            $idUltimo = $lastRecordDate;
            if (strlen($lastRecordDate) <= 2) {

                $palet = new Palet($data);
                $palet->n°_palet = $id;
                $palet->save();
                // $palet = new Palet($data);
                // $palet->n°_palet = $id . $inicio;
                // $palet->save();
                return redirect()->action('PaletController@index');
            }

            $idUltimo = substr($idUltimo, 13, 1);
            $idUltimo = intval($idUltimo);
            $idUltimo = $idUltimo + 1;
            $idUltimo = strval($idUltimo);
            $idUltimo = $idAnterior . $idUltimo;
            $palet = new Palet($data);
            $palet->n°_palet = $idUltimo;
            $palet->save();
        }

        if ($request['cliente_id'] == '5') {
            $definirProvedor = 'REA';
            $idViv = IdGenerator::generate(['table' => 'palets', 'field' => 'n°_palet', 'length' => 14, 'prefix' => 'P' . date('y') . $definirProvedor . '0000000']);
            $id = 'P' . date('y') . $definirProvedor . '00000001';
            $inicio = 1;
            $recortarId = substr($id, 13, 1);
            $recortarId = intval($recortarId);
            $recortarId = $recortarId - 1;
            $idAnterior = substr($id, 0, 13);
            $idCompuesto = $idAnterior . $recortarId;
            $lastRecordDate = Palet::where('cliente_id', $request['cliente_id'])->pluck('n°_palet')->last();
            $idUltimo = $lastRecordDate;
            if (strlen($lastRecordDate) <= 2) {

                $palet = new Palet($data);
                $palet->n°_palet = $id;
                $palet->save();
                // $palet = new Palet($data);
                // $palet->n°_palet = $id . $inicio;
                // $palet->save();
                return redirect()->action('PaletController@index');
            }

            $idUltimo = substr($idUltimo, 13, 1);
            $idUltimo = intval($idUltimo);
            $idUltimo = $idUltimo + 1;
            $idUltimo = strval($idUltimo);
            $idUltimo = $idAnterior . $idUltimo;
            $palet = new Palet($data);
            $palet->n°_palet = $idUltimo;
            $palet->save();
        }

        if ($request['cliente_id'] == '6') {
            $definirProvedor = 'TEC';
            $idViv = IdGenerator::generate(['table' => 'palets', 'field' => 'n°_palet', 'length' => 14, 'prefix' => 'P' . date('y') . $definirProvedor . '0000000']);
            $id = 'P' . date('y') . $definirProvedor . '00000001';
            $inicio = 1;
            $recortarId = substr($id, 13, 1);
            $recortarId = intval($recortarId);
            $recortarId = $recortarId - 1;
            $idAnterior = substr($id, 0, 13);
            $idCompuesto = $idAnterior . $recortarId;
            $lastRecordDate = Palet::where('cliente_id', $request['cliente_id'])->pluck('n°_palet')->last();
            $idUltimo = $lastRecordDate;
            if (strlen($lastRecordDate) <= 2) {

                $palet = new Palet($data);
                $palet->n°_palet = $id;
                $palet->save();
                // $palet = new Palet($data);
                // $palet->n°_palet = $id . $inicio;
                // $palet->save();
                return redirect()->action('PaletController@index');
            }

            $idUltimo = substr($idUltimo, 13, 1);
            $idUltimo = intval($idUltimo);
            $idUltimo = $idUltimo + 1;
            $idUltimo = strval($idUltimo);
            $idUltimo = $idAnterior . $idUltimo;
            $palet = new Palet($data);
            $palet->n°_palet = $idUltimo;
            $palet->save();
        }



        // Obtener Cantidades
        // CajaMaster::create([
        //     'factura' => $palet->factura,
        //     'imei' => ''

        // ]);


        return redirect()->action('PaletController@index');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Palet $palet)
    {
        //
        $modelos = Almacen::all(['id', 'modelo']);
        $clientes = ClienteAlmacen::all(['id', 'nombre']);
        return view('palet.edit', compact('palet', 'modelos', 'clientes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Palet $palet)
    {
        //
        $data = $request->validate([
            'factura' => 'required',
            'week' => 'required',
            'modelo_id' => 'required',
            'total' => 'required',
            'cliente_id' => 'required'
        ]);

        if ($request['cliente_id'] == '1') {
            $definirProvedorPalet = 'ZTE';
            $idViv = IdGenerator::generate(['table' => 'palets', 'field' => 'n°_palet', 'length' => 14, 'prefix' => 'P' . date('y') . $definirProvedorPalet . '0000000']);
            $id = 'P' . date('y') . $definirProvedorPalet . '00000001';
            $inicio = 1;
            $recortarId = substr($id, 13, 1);
            $recortarId = intval($recortarId);
            $recortarId = $recortarId - 1;
            $idAnterior = substr($id, 0, 13);
            $idCompuesto = $idAnterior . $recortarId;
            $lastRecordDate = Palet::where('cliente_id', $request['cliente_id'])->pluck('n°_palet')->last();
            $idUltimo = $lastRecordDate;



            $idUltimo = substr($idUltimo, 13, 1);
            $idUltimo = intval($idUltimo);
            $idUltimo = $idUltimo + 1;
            $idUltimo = strval($idUltimo);
            $idUltimo = $idAnterior . $idUltimo;
            $palet->n°_palet = $request['n°_palet'];
            $palet->factura = $request['factura'];
            $palet->week = $request['week'];
            $palet->modelo_id = $request['modelo_id'];
            $palet->cliente_id = $request['cliente_id'];
            $palet->total = $request['total'];
            $palet->save();
        }

        if ($request['cliente_id'] == '2') {
            $definirProvedor = 'OPP';
            $idViv = IdGenerator::generate(['table' => 'palets', 'field' => 'n°_palet', 'length' => 14, 'prefix' => 'P' . date('y') . $definirProvedor . '0000000']);
            $id = 'P' . date('y') . $definirProvedor . '00000001';
            $inicio = 1;
            $recortarId = substr($id, 13, 1);
            $recortarId = intval($recortarId);
            $recortarId = $recortarId - 1;
            $idAnterior = substr($id, 0, 13);
            $idCompuesto = $idAnterior . $recortarId;
            $lastRecordDate = Palet::where('cliente_id', $request['cliente_id'])->pluck('n°_palet')->last();
            $idUltimo = $lastRecordDate;
            if (strlen($lastRecordDate) <= 2) {

                $palet->n°_palet = $request['n°_palet'];
                $palet->factura = $request['factura'];
                $palet->week = $request['week'];
                $palet->modelo_id = $request['modelo_id'];
                $palet->cliente_id = $request['cliente_id'];
                $palet->total = $request['total'];
                $palet->save();
                // $palet = new Palet($data);
                // $palet->n°_palet = $id . $inicio;
                // $palet->save();
                return redirect()->action('PaletController@index');
            }

            $idUltimo = substr($idUltimo, 13, 1);
            $idUltimo = intval($idUltimo);
            $idUltimo = $idUltimo + 1;
            $idUltimo = strval($idUltimo);
            $idUltimo = $idAnterior . $idUltimo;
            $palet->n°_palet = $request['n°_palet'];
            $palet->factura = $request['factura'];
            $palet->week = $request['week'];
            $palet->modelo_id = $request['modelo_id'];
            $palet->cliente_id = $request['cliente_id'];
            $palet->total = $request['total'];
            $palet->save();
        }


        if ($request['cliente_id'] == '3') {
            $definirProvedor = 'VIV';
            $idViv = IdGenerator::generate(['table' => 'palets', 'field' => 'n°_palet', 'length' => 14, 'prefix' => 'P' . date('y') . $definirProvedor . '0000000']);
            $id = 'P' . date('y') . $definirProvedor . '00000001';
            $inicio = 1;
            $recortarId = substr($id, 13, 1);
            $recortarId = intval($recortarId);
            $recortarId = $recortarId - 1;
            $idAnterior = substr($id, 0, 13);
            $idCompuesto = $idAnterior . $recortarId;
            $lastRecordDate = Palet::where('cliente_id', $request['cliente_id'])->pluck('n°_palet')->last();
            $idUltimo = $lastRecordDate;
            if (strlen($lastRecordDate) <= 2) {

                $palet->n°_palet = $request['n°_palet'];
                $palet->factura = $request['factura'];
                $palet->week = $request['week'];
                $palet->modelo_id = $request['modelo_id'];
                $palet->cliente_id = $request['cliente_id'];
                $palet->total = $request['total'];
                $palet->save();
                // $palet = new Palet($data);
                // $palet->n°_palet = $id . $inicio;
                // $palet->save();
                return redirect()->action('PaletController@index');
            }

            $idUltimo = substr($idUltimo, 13, 1);
            $idUltimo = intval($idUltimo);
            $idUltimo = $idUltimo + 1;
            $idUltimo = strval($idUltimo);
            $idUltimo = $idAnterior . $idUltimo;
            $palet->n°_palet = $request['n°_palet'];
            $palet->factura = $request['factura'];
            $palet->week = $request['week'];
            $palet->modelo_id = $request['modelo_id'];
            $palet->cliente_id = $request['cliente_id'];
            $palet->total = $request['total'];
            $palet->save();
        }


        if ($request['cliente_id'] == '4') {
            $definirProvedor = 'CLO';
            $idViv = IdGenerator::generate(['table' => 'palets', 'field' => 'n°_palet', 'length' => 14, 'prefix' => 'P' . date('y') . $definirProvedor . '0000000']);
            $id = 'P' . date('y') . $definirProvedor . '00000001';
            $inicio = 1;
            $recortarId = substr($id, 13, 1);
            $recortarId = intval($recortarId);
            $recortarId = $recortarId - 1;
            $idAnterior = substr($id, 0, 13);
            $idCompuesto = $idAnterior . $recortarId;
            $lastRecordDate = Palet::where('cliente_id', $request['cliente_id'])->pluck('n°_palet')->last();
            $idUltimo = $lastRecordDate;
            if (strlen($lastRecordDate) <= 2) {

                $palet->n°_palet = $request['n°_palet'];
                $palet->factura = $request['factura'];
                $palet->week = $request['week'];
                $palet->modelo_id = $request['modelo_id'];
                $palet->cliente_id = $request['cliente_id'];
                $palet->total = $request['total'];
                $palet->save();
                // $palet = new Palet($data);
                // $palet->n°_palet = $id . $inicio;
                // $palet->save();
                return redirect()->action('PaletController@index');
            }

            $idUltimo = substr($idUltimo, 13, 1);
            $idUltimo = intval($idUltimo);
            $idUltimo = $idUltimo + 1;
            $idUltimo = strval($idUltimo);
            $idUltimo = $idAnterior . $idUltimo;
            $palet->n°_palet = $request['n°_palet'];
            $palet->factura = $request['factura'];
            $palet->week = $request['week'];
            $palet->modelo_id = $request['modelo_id'];
            $palet->cliente_id = $request['cliente_id'];
            $palet->total = $request['total'];
            $palet->save();
        }

        if ($request['cliente_id'] == '5') {
            $definirProvedor = 'REA';
            $idViv = IdGenerator::generate(['table' => 'palets', 'field' => 'n°_palet', 'length' => 14, 'prefix' => 'P' . date('y') . $definirProvedor . '0000000']);
            $id = 'P' . date('y') . $definirProvedor . '00000001';
            $inicio = 1;
            $recortarId = substr($id, 13, 1);
            $recortarId = intval($recortarId);
            $recortarId = $recortarId - 1;
            $idAnterior = substr($id, 0, 13);
            $idCompuesto = $idAnterior . $recortarId;
            $lastRecordDate = Palet::where('cliente_id', $request['cliente_id'])->pluck('n°_palet')->last();
            $idUltimo = $lastRecordDate;
            if (strlen($lastRecordDate) <= 2) {

                $palet->n°_palet = $request['n°_palet'];
                $palet->factura = $request['factura'];
                $palet->week = $request['week'];
                $palet->modelo_id = $request['modelo_id'];
                $palet->cliente_id = $request['cliente_id'];
                $palet->total = $request['total'];
                $palet->save();
                // $palet = new Palet($data);
                // $palet->n°_palet = $id . $inicio;
                // $palet->save();
                return redirect()->action('PaletController@index');
            }

            $idUltimo = substr($idUltimo, 13, 1);
            $idUltimo = intval($idUltimo);
            $idUltimo = $idUltimo + 1;
            $idUltimo = strval($idUltimo);
            $idUltimo = $idAnterior . $idUltimo;
            $palet->n°_palet = $request['n°_palet'];
            $palet->factura = $request['factura'];
            $palet->week = $request['week'];
            $palet->modelo_id = $request['modelo_id'];
            $palet->cliente_id = $request['cliente_id'];
            $palet->total = $request['total'];
            $palet->save();
        }

        if ($request['cliente_id'] == '6') {
            $definirProvedor = 'TEC';
            $idViv = IdGenerator::generate(['table' => 'palets', 'field' => 'n°_palet', 'length' => 14, 'prefix' => 'P' . date('y') . $definirProvedor . '0000000']);
            $id = 'P' . date('y') . $definirProvedor . '00000001';
            $inicio = 1;
            $recortarId = substr($id, 13, 1);
            $recortarId = intval($recortarId);
            $recortarId = $recortarId - 1;
            $idAnterior = substr($id, 0, 13);
            $idCompuesto = $idAnterior . $recortarId;
            $lastRecordDate = Palet::where('cliente_id', $request['cliente_id'])->pluck('n°_palet')->last();
            $idUltimo = $lastRecordDate;
            if (strlen($lastRecordDate) <= 2) {

                $palet->n°_palet = $request['n°_palet'];
                $palet->factura = $request['factura'];
                $palet->week = $request['week'];
                $palet->modelo_id = $request['modelo_id'];
                $palet->cliente_id = $request['cliente_id'];
                $palet->total = $request['total'];
                $palet->save();
                // $palet = new Palet($data);
                // $palet->n°_palet = $id . $inicio;
                // $palet->save();
                return redirect()->action('PaletController@index');
            }

            $idUltimo = substr($idUltimo, 13, 1);
            $idUltimo = intval($idUltimo);
            $idUltimo = $idUltimo + 1;
            $idUltimo = strval($idUltimo);
            $idUltimo = $idAnterior . $idUltimo;
            $palet->n°_palet = $request['n°_palet'];
            $palet->factura = $request['factura'];
            $palet->week = $request['week'];
            $palet->modelo_id = $request['modelo_id'];
            $palet->cliente_id = $request['cliente_id'];
            $palet->total = $request['total'];
            $palet->save();
        }

        // Actualizar las facturas de todos los registros correspondientes
        Palet::where('factura', $palet->factura)->update(array(
            'factura' => $request['facturaNueva'],
        ));
        // Actualizar datos del palet actual
        $palet->modelo_id = $data['modelo_id'];
        $palet->total = $data['total'];
        $palet->cliente_id = $data['cliente_id'];
        $palet->save();

        // Actualizar datos de la caja master
        CajaMaster::where('factura', $palet->factura)->update(array(
            'factura' => $request['facturaNueva'],
        ));
        return redirect()->action('PaletController@index');
    }


    public function finish(Request $request, Palet $palet)
    {
        $id = IdGenerator::generate(['table' => 'palets', 'field' => 'n°_palet', 'length' => 13, 'prefix' => 'P' . date('y') . 'DO' . '0000000']);

        // Actualizar las facturas de todos los registros correspondientes
        Palet::where('factura', $palet->factura)->update(array(
            'n°_palet' => $id,
        ));

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Palet $palet)
    {
        $palet->delete();

        return redirect()->action('PaletController@index');
    }

    public function search(Palet $palet, Request $request)
    {
        $busqueda = $request->get('buscarDistribucion');

        $palets = Palet::where('week', 'like', '%' . $busqueda . '%')->paginate(7);
        $palets->appends(['buscarDistribucion' => $busqueda]);

        if (strlen($busqueda) == 0) {
            return back();
        }
        return view('busquedas.palet', compact('busqueda', 'palets'));
    }
}
