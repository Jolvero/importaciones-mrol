@extends('layouts.app')


@section('content')
<div class="container">
    <h2 class="titulo-estado text-uppercase mt-5 mb-4">
        Estatus: {{$estadoEmbarque->nombre}}
    </h2>

    <div class="row">
        @foreach($embarques as $embarque)
        @include('ui.embarque')
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-5">
        {{$embarques->links()}}

    </div>
</div>

@endsection