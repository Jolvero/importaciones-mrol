@extends('layouts.app')

@section('botones')
<a href="{{route('almacen.index')}}"
class="btn btn-outline-primary mr-2 text-uppercase font-weight-bold mt-5" >
<svg class="w-6 h-6 icono" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z" clip-rule="evenodd"></path></svg>
Volver</a>
@endsection

@section('content')

@if(count($almacenes) > 0)
<div class="row">
@foreach ($almacenes as $almacen)
<div class="col-md-4">
    <div class=" align-items-center  mx-auto p-0">
    <div class="card card-body">
        <div class="col-md-7 mt-5 mt-md-0 mx-auto">
            @if($almacen->imagen)
            <img src="/storage/{{$almacen->imagen}}" class="img-fluid my-3" alt="">
            @endif
        </div>
        <h2 class="text-center font-weight-bold">{{ $almacen->cliente->nombre }}</h2>
        <p class="text-center">{{ $almacen->modelo }}</p>
    </div>
    <a href="{{ route('almacen.show', ['almacen' => $almacen->id]) }}"
        class="btn btn-primary d-block mb-2">Ver</a>
    <a href="{{ route('almacen.edit', ['almacen' => $almacen->id]) }}"
        class="btn btn-dark d-block mb-2">Editar</a>
    </div>
</div>
@endforeach
</div>
@endif

@if (count($almacenes) == 0)
<div class="row justify-content-center">
    <h3>No se encontraron resultados para tu busqueda</h3>
</div>

@endif
@endsection
