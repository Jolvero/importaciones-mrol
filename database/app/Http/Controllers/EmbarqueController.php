<?php

namespace App\Http\Controllers;

use App\File;
use App\Imagen;
use App\Embarque;
use App\Documento;
use App\CuentaEmbarque;
use App\EstadoEmbarque;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\DocumentacionEmbarque;
use App\Exports\EmbarquesExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class EmbarqueController extends Controller
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
    public function index(Embarque $embarque)
    {
        $this->authorize('index', $embarque);

        // $embarques = auth()->user()->embarques;


        // Embarques con paginación
        $embarques = Embarque::paginate(7);

        // $embarques = Embarque::all();
        return view('embarques.index')->with('embarques', $embarques);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Embarque $embarque)
    {
        $this->authorize('create', $embarque);
        //
        // DB::table('estado_embarque')->get()->pluck('nombre', 'id');
        // Obtener los estados sin modelo
        // $estados = DB::table('estado_embarques')->get()->pluck('nombre', 'id');
        // $documentaciones = DB::table('documentacion_embarques')->get()->pluck('nombre', 'id');

        // $estados = DB::table('estado_embarques')->get()->pluck('nombre','id');
        $estados = EstadoEmbarque::all(['id', 'nombre']);
        $documentaciones = DocumentacionEmbarque::all(['id', 'nombre']);
        return view('embarques.create', compact('estados', 'documentaciones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Embarque $embarque)
    {

        // Validación
        $data = $request->validate([
            'referencia' => 'required|min:7',
            'estado_id' => 'required',
            'documentacion_id' => 'required',
            'file_id' => 'required',
            'prealertado' => 'required|date',
            'arribo' => 'required|date|after:documentación',
            'revalidación' => 'nullable',
            'pedimento' => 'nullable',
            'previo' => 'nullable',
            'despacho' => 'nullable',
            'cuenta_gastos' => 'nullable',
            'uuid_cta_gastos' => 'required',
            'uuid' => 'required|uuid',
            'observaciones' => 'nullable'
        ]);



        // Guardar los archivos de documentación en el servidor
        $files = $request->file('files');
        $carpeta = $request['referencia'];
        $carpeta = trim($carpeta);
        $uuidArchivo = $request['file_id'];


        // Guardar archivos de cuenta de gastos
        $filesCG = $request->file('file_ctagastos');
        $uuidCuentaGastos = $request['uuid_cta_gastos'];



        if ($request->hasFile('files')) {
            foreach ($_FILES['files']['size'] as $file) {
                if ($file > 20000000) {
                    return back()->with('estado', 'No pueden agregarse archivos mayores a 20 mb');
                }
            }
            foreach ($files as $file) {
                $extension = $file->getClientOriginalExtension();
                $nombre = $file->getClientOriginalName();

                // Quitar espacios en blanco
                $nombre = str_replace(' ', '-', $nombre);
                $carpeta = str_replace('+', '_', $carpeta);
                $carpeta = str_replace('|', '_', $carpeta);
                $carpeta = str_replace('/', '_', $carpeta);
                $carpeta = str_replace(' ', '_', $carpeta);
                if (Storage::putFileAs('/public/' . $carpeta . '/', $file, $nombre)) {
                    File::create([
                        'name' => $nombre,
                        'id_embarque' => $uuidArchivo,
                        'referencia' => $carpeta,
                    ]);
                }
            }
        }

        // Almacenar cuentas de gastos
        if ($request->hasFile('file_ctagastos')) {
            foreach ($_FILES['file_ctagastos']['size'] as $file) {
                if ($file > 20000000) {
                    return back()->with('estado', 'Las cuentas de gastos no deben pesar mas de 20 mb');
                }
            }

            foreach ($filesCG as $fileCG) {
                $nombreCtaGastos = $fileCG->getClientOriginalName();
                $nombreCtaGastos = str_replace(' ', '-', $nombreCtaGastos);

                $carpeta = str_replace('+', '_', $carpeta);
                $carpeta = str_replace('|', '_', $carpeta);
                $carpeta = str_replace('/', '_', $carpeta);
                if (Storage::putFileAs('/public/' . $carpeta . '/', $fileCG, $nombreCtaGastos)) {
                    CuentaEmbarque::create([
                        'name' => $nombreCtaGastos,
                        'id_embarque' => $uuidCuentaGastos,
                        'referencia' => $carpeta,
                    ]);
                }
            }
        }

        unset($carpeta);
        $embarque = new Embarque($data);
        $embarque->user_id = auth()->user()->id;
        $embarque->file_id = $uuidArchivo;
        $embarque->uuid_cta_gastos = $uuidCuentaGastos;
        $embarque->save();

        // Redireccionar
        return redirect()->action('EmbarqueController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Embarque $embarque)
    {
        $imagenes = Imagen::where('id_embarque', $embarque->uuid)->get();
        $files = File::where('id_embarque', $embarque->file_id)->get();
        $cuentas = CuentaEmbarque::where('id_embarque', $embarque->uuid_cta_gastos)->get();
        return view('embarques.show', compact('embarque', 'imagenes', 'files', 'cuentas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Embarque $embarque)
    {
        $this->authorize('view', $embarque);

        $estados = EstadoEmbarque::all();
        $documentaciones = DocumentacionEmbarque::all();

        // Obtiene las imagenes
        $imagenes = Imagen::where('id_embarque', $embarque->uuid)->get();
        $files = File::where('id_embarque', $embarque->file_id)->get();
        $cuentas = CuentaEmbarque::where('id_embarque', $embarque->uuid_cta_gastos)->get();

        return view('embarques.edit', compact('estados', 'documentaciones', 'embarque', 'imagenes', 'files', 'cuentas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Embarque $embarque, File $file)
    {

        // Revisar el Policy
        $this->authorize('update', $embarque);

        //
        // Validación
        $data = $request->validate([
            'referencia' => 'required|min:7',
            'estado_id' => 'required',
            'documentacion_id' => 'required',
            'file_id' => 'required',
            'prealertado' => 'required|date',
            'arribo' => 'required|date|after:documentación',
            'revalidación' => 'nullable',
            'pedimento' => 'nullable',
            'previo' => 'nullable',
            'despacho' => 'nullable',
            'cuenta_gastos' => 'nullable',
            'uuid_cta_gastos' => 'required',
            'uuid' => 'required|uuid',
            'observaciones' => 'nullable'
        ]);

        $file = File::where('id_embarque', $embarque->file_id);

        // Guardar archivos de cuenta de gastos
        $filesCG = $request->file('file_ctagastos');
        $uuidCuentaGastos = $request['uuid_cta_gastos'];

        //Crear la carpeta donde se guardarán los archivos de la documentación y almacenarlos en DB
        $files = $request->file('files');
        $carpeta = $request['referencia'];
        $uuidArchivo = $request['file_id'];
        if ($request->hasFile('files')) {

            foreach ($_FILES['files']['size'] as $file) {
                if ($file > 20000000) {
                    return back()->with('estado', 'No pueden agregarse archivos mayores a 10 MB');
                }
            }
            foreach ($files as $file) {
                $nombre = $file->getClientOriginalName();
                $nombre = str_replace(' ', '-', $nombre);
                $carpeta = str_replace('+', '_', $carpeta);
                $carpeta = str_replace('|', '_', $carpeta);
                $carpeta = str_replace('/', '_', $carpeta);
                if (Storage::putFileAs('/public/' . $carpeta . '/', $file, $nombre)) {
                    File::create([
                        'name' => $nombre,
                        'id_embarque' => $uuidArchivo,
                        'referencia' => $carpeta,
                    ]);
                }
            }
        }
        // Almacenar cuentas de gastos
        if ($request->hasFile('file_ctagastos')) {
            foreach ($_FILES['file_ctagastos']['size'] as $file) {
                if ($file > 20000000) {
                    return back()->with('estado', 'Las cuentas de gastos no deben pesar mas de 10 mb');
                }
            }
            foreach ($filesCG as $fileCG) {
                $nombreCtaGastos = $fileCG->getClientOriginalName();
                $nombreCtaGastos = str_replace('+', '_', $nombreCtaGastos);
                $carpeta = str_replace('+', '_', $carpeta);
                $carpeta = str_replace('|', '_', $carpeta);
                $carpeta = str_replace('/', '_', $carpeta);
                if (Storage::putFileAs('/public/' . $carpeta . '/', $fileCG, $nombreCtaGastos)) {
                    CuentaEmbarque::create([
                        'name' => $nombreCtaGastos,
                        'id_embarque' => $uuidCuentaGastos,
                        'referencia' => $carpeta,
                    ]);
                }
            }
        }

        //desahcer variable carpeta para que la referencia aparezca correcta en la BD
        unset($carpeta);
        //Asignar los valores
        $embarque->referencia = $data['referencia'];
        $embarque->estado_id = $data['estado_id'];
        $embarque->documentacion_id = $data['documentacion_id'];
        $embarque->prealertado = $data['prealertado'];
        $embarque->arribo = $data['arribo'];
        $embarque->revalidación = $data['revalidación'];
        $embarque->pedimento = $data['pedimento'];
        $embarque->previo = $data['previo'];
        $embarque->despacho = $data['despacho'];
        $embarque->cuenta_gastos = $data['cuenta_gastos'];
        $embarque->uuid = $data['uuid'];
        $embarque->observaciones = $data['observaciones'];


        $embarque->file_id = $uuidArchivo;
        $embarque->uuid_cta_gastos = $uuidCuentaGastos;
        $embarque->save();

        // Redireccionar
        return redirect()->action('EmbarqueController@index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Embarque $embarque)
    {
        // Ejecutar el Policy
        $this->authorize('delete', $embarque);

        $file = File::where('id_embarque', $embarque->file_id);
        $fileCG = CuentaEmbarque::where('id_embarque', $embarque->uuid_cta_gastos);
        $imagenes = Imagen::where('id_embarque', $embarque->uuid);

        // Ubicación de archivos del embarque
        $carpeta = $embarque->referencia;
        $carpeta = str_replace('+', '_', $carpeta);
        $carpeta = str_replace('|', '_', $carpeta);
        $carpeta = str_replace('/', '_', $carpeta);


        $validarArchivo = ("storage" . "/" . $carpeta);
        // Elimina los archivos de documentación del servidor
        $archivos = glob("storage" . "/" . $carpeta . "/*");
        if (file_Exists($validarArchivo)) {
            foreach ($archivos as $archivo) {
                if (is_file($archivo)) {
                    unlink($archivo);
                }
            }
            rmdir("storage" . "/" . $carpeta);
        }

        // Eliminar registros de la BD

        // Elimina la documentación de la base de datos
        $file->delete();
        // Elimina archivos de cuentas de gastos
        $fileCG->delete();
        // Elimina las imagenes de previo
        $imagenes->delete();
        //Eliminar el embarque
        $embarque->delete();


        return redirect()->action('EmbarqueController@index');
    }
    // Busqueda de embarques en la página principal
    public function search(Request $request)
    {

        // $busqueda = $request['buscar'];
        $busqueda = $request->get('buscar');

        $embarques = Embarque::where('referencia', 'like', '%' . $busqueda . '%')->paginate(3);
        $embarques->appends(['buscar' => $busqueda]);

        if (strlen($busqueda) <12) {
            return back();
        }

        return view('busquedas.show', compact('embarques', 'busqueda'));
    }

    // Busqueda de embarques en el panel de administración
    public function searchEmbarque(Request $request)
    {
        // $busqueda = $request['buscar'];
        $busqueda = $request->get('buscarEmbarque');

        $embarques = Embarque::where('referencia', 'like', '%' . $busqueda . '%')->paginate(5);
        $embarques->appends(['buscarEmbarque' => $busqueda]);

        if (strlen($busqueda) == 0) {
            return back();
        }

        return view('busquedas.show2', compact('embarques', 'busqueda'));
    }

    public function exportExcel()
    {
        return Excel::download(new EmbarquesExport, 'embarques.xlsx');

    }
}
