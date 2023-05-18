@extends('layouts.app')
@section('botones')
    @include('ui.navegacion')
    @if (session('asistencia'))
        <div class="alert alert-primary text-center mt-5"role="alert">
            {{ session('asistencia') }}
        </div>
    @endif

    @if (session('asistenciaCorrecta'))
        <div class="alert alert-success text-center mt-5"role="alert">
            {{ session('asistenciaCorrecta') }}
        </div>
    @endif

    @if (session('checarComida'))
        <div class="alert alert-danger text-center mt-5"role="alert">
            {{ session('checarComida') }}
        </div>
    @endif

    @if (session('comidaCorrecta'))
        <div class="alert alert-success text-center mt-5"role="alert">
            {{ session('comidaCorrecta') }}
        </div>
    @endif
    </div>
@endsection

@section('styles')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/dropzone.min.css">
@endsection

@section('scripts')

    <script src="{{ asset('js/embarques.js') }}" defer></script>
    <script src="{{ asset('js/alertas.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/dropzone.min.js"
        integrity="sha512-Mn7ASMLjh+iTYruSWoq2nhoLJ/xcaCbCzFs0ZrltJn7ksDBx+e7r5TS7Ce5WH02jDr0w5CmGgklFoP9pejfCNA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        AOS.init();
    </script>
@endsection

