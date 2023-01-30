@extends('layouts.app')

@section('botones')
<a href="{{route('inicio.index')}}"
class="btn btn-outline-primary mr-2 text-uppercase font-weight-bold mt-5" >
<svg class="w-6 h-6 icono" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z" clip-rule="evenodd"></path></svg>
Volver</a>
@endsection

@section('content')

    @if(count($embarques) > 0)
    <h2 class="titulo-estado text-uppercase mt-5 mb-4">
        Resultados Busqueda: {{$busqueda}}
    </h2>
    @endif

    <div class="row">
        @foreach($embarques as $embarque)
        @include('ui.embarque')
        @endforeach
    </div>

    <div class="container">
        @if(count($embarques) ==0 )

        <div class="container d-flex flex-column align-items-center">
            <h2 class="text-center">No se encontraron resultados para tu busqueda</h2>
            <img src="/storage/sin-resultados/container-186-781049.webp" class="img-fluid mx-auto mt-5" alt="">
        </div>
        </div>
        @endif

</div>

@endsection
