@extends ('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css"
        integrity="sha512-ZKX+BvQihRJPA8CROKBhDNvoc2aDMOdAlcm7TUQY+35XYtrd3yh95QOOhsPDQY9QnKE0Wqag9y38OIgEvb88cA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
@endsection
@section('scripts')
    <script src="{{ asset('js/show.js') }}" defer></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
@endsection

@section('botones')
    <div data-aos="fade-right" data-aos-duration="1000">
        <a href="{{ route('inicio.index') }}"
            class="btn btn-outline-primary mr-2 ml-5 ml-md-0 text-uppercase font-weight-bold mt-5">
            <svg class="w-6 h-6 icono" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z"
                    clip-rule="evenodd"></path>
            </svg>
            Volver</a>
    </div>
@endsection
@section('content')
    <!-- Modal detalle despacho -->

    <div class="modal fade" tabindex="-1" data-keyboard="false" aria-hidden="true" id="detalle_despacho"
        aria-labelledby="detalle_despachoLabel" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Detalles de despacho</h2>
                    <button class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>

                <div class="modal-body">
                    <h2 class="font-weight-bold">Proceso del despacho</h2>

                    <section class="timeline">
                        <ul class="mr-5">
                            <li>
                                @foreach ($despachos as $estatus)
                                    @if ($estatus->id <= $embarque->despacho_id)
                                        <div>
                                            <time>{{ $estatus->nombre }}</time>

                                        </div>
                                    @else
                                    @break

                                @endforelse
                            @endforeach

                        </li>
                </section>

            </div>
        </div>
    </div>
</div>
<!-- cierre modal -->


<article class="contenido-embarque bg-white p-md-5 p-1 shadow border ml-5 ml-md-0">
    <div class="embarque-meta" data-aos="fade-up" data-aos-durarion="1000">
        <div class="informacion ">
            <div class="embarque-referencia">
                <h1 class=" card card-header h-auto bg-white text-center font-weight-bold mb-5">
                    {{ $embarque->referencia }}</h1>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class=" text-white mb-5 py-3 px-4 background">

                        <h3><span class="font-weight-bold">Estatus: </span>{{ $embarque->estado->nombre }}</h3>


                        <div class="mt-4 ">
                            <h3><span class="font-weight-bold">Documentación: </span>
                                {{ $embarque->estadoDocumentacion->nombre }}</h3>
                        </div>

                        @if ($embarque->observaciones)
                            <h2 class="font-weight-bold">Observaciones: <span
                                    class="font-weight-normal">{{ $embarque->observaciones }}</span></h2>
                            <h2>{{ $embarque->updated_at }}</h2>
                        @endif

                    </div>
                </div>
                <div class="col-md-7">
                    <section class="intro">
                        <div class="container">
                            <h1 class="text-center">Tracking</h1>
                        </div>
                    </section>
                    <section class="timeline">
                        @if ($embarque->prealertado)
                            <ul>
                                <li>
                                    <div>
                                        <time>Prealertado</time>
                                        <h3 class=""><span class="font-weight-bold"></span></h3>
                                        @php
                                            $fecha = $embarque->prealertado;
                                        @endphp

                                        <fecha-embarque fecha="{{ $fecha }}"></fecha-embarque>
                                    </div>
                                </li>
                        @endif
                        @if ($embarque->arribo)
                            <li>
                                <div>
                                    <time>Arribo</time>
                                    <h3 class=""><span class="font-weight-bold"></span></h3>
                                    @php
                                        $fecha = $embarque->arribo;
                                    @endphp

                                    <fecha-embarque fecha="{{ $fecha }}"></fecha-embarque>
                                </div>
                            </li>
                        @endif

                        @if ($embarque->revalidación)
                            <li>
                                <div>
                                    <time>Revalidación</time>
                                    <h3 class=""><span class="font-weight-bold"></span></h3>
                                    @php
                                        $fecha = $embarque->revalidación;
                                    @endphp

                                    <fecha-embarque fecha="{{ $fecha }}"></fecha-embarque>
                                </div>
                            </li>
                        @endif

                        @if ($embarque->previo)
                            <li>
                                <div>
                                    <time>Previo</time>
                                    <h3 class=""><span class="font-weight-bold"></span></h3>
                                    @php
                                        $fecha = $embarque->previo;
                                    @endphp

                                    <fecha-embarque fecha="{{ $fecha }}"></fecha-embarque>
                                </div>
                            </li>
                        @endif

                        @if ($embarque->pedimento)
                            <li>
                                <div>
                                    <time>Pedimento</time>
                                    <h3 class=""><span class="font-weight-bold"></span></h3>
                                    @php
                                        $fecha = $embarque->pedimento;
                                    @endphp

                                    <fecha-embarque fecha="{{ $fecha }}"></fecha-embarque>
                                </div>
                            </li>
                        @endif

                        @if ($embarque->despacho)
                            <li>
                                <div>
                                    <time>Despacho</time>
                                    <h3 class=""><span class="font-weight-bold"></span></h3>
                                    @php
                                        $fecha = $embarque->despacho;
                                    @endphp

                                    <fecha-embarque fecha="{{ $fecha }}"></fecha-embarque>
                                    <button class="btn btn-primary" type="button" data-target="#detalle_despacho"
                                        data-toggle="modal">Ver Detalles</button>
                                </div>
                            </li>
                        @endif

                        @if ($embarque->pago_anticipo)
                            <li>
                                <div>
                                    <time>pago anticipo</time>
                                    <h3 class=""><span class="font-weight-bold"></span></h3>
                                    @php
                                        $fecha = $embarque->pago_anticipo;
                                    @endphp

                                    <fecha-embarque fecha="{{ $fecha }}">

                                    </fecha-embarque>
                        @endif

                        @if ($embarque->cuenta_gastos)
                            <li>
                                <div>
                                    <time>Cuenta de Gastos</time>
                                    <h3 class=""><span class="font-weight-bold"></span></h3>
                                    @php
                                        $fecha = $embarque->cuenta_gastos;
                                    @endphp

                                    <fecha-embarque fecha="{{ $fecha }}"></fecha-embarque>
                                </div>
                            </li>
                        @endif



                        </ul>
                    </section>

                </div>
            </div>

            <div class="row" data-aos="fade-up" data-aos-delay="100">
                <div class="col-lg-3">
                    <ul class="nav nav-tabs flex-column">
                        @if (count($files) > 0)
                            <li class="nav-item">
                                <a class="nav-link active show bg-primary text-white" data-toggle="tab" href="#tab-1">
                                    <img src="{{ '/images/documentacion.png' }}" alt="" width="50px" class="mr-2">
                                    Documentación</a>
                            </li>
                        @endif

                        @if (count($proforma) > 0)
                            <li class="nav-item">
                                <a class="nav-link bg-primary text-white mt-2" data-toggle="tab"
                                    href="#tab-4"><img
                                    src="{{ '/images/pedimento.png' }}" alt="" width="45px"
                                    class="mr-2"> Proforma </a>
                            </li>
                        @endif

                        @if (count($imagenes) > 0)
                            <li class="nav-item">
                                <a class="nav-link bg-primary text-white mt-2" data-toggle="tab" href="#tab-2"><img
                                        src="{{ '/images/previo.png' }}" alt="" width="50px"
                                        class="mr-2">Evidencias Previo</a>
                            </li>
                        @endif

                        @if (count($cuentas) > 0)
                            <li class="nav-item">
                                <a class="nav-link bg-primary text-white mt-2" data-toggle="tab"
                                    href="#tab-3"> <img src="{{'/images/cuenta-gastos.png'}}" width="40px" alt="" class="mr-2">Cuenta
                                    de Gastos</a>
                            </li>
                        @endif


                    </ul>
                </div>
                <div class="info  col-lg-9 mt-4 mt-lg-0">
                    <div class="tab-content">

                        <div class="tab-pane active" id="tab-1">
                            <div class="row">
                                <div class="col-lg-8 details order-2 order-lg-1">

                                    <div class="col-lg-12 order-2 order-lg-1">
                                        <h2 class="text-center text-primary">Documentación</h2>

                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Nombre </th>
                                                            <th scope="col">Ver</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        @foreach ($files as $file)
                                                            <tr>
                                                                <td scope="row">{{ $file->name }}</td>
                                                                <td>
                                                                    <a href="{{ route('files.show', $file->name) }}"
                                                                        target="blank"
                                                                        class="btn btn-sm btn-outline-primary">Ver
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    </div>


                                </div>

                            </div>
                        </div>

                        <div class="tab-pane" id="tab-2">
                            <div class="row">
                                <div class="col-lg-8 details order-2 order-lg-1">
                                    <h2 class=" text-center text-primary mb-4">Evidencias Previo</h2>
                                    <a href="{{ route('previo.descargar', ['embarque' => $embarque->id]) }}"
                                        class="float-right font-weight-bold btn btn-primary ml-5"><img
                                            src="{{ '/images/descargar_previo.png' }}" class="mr-3" alt=""
                                            width="50px">Descargar Imágenes </a>
                                    <div class="row ">
                                        @foreach ($imagenes as $imagen)
                                            <div class="col-md-6 ">
                                                <div class="mx-auto">
                                                    @if ($directorioPrevio == true)
                                                    <a href="/storage/embarques/{{$embarque->referencia}}_previo/{{$imagen->ruta_imagen}}"
                                                        data-lightbox="imagen">
                                                        <img class="w-100 my-4" style="border: 1px solid;"
                                                        src="/storage/embarques/{{$embarque->referencia}}_previo/{{$imagen->ruta_imagen}}"
                                                        alt="">
                                                    </a>
                                                        @else
                                                        <a href="/storage/{{$imagen->ruta_imagen}}"data-lightbox="imagen">

                                                            <img class="w-100 my-4" style="border: 1px solid;"
                                                                src="/storage/{{ $imagen->ruta_imagen }}"
                                                                alt="">
                                                            </a>

                                                        @endforelse
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>
                            </div>
                        </div>

                        @if (count($cuentas) > 0)
                            <div class="tab-pane" id="tab-3">
                                <div class="row">
                                    <div class="col-lg-8 details order-2 order-lg-1">
                                        <h2 class="text-center text-primary">Cuenta de Gastos</h2>

                                        <div>
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Nombre </th>
                                                            <th scope="col">Ver</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        @foreach ($cuentas as $cuenta)
                                                            <tr>
                                                                <td scope="row">{{ $cuenta->name }}</td>
                                                                <td>
                                                                    <a target="blank"
                                                                        href="{{ route('cuentas.show', $cuenta->name) }}"
                                                                        class="btn btn-sm btn-outline-primary">Ver
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-4 text-center order-1 order-lg-2">
                                        <img src="assets/img/service-3.jpg" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="tab-pane" id="tab-4">
                            <div class="row">
                                <div class="col-lg-8 details order-2 order-lg-1">
                                    <h2 class="text-center text-primary">Proforma</h2>

                                    <div>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Nombre </th>
                                                        <th scope="col">Ver</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    @foreach ($proforma as $proforma)
                                                        <tr>
                                                            <td scope="row">{{ $proforma->name }}</td>
                                                            <td>
                                                                <a target="blank"
                                                                    href="{{ route('proforma.show', $proforma->name) }}"
                                                                    class="btn btn-sm btn-outline-primary">Ver
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            @if ($embarque->observaciones_pedimento)
                                                <h2 class="font-weight-bold">Observaciones</h2>
                                                <p>{{ $embarque->observaciones_pedimento }}</p>
                                            @endif


                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="collapse" id="cuentaGastos">
                    <div>
                        <div class=" w-100 my-5">

                        </div>
                    </div>
                </div>


            </div>
</article>
@endsection

@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css"
    integrity="sha512-ZKX+BvQihRJPA8CROKBhDNvoc2aDMOdAlcm7TUQY+35XYtrd3yh95QOOhsPDQY9QnKE0Wqag9y38OIgEvb88cA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
