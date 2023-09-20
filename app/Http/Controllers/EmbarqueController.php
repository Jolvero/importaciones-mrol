<?php

namespace App\Http\Controllers;

use App\Kpi;
use App\File;
use App\Comida;
use App\Imagen;
use ZipArchive;
use App\Cliente;
use App\Despacho;
use App\Embarque;
use App\Documento;
use App\Mail\Kpis;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use App\CuentaEmbarque;
use App\EstadoEmbarque;
use App\DespachoProceso;
use App\EstatusDespacho;
use App\Mail\PrevioVivo;
use App\ElementoDespacho;
use App\Mail\DespachoMail;
use App\Mail\ProformaMail;
use App\ProformaPedimento;
use App\Policies\KpiPolicy;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\DocumentacionEmbarque;
use App\Exports\EmbarquesExport;
use App\Http\Requests\EmbarqueRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File as FacadesFile;

class EmbarqueController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Embarque $embarque)
    {
        ini_set('max_execution_time', 60);
        sleep(2);
        $this->authorize('index', $embarque);

        $embarques = Embarque::all();
        $clientes = Cliente::all();
        $mes = Carbon::now()->locale('es');
        $mesEspanol = $mes->monthName;
        $obtenerMeses = DB::table('mes')->get();

        foreach ($clientes as $cliente) {
            $cliente->cliente = Crypt::decryptString($cliente->cliente);
        }

        foreach($embarques as $embarque)
        {
            if($embarque->cliente != null)
            {
                $embarque->cliente->cliente = Crypt::decryptString($embarque->cliente->cliente);
            }


        }
        //
        // DB::table('estado_embarque')->get()->pluck('nombre', 'id');
        // Obtener los estados sin modelo
        // $estados = DB::table('estado_embarques')->get()->pluck('nombre', 'id');
        // $documentaciones = DB::table('documentacion_embarques')->get()->pluck('nombre', 'id');

        // $estados = DB::table('estado_embarques')->get()->pluck('nombre','id');
        $tipos = DB::table('tipoimportación')->get();
        $estados = EstadoEmbarque::all(['id', 'nombre']);
        $documentaciones = DocumentacionEmbarque::all(['id', 'nombre']);

        // $embarques = Embarque::all();
        return view('embarques.index', compact('clientes', 'mes', 'mesEspanol', 'obtenerMeses', 'estados', 'tipos', 'documentaciones', 'embarques'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Embarque $embarque)
    {
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmbarqueRequest $request)
    {

        // Validación
        $data = $request->validated();

        $uuidFiles = Uuid::uuid4();
        $uuidCta_Gastos = Uuid::uuid4();
        $uuidKpis = Uuid::uuid4();
        $uuidProforma = Uuid::uuid4();


        // Guardar los archivos de documentación en el servidor
        $files = $request->file('files');
        $filesProformaPedimento = $request->file('proforma_pedimento');
        $carpeta = $request['referencia'];
        $carpeta = preg_replace('/[+\;\(\)\/\ \#\|\|\" "]+/', '-', $carpeta);
        $carpeta = trim($carpeta);
        $uuidArchivo = $request['file_id'];

        // Guardar uuids
        $filesCG = $request->file('file_ctagastos');
        $uuidCuentaGastos = $request['uuid_cta_gastos'];
        $uuid_kpi = $request['uuid_kpi'];

        if ($request->hasFile('files')) {
            foreach ($_FILES['files']['size'] as $file) {

                if ($file > 20000000) {
                    return back()->with('estado', 'No pueden agregarse archivos mayores a 20 mb');
                }
            }
            foreach ($files as $file) {
                $nombre = $file->getClientOriginalName();
                $nombre = preg_replace('/[+\;\(\)\/\ \#\|\|\" "]+/', '-', $nombre);
                if (Storage::putFileAs('/public/' . $carpeta . '/', $file, $nombre)) {
                    File::create([
                        'name' => $nombre,
                        'id_embarque' => $uuidFiles,
                        'referencia' => $carpeta,
                    ]);
                }
            }
        }

        if ($request->hasFile('proforma_pedimento')) {
            foreach ($_FILES['proforma_pedimento']['size'] as $file) {
                if ($file > 20000000) {
                    return back()->with('estado', 'No pueden agregarse archivos mayores a 20 mb');
                }
            }
            foreach ($filesProformaPedimento as $file) {
                $nombre = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                if ($extension != 'pdf') {
                    return back()->with('estado', 'Solo puedes agregar archivos pdf a la proforma');
                }
                $nombre = preg_replace('/[+\;\(\)\/\ \#\|\" "]+/', '-', $nombre);

                Str::slug($nombre);
                if (Storage::putFileAs('/public/' . $carpeta . '/', $file, $nombre)) {
                    ProformaPedimento::create([
                        'name' => $nombre,
                        'id_embarque' => $uuidProforma,
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
                $nombreCtaGastos = preg_replace('/[+\;\(\)\/\ \#\|\" "]+/', '-', $nombreCtaGastos);
                if (Storage::putFileAs('/public/' . $carpeta . '/', $fileCG, $nombreCtaGastos)) {
                    CuentaEmbarque::create([
                        'name' => $nombreCtaGastos,
                        'id_embarque' => $uuidCta_Gastos,
                        'referencia' => $carpeta,
                    ]);
                }
            }
        }

        unset($carpeta);
        $embarque = new Embarque($data);
        $embarque->mes_id = $request['mes_id'];
        $embarque->file_id = $uuidFiles;
        $embarque->user = Auth::user()->name;
        $embarque->uuid_cta_gastos = $uuidCta_Gastos;
        $embarque->uuid_kpi = $uuidKpis;
        $embarque->uuid_proforma = $uuidProforma;
        $embarque->save();
        // Redireccionar
        return back()->with('success', 'Importación subida correctamente');
    }

    public function descargarPrevios(Embarque $embarque, FacadesFile $file)
    {
        $obtenerPrevios = Imagen::where('id_embarque', $embarque->uuid)->get();

        // crear carpeta nueva
        $carpeta = $embarque->referencia . '_previo';
        //validar si ya existe una carpeta y eliminarla
        $ruta = '/public/embarques/'. $carpeta;
        $validarCarpeta = Storage::exists('/public/embarques/'. $carpeta);
        if($validarCarpeta == true)
        {
            Storage::deleteDirectory($ruta);
        }
        Storage::makeDirectory('/public/embarques/' . $carpeta);

        foreach ($obtenerPrevios as $previo) {
            $obtenerLongitud = strlen($previo->ruta_imagen);
            $recortarRuta = substr($previo->ruta_imagen, 10, $obtenerLongitud);
            $file::copy(public_path('/storage/' . $previo->ruta_imagen), public_path('storage/embarques/' . $carpeta . '/' . $recortarRuta));
        }

        $zip = new ZipArchive;
        $fileName = $carpeta . '.zip';
        // eliminar carpeta zip anteriormente creada
        if(file_exists($fileName))
        {
             unlink(public_path($fileName));
        }

        if ($zip->open(public_path($fileName), ZipArchive::CREATE) == true) {

            $files = $file::files(public_path('/storage/embarques/' . $carpeta));

            foreach ($files as $file => $value) {
                $nombreRelativo = basename($value);
                $zip->addFile($value, $nombreRelativo);
            }
            $zip->close();
        }

        return response()->download(public_path($fileName));
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Embarque $embarque)
    {
        $this->authorize('view', $embarque);

        $imagenes = Imagen::where('id_embarque', $embarque->uuid)->get();
        $files = File::where('id_embarque', $embarque->file_id)->get();
        $cuentas = CuentaEmbarque::where('id_embarque', $embarque->uuid_cta_gastos)->get();
        $proforma = ProformaPedimento::where('id_embarque', $embarque->uuid_proforma)->get();
        $despachos = Despacho::all();
        $directorioPrevio = false;
        $obtenerLongitud = 0;
        $recortarRuta = '';

        return view('embarques.show', compact('embarque', 'imagenes', 'files', 'cuentas', 'proforma', 'despachos', 'directorioPrevio'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Embarque $embarque)
    {
        $this->authorize('update', $embarque);
        $clientes = Cliente::all();
        $tipos = DB::table('tipoimportación')->get();
        $meses = DB::table('mes')->get();
        $estados = EstadoEmbarque::all();
        $documentaciones = DocumentacionEmbarque::all();
        $elementosDespachos = Despacho::all();

        // Obtiene las imagenes
        $imagenes = Imagen::where('id_embarque', $embarque->uuid)->get();
        $proforma = ProformaPedimento::where('id_embarque', $embarque->uuid_proforma)->get();
        $files = File::where('id_embarque', $embarque->file_id)->get();
        $cuentas = CuentaEmbarque::where('id_embarque', $embarque->uuid_cta_gastos)->get();

        foreach ($clientes as $cliente) {
            $cliente->cliente = Crypt::decryptString($cliente->cliente);
        }


        return view('embarques.edit', compact('clientes', 'tipos', 'meses', 'estados', 'documentaciones', 'embarque', 'imagenes', 'files', 'cuentas', 'proforma', 'elementosDespachos'));
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

        // Validación
        $data = $request->validate([
            'cliente_id' => 'nullable',
            'tipo_id' => 'nullable',
            'mes_id' => 'nullable',
            'referencia' => 'required|min:7',
            'estado_id' => 'required',
            'documentacion_id' => 'required',
            'documentacion' => 'required',
            'file_id' => 'required',
            'prealertado' => 'required|date',
            'arribo' => 'nullable',
            'revalidación' => 'nullable',
            'pedimento' => 'nullable',
            'previo' => 'nullable|after_or_equal:arribo',
            'despacho' => 'nullable|after:arribo',
            'despacho_id' => 'required_if:estado_id,6',
            'cuenta_gastos' => 'nullable|after:previo',
            'pago_anticipo' => 'nullable',
            'uuid_cta_gastos' => 'required',
            'uuid' => 'required|uuid',
            'observaciones_pedimento' => 'nullable',
            'observaciones' => 'nullable'
        ]);


        $obtenerNombreProforma = '';
        $file = File::where('id_embarque', $embarque->file_id);
        // Guardar archivos de cuenta de gastos
        $filesCG = $request->file('file_ctagastos');

        //Crear la carpeta donde se guardarán los archivos de la documentación y almacenarlos en DB
        $files = $request->file('files');
        $filesProformaPedimento = $request->file('proforma_pedimento');
        $carpeta = $request['referencia'];
        $carpeta = preg_replace('/[+\;\(\)\/\ \#\|\|\" "]+/', '-', $carpeta);
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
                        'id_embarque' => $embarque->file_id,
                        'referencia' => $carpeta,
                    ]);
                }
            }
        }

        if ($request->hasFile('proforma_pedimento')) {
            foreach ($_FILES['proforma_pedimento']['size'] as $file) {
                if ($file > 20000000) {
                    return back()->with('estado', 'No pueden agregarse archivos mayores a 20 mb');
                }
            }
            //
            foreach ($filesProformaPedimento as $file) {
                $nombre = $file->getClientOriginalName();
                $obtenerNombreProforma = $nombre;
                $extension = $file->getClientOriginalExtension();
                if ($extension != 'pdf') {
                    return back()->with('estado', 'Solo puedes agregar archivos pdf a la proforma');
                }
                // Quitar espacios en blanco
                $nombre = str_replace(' ', '-', $nombre);
                $nombre = str_replace('#', '-', $nombre);
                $nombre = str_replace('', '-', $nombre);
                $carpeta = str_replace('+', '_', $carpeta);
                $carpeta = str_replace('|', '_', $carpeta);
                $carpeta = str_replace('/', '_', $carpeta);
                $carpeta = str_replace(' ', '_', $carpeta);

                Str::slug($nombre);
                if (Storage::putFileAs('/public/' . $carpeta . '/', $file, $nombre)) {
                    ProformaPedimento::create([
                        'name' => $nombre,
                        'id_embarque' => $embarque->uuid_proforma,
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
                        'id_embarque' => $embarque->uuid_cta_gastos,
                        'referencia' => $carpeta,
                    ]);
                }
            }
        }

        //desahcer variable carpeta para que la referencia aparezca correcta en la BD
        $carpetaAdjunto = $carpeta;
        unset($carpeta);
        //Asignar los valores
        $embarque->cliente_id = $data['cliente_id'];
        $embarque->tipo_id = $data['tipo_id'];
        $embarque->mes_id = $data['mes_id'];
        $embarque->referencia = $data['referencia'];
        // validar que se asigne estatus a despachado si se seleccione algun estatus de despacho


        $embarque->documentacion_id = $data['documentacion_id'];
        $embarque->documentacion = $data['documentacion'];
        $embarque->prealertado = $data['prealertado'];
        $embarque->arribo = $data['arribo'];
        $embarque->revalidación = $data['revalidación'];
        $embarque->pedimento = $data['pedimento'];
        $embarque->previo = $data['previo'];
        $embarque->despacho = $data['despacho'];
        $embarque->despacho_id = $data['despacho_id'];
        $embarque->cuenta_gastos = $data['cuenta_gastos'];
        $embarque->pago_anticipo = $data['pago_anticipo'];
        if ($request['observaciones_pedimento'] != null) {
            $embarque->observaciones_pedimento = $data['observaciones_pedimento'];
        }
        $embarque->observaciones = $data['observaciones'];

        $embarque->file_id = $embarque->file_id;
        $embarque->uuid_cta_gastos = $embarque->uuid_cta_gastos;

        $embarque->despacho_id ? $embarque->estado_id = 6 : $embarque->estado_id = $data['estado_id'];

        $embarque->save();

        if ($embarque->estado_id == 4 && $request['cliente_id'] == 2) {
            // validar si el usuario ha subido fotos
            $validarFotos = Imagen::where('id_embarque', $embarque->uuid)->count();

            if ($validarFotos > 0) {
                // mandar adjuntos por correo de previo

                $importacion = Embarque::whereId($embarque->id)->get();

                $adjuntos = [];
                $obtenerPrevios = Imagen::where('id_embarque', $embarque->uuid)->get();

                foreach ($obtenerPrevios as $foto) {
                    $adjuntos[] = storage_path('app/public/' . $foto->ruta_imagen);
                }

                Mail::to('yessica.viloria@mx.vivo.com')->cc('Cristian.Castellanos@mx.vivo.com')->bcc('sistemas@mrollogistics.com.mx')->send(new PrevioVivo($importacion, $adjuntos));
            }
        }

        if ($request['estado_id'] == 5 && $obtenerNombreProforma != '' && $request['cliente_id'] == 2) {
            $importacion = Embarque::whereId($embarque->id)->get();

            $obtenerProforma = storage_path('app/public/' . $carpetaAdjunto . '/' . $obtenerNombreProforma);

            Mail::to('yessica.viloria@mx.vivo.com')->cc('Cristian.Castellanos@mx.vivo.com')->bcc('sistemas@mrollogistics.com.mx')->send(new ProformaMail($importacion, $obtenerProforma));
        }

        if ($request['estado_id'] == 6 && $request['cliente_id'] == 2) {
            $despacho = Embarque::whereId($embarque->id)->get();
            Mail::to('yessica.viloria@mx.vivo.com')->cc('Cristian.Castellanos@mx.vivo.com')->bcc('sistemas@mrollogistics.com.mx')->send(new DespachoMail($despacho));
        }

        // Redireccionar
        return redirect()->action('EmbarqueController@index')->with('success', 'Importación actualizada');
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
        $proformas = ProformaPedimento::where('id_embarque', $embarque->uuid_proforma);

        // Ubicación de archivos del embarque
        $carpeta = $embarque->referencia;
        $carpeta = str_replace('+', '_', $carpeta);
        $carpeta = str_replace('|', '_', $carpeta);
        $carpeta = str_replace('/', '_', $carpeta);
        Storage::deleteDirectory("storage/" . $carpeta);

        // Eliminar registros de la BD

        // Elimina la documentación de la base de datos
        $file->delete();
        // Elimina archivos de cuentas de gastos
        $fileCG->delete();
        // Elimina las imagenes de previo
        $imagenes->delete();
        // Eliminar el KPI
        // Eliminar Proformas
        $proformas->delete();
        //Eliminar el embarque
        $embarque->delete();


    }
    // Busqueda de embarques en la página principal
    public function search(Embarque $embarque, Request $request)
    {
        // $busqueda = $request['buscar'];
        $busqueda = $request->get('buscar');

        $embarques = Embarque::where('referencia', 'like', '%' . $busqueda . '%')->paginate(3);
        $embarques->appends(['buscar' => $busqueda]);

        if (strlen($busqueda) < 12) {
            return back();
        }

        return view('busquedas.show', compact('embarques', 'busqueda'));
    }


}
