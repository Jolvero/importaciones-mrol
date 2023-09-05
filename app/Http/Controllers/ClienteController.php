<?php

namespace App\Http\Controllers;

use App\User;
use App\Cliente;
use App\Embarque;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Cliente $cliente)
    {
        $validarAdmin = Auth::user()->rol_id;

        if($validarAdmin !=1)
        {
            return back();
        }
        // registrar clientes
        $clientes = Cliente::all();
        foreach ($clientes as $cliente) {
            $cliente->cliente = Crypt::decryptString($cliente->cliente);
            if ($cliente->rfc) {
                $cliente->rfc = Crypt::decryptString($cliente->rfc);
            }

            if ($cliente->direccion) {
                $cliente->direccion = Crypt::decryptString($cliente->direccion);
            }
        }

        sleep(3);
        return view('clientes.index', compact('clientes'));
    }

    public function embarquesCliente()
    {
        $obtenerIdCliente = Auth::user()->cliente_id;
        $embarquesCliente = Embarque::where('cliente_id', $obtenerIdCliente)->get();
        return view('clientesEmbarques.index', compact('obtenerIdCliente', 'embarquesCliente'));
    }

    public function buscar(Embarque $embarque, Cliente $cliente, Request $request)
    {
        $busqueda = $request['buscar'];

        $embarques = Embarque::where('referencia', 'like', '%'. $busqueda. '%')->where('cliente_id', 'like', '%'. Auth::user()->cliente_id)->get();

        return view('busquedas.show', compact('embarques', 'busqueda'));

    }

    public function clientesAjax()
    {

        $validarUserAdmin = Auth::user()->rol_id;

        if($validarUserAdmin == 3)
        {
            return back();
        }
        $clientes = Cliente::all();

        foreach ($clientes as $cliente) {
            $cliente->cliente = Crypt::decryptString($cliente->cliente);

            if($cliente->rfc)
            {
                $cliente->rfc = Crypt::decryptString($cliente->rfc);
            }

            if($cliente->direccion)
            {
                $cliente->direccion = Crypt::decryptString($cliente->direccion);

            }
        }

        return $clientes;
    }

    public function clientesLabels()
    {
        $clientes = Cliente::all('cliente');
        $arregloClientes = [];

        foreach($clientes as $cliente)
        {
            $cliente->cliente = Crypt::decryptString($cliente->cliente);

            $arregloClientes[]= $cliente->cliente;
        }

        return $arregloClientes;
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
        $clientes = Cliente::all();

        foreach ($clientes as $cliente) {
            $cliente->cliente = Crypt::decryptString($cliente->cliente);
            if ($cliente->cliente == $request['cliente']) {
                return back()->with('validacion', 'El cliente ya existe');
            }

        }

        $data = $request->validate([
            'cliente' => 'required',
            'rfc' => 'nullable',
            'direccion' => 'nullable'
        ]);

        if ($request['rfc'] != null) {
            $data['rfc'] = Crypt::encryptString($data['rfc']);
        }

        if ($request['direccion'] != null) {
            $data['direccion'] = Crypt::encryptString($data['direccion']);
        }
        $data['cliente'] = Crypt::encryptString($data['cliente']);
        $cliente = new Cliente($data);
        $cliente->save();

        return redirect()->action('ClienteController@index')->with('success', 'Cliente Registrado exitosamente');

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
        $validarAdmin = Auth::user()->rol_id;

        if($validarAdmin !=1)
        {
            return back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        //
        $this->authorize('viewAny', $cliente);

        if ($cliente->rfc) {
            $cliente->rfc = Crypt::decryptString($cliente->rfc);
        }

        if ($cliente->direccion) {
            $cliente->direccion = Crypt::decryptString($cliente->direccion);
        }

        $cliente->cliente = Crypt::decryptString($cliente->cliente);
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        //
        $this->authorize('viewAny', $cliente);

        $data = $request->validate([
            'cliente' => 'required',
            'rfc' => 'nullable',
            'direccion' => 'nullable'
        ]);


        $data['cliente'] = Crypt::encryptString($data['cliente']);
        if ($request['rfc'] != null) {
            $data['rfc'] = Crypt::encryptString($data['rfc']);
            $cliente->rfc = $data['rfc'];
        }

        if ($request['direccion'] != null) {
            $data['direccion'] = Crypt::encryptString($data['direccion']);
            $cliente->direccion = $data['direccion'];

        }

        $cliente->cliente = $data['cliente'];

        $cliente->save();

        return redirect()->action('ClienteController@index');
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

        Cliente::whereid($id)->delete();
    }
}
