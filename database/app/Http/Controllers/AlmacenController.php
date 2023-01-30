<?php

namespace App\Http\Controllers;

use App\User;
use App\Almacen;
use App\Cliente;
use App\Embarque;
use App\ClienteAlmacen;
use App\Imei;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\New_;
use PhpParser\Node\Stmt\Foreach_;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class AlmacenController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show', 'search']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $almacenes = Almacen::orderBy('created_at', 'desc')->paginate(7);
        return view('almacen.index', compact('almacenes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Almacen $almacen)
    {
        $this->authorize('create', $almacen);

        $clientes = ClienteAlmacen::all(['id', 'nombre']);
        return view('almacen.create', compact('clientes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Almacen $almacen, Imei $imei)
    {
        // Validación
        $data = $request->validate([
            'cliente_id' => 'required',
            'color' => 'required',
            'modelo' => 'required',
            'cant_palet' => 'required|numeric',
            'medidas_caja_individual' => 'required',
            'medidas_caja_master' => 'required',
            'imagen' => 'nullable'
        ]);
        $carpeta = $request['modelo'];
        if($request['imagen']) {
            // obtener la ruta de la imagen
            $ruta_imagen = $request['imagen']->store('catalogo/'  . $carpeta, 'public');

            // Resize a la imagen
            $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(900, 900);
            $img->save();
       }

        $almacen = new Almacen($data);
        if($request->hasFile('imagen'))
        {
         $almacen->imagen = $ruta_imagen;
        }
        $almacen->save();


        return redirect()->action('AlmacenController@index');
    }

    // Guardar los archivos en la DB


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Almacen $almacen)
    {
        //
        $this->authorize('view', $almacen);
        return view('almacen.show', compact('almacen'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Almacen $almacen)
    {
        //
        $this->authorize('view', $almacen);
        $clientes = ClienteAlmacen::all();
        return view('almacen.edit', compact('almacen', 'clientes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Almacen $almacen)
    {
        // Validación
        $data = $request->validate([
            'cliente_id' => 'required',
            'modelo' => 'required',
            'color' => 'required',
            'cant_palet' => 'required|numeric',
            'medidas_caja_individual' => 'required',
            'medidas_caja_master' => 'required',
            'imagen' => 'nullable'
        ]);
        $carpeta = $request['modelo'];

        if($request['imagen']) {
            // obtener la ruta de la imagen
            $ruta_imagen = $request['imagen']->store('catalogo/'  . $carpeta, 'public');

            // Resize a la imagen
            $img = Image::make(public_path("storage/{$ruta_imagen}"));
            $img->save();

            // crear un arreglo de imagen
            $array_imagen = ['imagen' => $ruta_imagen];
       }

        $almacen->cliente_id = $data['cliente_id'];
        $almacen->modelo = $data['modelo'];
        $almacen->color = $data['color'];
        $almacen->cant_palet = $data['cant_palet'];
        $almacen->medidas_caja_individual = $data['medidas_caja_individual'];
        if($request->hasFile('imagen'))
        {
         $almacen->imagen = $ruta_imagen;
        } else
        $array_imagen ?? [];
        $almacen->save();

        return redirect()->action('AlmacenController@index');


    }

    public function search(Request $request)
    {
        $busqueda = $request->get('buscar');
        $almacenes = Almacen::where('modelo', 'like', '%' . $busqueda . '%')->paginate(3);
        $almacenes->appends(['buscar' => $busqueda]);

        if(strlen($busqueda) == 0)
        {
            return back();
        }
        return view('busquedas.almacen', compact('almacenes', 'busqueda'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Almacen $almacen)
    {
        //
        $this->authorize('delete', $almacen);
        $carpeta = $almacen->modelo;
        $almacen = Almacen::where('id', $almacen->id);
        $validarArchivo = ("storage" . "/" . "catalogo" . '/' . $carpeta);
        $archivos = glob("storage" . "/" . "catalogo" .  '/' . $carpeta . "/*");
        if(file_exists($validarArchivo)) {
            foreach($archivos as $archivo) {
                if(is_file($archivo)) {
                    unlink($archivo);
                }
            }
            rmdir("storage" . "/" . "catalogo" . '/'. $carpeta);
        }
        $almacen->delete();

        return redirect()->action('AlmacenController@index');
    }
}
