@extends('layouts.app')

@section('botones')
    <div class="panel">
        <a href="{{ route('palet.index') }}" class="btn btn-outline-primary mr-2 text-uppercase font-weight-bold ">
            <svg class="w-6 h-6 icono" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z"
                    clip-rule="evenodd"></path>
            </svg>
            Volver</a>

        <a href="{{ route('palet.create') }}" class="btn btn-outline-primary mx-4 text-uppercase font-weight-bold">
            <svg class="w-6 h-6 icono" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z"
                    clip-rule="evenodd"></path>
            </svg>
            Agregar Distribución</a>
    </div>
@endsection
@section('content')

@if (count($palets) > 0)
<div class="row ">
    @foreach ($palets as $palet)
        <div class="col-md-4">
            <div class=" align-items-center  mx-auto p-0 ">
                <div class="card card-body">
                    <p class="text-center font-weight-bold">{{ $palet->factura }}</p>
                    <p class="text-center">  Unidades: {{ $palet->total }}</p>
                    <p class="text-center">Cantidad por Palet: {{ $palet->modelo->cant_palet }}</p>

                    @php
                    $total = $palet->total;
                    $cantidadModelo = $palet->modelo->cant_palet;
                    $operacion = $total / 10;
                    if(is_float($operacion))
                    {
                        $operacion = ceil($operacion);
                        $operacion = number_format($operacion);
                        $operacion = intval($operacion);
                    }
                    $operacionPalet = $operacion;
                    $operacion = $operacion / $cantidadModelo;
                    $paletsTotales = $operacion;
                    if (is_float($paletsTotales)) {
                        $paletsTotales = ceil($paletsTotales);
                    }
                    if (is_float($operacion)) {
                        $operacion = floor($operacion);
                        $operacion = number_format($operacion);
                        $operacion = intval($operacion);
                    }
                    $restantes = $operacion * $cantidadModelo;
                    $paletIncompleto = $operacionPalet - $restantes;
                @endphp
                    <p class="text-center">Total Palets: {{ $paletsTotales }}</p>
                    <p class="text-center">Palets Completos: {{ $operacion }}</p>
                    <p class="text-center">Restantes en último Palet: {{ $paletIncompleto }}</p>
                    <div class=" mx-auto">
                        <img src="/storage/{{ $palet->modelo->imagen }}" class="img-fluid" style="width: 200px"
                            alt="">
                    </div>
                    <p class="text-center font-weight-bold mt-4"> {{$palet->cliente->nombre}}</p>
                    <p class="text-center font-weight-bold"> {{$palet->modelo->modelo}}</p>
                </div>
                <a href="{{ route('palet.edit', ['palet' => $palet->id]) }}"
                    class="btn btn-dark d-block mb-2">Editar</a>
                {{-- <eliminar-palet almacen-id ={{$palet->id}}></eliminar-palet> --}}
            </div>
        </div>
    @endforeach
</div>
@endif

@endsection
