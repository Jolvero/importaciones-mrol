@extends ('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css"
        integrity="sha512-ZKX+BvQihRJPA8CROKBhDNvoc2aDMOdAlcm7TUQY+35XYtrd3yh95QOOhsPDQY9QnKE0Wqag9y38OIgEvb88cA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


@section('botones')
    <a href="{{ route('asistencia.index') }}" class="btn btn-outline-primary mr-2 text-uppercase text-white font-weight-bold mt-5">
        <svg class="w-6 h-6 icono" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z"
                clip-rule="evenodd"></path>
        </svg>
        Volver</a>
@endsection
@section('content')


    <article class="contenido-embarque bg-white p-md-5 p-1 shadow border">
        <div class="embarque-meta">
            <div class="informacion ">
                <div class="embarque-referencia ">


                    <h1 class=" card card-header h-auto bg-white text-center font-weight-bold mb-5">
                        {{ $asistencia->usuario }}</h1>
                </div>
                <div class=" text-white mb-5 p-4 background">
                    @foreach ($asistencias as $asistencia)
                        <div class="container-xxl">
                            @if ($asistencia->fecha)
                                <div class="mt-4 ">
                                    <h3 class="mt-3"><span class="font-weight-bold">Fecha: </span>
                                        @php
                                            $fecha = $asistencia->fecha;
                                        @endphp

                                        <fecha-asistencia fecha="{{ $fecha }}">
                                        </fecha-asistencia>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>



                <div>
                    <div>
                        <div class=" w-100">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="bg-primary text-white" scope="col">Usuario </th>
                                                <th class="bg-primary text-white" scope="col">Fecha </th>
                                            </tr>

                                        </thead>

                                        <tbody>
                                            @foreach ($todasAsistencias as $asistencia)
                                                <tr>
                                                    <td scope="row">{{ $asistencia->usuario }}</td>
                                                    <td scope="row">
                                                        @php
                                                            $fecha = $asistencia->fecha;
                                                        @endphp

                                                        <fecha-asistencia class="" fecha="{{ $fecha }}">
                                                        </fecha-asistencia>
                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-12 d-flex  justify-content-center">
                        {{ $todasAsistencias->links()}}
                    </div>
                </div>
    </article>
@endsection
