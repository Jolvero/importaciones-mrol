@extends ('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css"
        integrity="sha512-ZKX+BvQihRJPA8CROKBhDNvoc2aDMOdAlcm7TUQY+35XYtrd3yh95QOOhsPDQY9QnKE0Wqag9y38OIgEvb88cA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('botones')
    <a href="{{ route('almacen.index') }}" class="btn btn-outline-primary mr-2 text-uppercase font-weight-bold mt-5">
        <svg class="w-6 h-6 icono" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z"
                clip-rule="evenodd"></path>
        </svg>
        Volver</a>
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-body">
                <h1 class="text-center my-4">{{ $almacen->modelo }}</h1>
                <a href="/storage/{{ $almacen->imagen }}" data-lightbox="imagen">
                    <img src="/storage/{{ $almacen->imagen }}" class="img-fluid" alt="">
                </a>
                <div class="container bg-catalogo my-4 py-4">
                    <h3 ><span class="font-weight-bold">Color: </span>{{ $almacen->color }}</h3>
                    <h3><span class="font-weight-bold">Cantidad por Palet: </span>{{ $almacen->cant_palet }}</h3>
                    <h3><span class="font-weight-bold">Medidas Caja Master: </span>{{ $almacen->medidas_caja_master }}</h3>
                    <h3> <span class="font-weight-bold">Medias Caja Individual:</span>
                        {{ $almacen->medidas_caja_individual }}</h3>
                </div>
            </div>
        </div>
        {{-- <div class="col-md-6">
        <div class="card card-body bg-secondary">

        </div>
    </div> --}}
    </div>
@endsection

@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css"
        integrity="sha512-ZKX+BvQihRJPA8CROKBhDNvoc2aDMOdAlcm7TUQY+35XYtrd3yh95QOOhsPDQY9QnKE0Wqag9y38OIgEvb88cA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
