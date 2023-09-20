@extends('layouts.app')

@section('scripts')
    <script src="{{ asset('js/embarques.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/dropzone.min.js"
        integrity="sha512-Mn7ASMLjh+iTYruSWoq2nhoLJ/xcaCbCzFs0ZrltJn7ksDBx+e7r5TS7Ce5WH02jDr0w5CmGgklFoP9pejfCNA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>
    <script src="{{ asset('js/spinner.js') }}" defer></script>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/dropzone.min.css"
        integrity="sha512-0ns35ZLjozd6e3fJtuze7XJCQXMWmb4kPRbb+H/hacbqu6XfIX0ZRGt6SrmNmv5btrBpbzfdISSd8BAsXJ4t1Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
@endsection

@section('botones')
    <div data-aos="fade-right" data-aos-duration="1000" class="ml-5 ml-md-0">
        <a href="{{ route('embarques.index') }}" class="text-dark btn btn-outline-primary" id="btnvolver"
            class="btn btn-outline-primary mr-2 text-uppercase font-weight-bold mt-5">
            <svg class="w-6 h-6 icono" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z"
                    clip-rule="evenodd"></path>
            </svg>
            Volver</a>
    </div>
@endsection
<style>
    @media(min-width:768px) {
        .formulario {
            max-width: 70%;
        }
    }