@section('styles')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endsection
@section('content')
    @if (session('estado'))
        <div class="text-center alert alert-danger" role="alert">
            {{ session('estado') }}
        </div>
    @endif

    @if (session('success'))
        <div class="text-center alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="modal fade ml-3 ml-md-0" id="nuevaImportacion" tabindex="-1" aria-hidden="true" data-keyboard="false"
        data-backdrop="static" aria-labelledby="nuevaImportacionLabel">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header" data-aos="fade-up" data-aos-duration="1000">
                    <h5 class="modal-titile nueva-importacion">Nueva Importación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>

                <div class="modal-body">
                    <form enctype="multipart/form-data" class="text-dark form-create" id="formulario" method="POST"
                        action="{{ route('embarques.store') }}" novalidate>
                        @csrf
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
                                                {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                                                {{ $cliente->cliente }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tipo_id">Tipo de Importación <span class="text-danger">*</span></label>
                                    <select name="tipo_id" id="tipo_id"
                                        class="form-control @error('tipo_id') is-invalid @enderror">
                                        <option value="">-- Seleccione</option>
                                        @foreach ($tipos as $tipo)
                                            <option value="{{ $tipo->id }}"
                                                {{ old('tipo_id') == $tipo->id ? 'selected' : '' }}>{{ $tipo->tipo }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mes_id">Mes <span class="text-danger">*</span></label>
                                    <select name="mes_id" id="mes_id" class="form-control">
                                        @foreach ($obtenerMeses as $mes)
                                            <option
                                                value="{{ $mes->id }}"{{ old('mes_id') == $mes->id ? 'selected' : '' }}>
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
                                        placeholder="Referencia" value={{ old('referencia') }}>
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
                                                {{ old('estado_id') == $estado->id ? 'selected' : '' }}>
                                                {{ $estado->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @php
                                $fecha = date('Y-m-d');
                            @endphp
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="prealertado">Prealertado <span class="text-danger">*</span></label>
                                    <input class="form-control @error('prealertado') is-invalid @enderror" type="date"
                                        name="prealertado" id="prealertado"
                                        value="{{ old('prealertado') }}{{ $fecha }}">
                                    @error('prealertado')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="documentacion_id">Estatus de Documentación <span class="text-danger">*</span></label>
                                    <select name="documentacion_id"
                                        class="form-control @error('documentacion_id') is-invalid @enderror"
                                        id="documentacion_id">
                                        <option value="">-- Seleccione --</option>
                                        @foreach ($documentaciones as $documentacion)
                                            <option value="{{ $documentacion->id }}"
                                                {{ old('documentacion_id') == $documentacion->id ? 'selected' : '' }}>
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
                                        value="{{ old('documentacion') }}">
                                    @error('documentacion')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 mb-5">
                                <div class="mb-4 shadow">
                                    <label for="files"
                                        class="block text-dark text-sm font-weight-bold ml-2 my-3 form-control">Documentación <span class="text-danger">*</span></label>
                                    <input type="file" id="files" class="p-3 rounded form-input " name="files[]"
                                        multiple />
                                </div>
                            </div>

                            <div class="input-proforma"></div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="arribo">Arribo <span class="text-danger">*</span></label>
                                    <input class="form-control @error('arribo') is-invalid @enderror" type="date"
                                        name="arribo" id="arribo" value="{{ old('arribo') }}">
                                    @error('arribo')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="revalidación">Revalidación</label>
                                    <input class="form-control @error('revalidación') is-invalid @enderror" type="date"
                                        id="revalidación" name="revalidación" value="{{ old('revalidación') }}">
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
                                        id="previo" name="previo" value="{{ old('previo') }}">
                                    @error('previo')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pedimento">Pedimento Pagado</label>
                                    <input class="form-control @error('pedimento') is-invalid @enderror" type="date"
                                        id="pedimento" name="pedimento" value="{{ old('pedimento') }}">
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
                                        id="despacho" name="despacho" value="{{ old('despacho') }}">
                                    @error('despacho')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="anticipo">Anticipo</label>
                                    <input type="date" name="pago_anticipo" id="pago_anticipo"
                                        class="form-control @error('pago_anticipo') is-invalid @enderror"
                                        value="{{ old('pago_anticipo') }}">
                                    @error('pago_anticipo')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cuenta_gastos">Cuenta de gastos</label>
                                    <input class="form-control @error('cuenta_gastos') is-invalid @enderror"
                                        type="date" name="cuenta_gastos" id="cuenta_gastos"
                                        value="{{ old('cuenta_gastos') }}">
                                    @error('cuenta_gastos')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12 mt-5">
                                <div class="mb-4 shadow">
                                    <label for="file_ctagastos_id"
                                        class="block text-dark text-sm font-weight-bold ml-2 mb-4">Cuenta de
                                        Gastos</label>
                                    <input type="file" id="file_ctagastos_id" class="p-3 rounded form-input "
                                        name="file_ctagastos[]" multiple />
                                </div>
                            </div>

                            <div class="col-md-12">
                                <fieldset>
                                    <legend class="text-white">Previo</legend>
                                    <div class="form-group">
                                        <label for="imagenes"></label>
                                        <div id="dropzone" class="dropzone bg-info">
                                        </div>
                                    </div>
                                </fieldset>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="observaciones">Observaciones Generales</label>
                                    <textarea name="observaciones" id="observaciones"
                                        class="form-control observaciones @error('observaciones') is-invalid @enderror">{{ old('observaciones') }}
                     </textarea>
                                    @error('observaciones')
                                        <br>
                                        <small>{{ $message }}</small>
                                        <br>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <input type="hidden" id="file_id" name="file_id" value="{{ Str::uuid()->toString() }}">
                        <input type="hidden" id="uuid" name="uuid" value="{{ Str::uuid()->toString() }}">
                        <input type="hidden" id="uuid_cta_gastos" name="uuid_cta_gastos"
                            value="{{ Str::uuid()->tostring() }}">
                        <input type="hidden" id="uuid_kpi" name="uuid_kpi" value="{{ Str::uuid()->toString() }}">

                        <input type="hidden" id="url" name="url" value="{{ Route::currentRouteName()}}">


                        <div class="form-group d-flex justify-content-center" id="section-btn">
                            <input type="submit" class="btn btn-primary mx-auto mt-4" id="agregar-embarque"
                                name="agregar-embarque" value="Agregar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <h1 class="text-center font-weight-bold text-uppercase mb-5 card card-body py-2 border-0 shadow" style="border-radius: 2rem;">Importaciones</h1>
    <div class="col-md-10 mx-auto" data-aos="fade-up" data-aos-duration="1000">

        <table class="table w-100 display responsive nowrap ml-5 ml-md-0" id="table-embarques">
            <thead class="bg-primary text-light">
                <tr>
                    <th>Referencia</th>
                    <th>Cliente</th>
                    <th>Mes</th>
                    <th>Estatus</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($embarques as $embarque)
                    <tr>
                        <td>{{ $embarque->referencia }}</td>
                        <td>{{$embarque->cliente->cliente}}</td>
                        <td>{{$embarque->mes->mes}}</td>
                        <td class="font-weight-bold">{{ $embarque->estado->nombre }}</td>
                        <td>
                            <a href="{{ route('embarques.show', ['embarque' => $embarque->id]) }}"
                                class="btn d-block mb-2" style="background: #c3c3c3" id="ver"><img src="{{'/images/show.png'}}" data-toggle="tooltip" data-placement="top" title="Ver Importación" alt=""></a>

                            <a href="{{ route('embarques.edit', ['embarque' => $embarque->id]) }}" data-toggle="tooltip" data-placement="top" title="Editar Importación"
                                class="btn d-block mb-2" style="background: #c3c3c3" id="editar"><img src="{{'/images/editar.png'}}" alt=""></a>

                                <form method="POST" id="eliminar-embarque">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-dark d-block mb-2 w-100" id="{{$embarque->id}}" data-toggle="tooltip" data-placement="top" title="Eliminar Importación" onclick="eliminarEmbarque({{$embarque->id}});">  <img src="{{'/images/eliminar.png'}}" alt=""></button>
                                </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    <div class="spinner-section fixed-top">

    </div>
@endsection