</style>
@section('content')

    <h2 class="text-center text-dark font-weight-bold mb-5">Editar Importación: {{ $embarque->referencia }}</h2>

    @if (session('estado'))
        <div class="alert alert-primary" role="alert">
            {{ session('estado') }}
        </div>
    @endif
    <div class="row justify-content-start mt-5 ml-5 ml-md-0 formulario" data-aos="fade-up" data-aos-duration="1000">
        <div class="col-md-8">
            @if ($embarque->uuid_proforma)
                <div class="table-responsive text-dark">
                    <div class="card-body">
                        <div class="card-header m-2 shadow">
                            <h3 class="card-title text-center">Proforma</h3>
                        </div>
                        <table class="table text-dark">
                            <thead>
                                <tr>
                                    <th scope="col">Nombre </th>
                                    <th scope="col">Ver</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($proforma as $proforma)
                                    <tr class="text-dark">
                                        <td scope="row">{{ $proforma->name }}</td>
                                        <td>
                                            <a target="blank" href="{{ route('proforma.show', $proforma->name) }}"
                                                class="btn btn-sm btn-outline-secondary">Ver
                                            </a>
                                        </td>

                                        <td>

                                            <form action="{{ route('proforma.destroy', $proforma->name) }}" method="POST"
                                                class="text-dark">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                    Eliminar
                                                </button>
                                            </form>


                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
            <div class="card-body text-dark">
                <div class="card-header m-2 shadow ">
                    <h3 class="card-title text-center">Documentación</h3>
                </div>
                <div class="table-responsive">
                    <table class="table text-dark">
                        <thead>
                            <tr class="text-dark">
                                <th scope="col">Nombre </th>
                                <th scope="col">Ver</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($files as $file)
                                <tr class="text-dark">
                                    <td scope="row">{{ $file->name }}</td>
                                    <td>
                                        <a target="blank" href="{{ route('files.show', $file->name) }}"
                                            class="btn btn-sm btn-outline-secondary text-dark">Ver
                                        </a>
                                    </td>
                                    <td>

                                        <form action="{{ route('files.destroy', $file->name) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

            <div class="table-responsive text-dark">
                <div class="card-body">
                    <div class="card-header m-2 shadow">
                        <h3 class="card-title text-center">Cuentas de Gastos</h3>
                    </div>
                    <table class="table text-dark">
                        <thead>
                            <tr>
                                <th scope="col">Nombre </th>
                                <th scope="col">Ver</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($cuentas as $cuenta)
                                <tr class="text-dark">
                                    <td scope="row">{{ $cuenta->name }}</td>
                                    <td>
                                        <a target="blank" href="{{ route('cuentas.show', $cuenta->name) }}"
                                            class="btn btn-sm btn-outline-secondary">Ver
                                        </a>
                                    </td>

                                    <td>

                                        <form action="{{ route('cuentas.destroy', $cuenta->name) }}" method="POST"
                                            class="text-dark">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                Eliminar
                                            </button>
                                        </form>


                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>



            <form enctype="multipart/form-data" method="POST" class="text-dark form-edit"
                action="{{ route('embarques.update', ['embarque' => $embarque->id]) }}" id="formulario" novalidate>
                @csrf
                @method('PUT')
                <p>Campos obligatorios  <span class="text-danger">*</span></p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cliente_id">Cliente <span class="text-danger">*</span></label>
                            <select name="cliente_id" class="form-control @error('cliente_id') is-invalid @enderror"
                                id="cliente_id">
                                <option value="">-- Seleccione --</option>
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->id }}"
                                        {{ $embarque->cliente_id == $cliente->id ? 'selected' : '' }}>
                                        {{ $cliente->cliente }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tipo_id">Tipo Importación <span class="text-danger">*</span></label>
                            <select name="tipo_id" id="tipo_id"
                                class="form-control @error('tipo_id') is-invalid @enderror">
                                <option value="">-- Seleccione --</option>
                                @foreach ($tipos as $tipo)
                                    <option value="{{ $tipo->id }}"
                                        {{ $embarque->tipo_id == $tipo->id ? 'selected' : '' }}>
                                        {{ $tipo->tipo }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="mes_id">Mes <span class="text-danger">*</span></label>


                            <select name="mes_id" id="mes_id" class="form-control @error('mes_id') is-invalid
                            @enderror">
                                <option value="">-- Seleccione --</option>
                                @foreach ($meses as $mes)
                                    <option value="{{ $mes->id }}"
                                        {{ $embarque->mes_id == $mes->id ? 'selected' : '' }}>
                                        {{ $mes->mes }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="referencia">Referencia <span class="text-danger">*</span></label>
                            <input type="text" name="referencia"
                                class="form-control @error('referencia') is-invalid @enderror" id="referencia"
                                placeholder="Referencia" value="{{ $embarque->referencia }}">

                            @error('referencia')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="estado_id">Estado <span class="text-danger">*</span></label>
                            <select name="estado_id" class="form-control @error('estado_id') is-invalid @enderror"
                                id="estado_id">
                                <option value="">-- Seleccione --</option>
                                @foreach ($estados as $estado)
                                    <option value="{{ $estado->id }}"
                                        {{ $embarque->estado_id == $estado->id ? 'selected' : '' }}> {{ $estado->nombre }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group ">
                            <label for="prealertado"></label>Prealertado <span class="text-danger">*</span>
                            <input class="form-control mt-2 @error('prealertado') is-invalid @enderror" type="date"
                                name="prealertado" id="prealertado" value="{{ $embarque->prealertado }}">
                            @error('prealertado')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="documentacion_id">Estatus Documentación <span class="text-danger">*</span></label>
                            <select name="documentacion_id"
                                class="form-control @error('documentacion_id') is-invalid @enderror"
                                id="documentacion_id">
                                <option value="">-- Seleccione --</option>
                                @foreach ($documentaciones as $documentacion)
                                    <option value="{{ $documentacion->id }}"
                                        {{ $embarque->documentacion_id == $documentacion->id ? 'selected' : '' }}>
                                        {{ $documentacion->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="documentacion">Fecha Documentación <span class="text-danger">*</span></label>
                            <input type="date" name="documentacion" id="documentacion"
                                class="form-control @error('documentacion') is-invalid @enderror"
                                value="{{ $embarque->documentacion }}">
                            @error('documentacion')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="mb-4 ">
                            <label for="file_id"
                                class="block text-dark text-sm font-weight-bold  mb-4 ml-2">Documentación <span class="text-danger">*</span></label>
                            <input type="file" id="files" data-tipo="editar" class="p-3 rounded form-input "
                                name="files[]" multiple />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="input-proforma"></div>

                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label for="observaciones_pedimento">Observaciones Pedimento</label>
                            <textarea name="observaciones_pedimento" id="observaciones_pedimento"
                                class="form-control observaciones_pedimento @error('observaciones_pedimento') is-invalid @enderror">{{ old('observaciones_pedimento') }}{{ $embarque->observaciones_pedimento }}</textarea>
                            @error('observaciones_pedimento')
                                <br>
                                <small>{{ $message }}</small>
                                <br>
                            @enderror


                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="arribo"></label>Arribo <span class="text-danger">*</span>
                            <input class="form-control mt-1 @error('arribo') is-invalid @enderror" type="date"
                                name="arribo" id="arribo" value="{{ $embarque->arribo }}">
                            @error('arribo')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label  for="revalidación">Revalidación</label>
                            <input class="form-control mt-1 @error('revalidación') is-invalid @enderror" type="date"
                                id="revalidación" name="revalidación" value="{{ $embarque->revalidación }}">
                            @error('revalidación')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>

                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="previo">Previo</label>
                            <input class="form-control @error('previo') is-invalid @enderror" type="date"
                                id="previo" name="previo" value="{{ $embarque->previo }}">
                            @error('previo')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="pedimento">Pedimento</label>
                            <input class="form-control @error('pedimento') is-invalid @enderror" type="date"
                                id="pedimento" name="pedimento" value="{{ $embarque->pedimento }}">
                            @error('pedimento')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="despacho">Despacho</label>
                            <input class="form-control @error('despacho') is-invalid @enderror" type="date"
                                id="despacho" name="despacho" value="{{ $embarque->despacho }}">
                            @error('despacho')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="despacho_id">Estatus Despacho</label>
                            <select class="form-control text-uppercase @error('despacho_id') is-invalid @enderror"
                                type="date" id="despacho_id" name="despacho_id">
                                <option value="">-- Seleccione --</option>

                                @foreach ($elementosDespachos as $estatus)
                                    <option value="{{ $estatus->id }}"
                                        {{ $embarque->despacho_id == $estatus->id ? 'selected' : '' }}>
                                        {{ $estatus->nombre }}
                                    </option>
                                @endforeach

                            </select>
                            @error('despacho_id')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="pago_anticipo">Anticipo</label>
                            <input class="form-control @error('pago_anticipo') is-invalid @enderror" type="date"
                                name="pago_anticipo" id="pago_anticipo" value="{{ $embarque->pago_anticipo }}">
                            @error('pago_anticipo')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-4">
                            <label for="file_ctagastos_id"
                                class="block text-dark text-sm font-weight-bold  mb-4 ml-2">Cuenta de
                                Gastos</label>
                            <input type="file" id="file_ctagastos_id" class="p-3 rounded form-input "
                                name="file_ctagastos[]" multiple />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cuenta_gastos">Cuenta de gastos</label>
                            <input class="form-control @error('cuenta_gastos') is-invalid @enderror" type="date"
                                name="cuenta_gastos" id="cuenta_gastos" value="{{ $embarque->cuenta_gastos }}">
                            @error('cuenta_gastos')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                </div>

                <fieldset>
                    <div class="form-group">
                        <label for="imagenes">Imagenes</label>
                        <div id="dropzone" class="dropzone bg-info">
                        </div>
                    </div>
                </fieldset>
                @if (count($imagenes) > 0)
                    @foreach ($imagenes as $imagen)
                        <input class="galeria" type="hidden" value="{{ $imagen->ruta_imagen }}">
                        <input type="hidden" id="uuid" name="uuid" value="{{ $imagen->id_embarque }}">
                    @endforeach
                @endif

                <div class="form-group">
                    <label for="observaciones">Observaciones</label>
                    <textarea name="observaciones" id="observaciones"
                        class="form-control observaciones @error('observaciones') is-invalid @enderror">{{ old('observaciones') }}{{ $embarque->observaciones }}</textarea>
                    @error('observaciones')
                        <br>
                        <small>{{ $message }}</small>
                        <br>
                    @enderror

                    <input type="hidden" id="file_id" name="file_id" value="{{ $embarque->file_id }}">
                    <input type="hidden" id="uuid_cta_gastos" name="uuid_cta_gastos"
                        value="{{ $embarque->uuid_cta_gastos }}">
                </div>


                <input type="hidden" id="uuid" name="uuid" value="{{ $embarque->uuid }}">
                <input type="hidden" id="uuid_kpi" name="uuid_kpi" value="{{ $embarque->uuid_kpi }}">


                <div class="form-group d-flex justify-content-center">
                    <input type="submit" class="btn btn-primary mx-auto mt-4" value="Actualizar Embarque"
                        id="agregar-embarque">
                </div>
        </div>

        <div class="spinner-section fixed-top">
            <div class="orbit-spinner mx-auto">
                <div class="orbit"></div>
                <div class="orbit"></div>
                <div class="orbit"></div>
            </div>

        </div>

        </form>

    </div>
    </div>
@endsection
