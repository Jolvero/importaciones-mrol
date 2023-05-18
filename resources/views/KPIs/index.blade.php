@extends('layouts.app')

@section('scripts')
<script src="{{asset('js/kpis.js')}}" defer></script>
@endsection
@section('content')

 <h1 class="text-center font-weight-bold text-uppercase mb-5  border-0 shadow py-3 mt-3" style="border-radius: 2rem"> <img class="" src="{{ '/images/kpis.png' }}" alt=""> KPI'S</h1>
    <div class="col-md-10 mx-auto" data-aos="fade-up" data-aos-duration="1000">
<div class="form-group ml-5 ml-md-0">
    <label for="mes" class="mb-3"> <img src="{{'/images/calendario.png'}}" class="mr-2"> Mes</label>
    <select name="mes" id="mes" class="form-control selects shadow">
        <option value="">-- Seleccione --</option>

        @foreach ($meses as $mes)
            <option value="{{$mes->id}}" {{old('mes')==$mes->id ? 'selected': ''}}>{{$mes->mes}}</option>
        @endforeach
    </select>

</div>

<div class="form-group ml-5 ml-md-0">
    <label for="tipo" class="mb-3"> <img src="{{'/images/contenedor-de-reciclaje.png'}}" class="mr-2">Tipo</label>
    <select name="tipo" id="tipo" class="form-control shadow selects">
        <option value="">-- Seleccione --</option>
        @foreach ($tipos as $tipo)
            <option value="{{$tipo->id}}" {{old('tipo')==$tipo->id ? 'selected': ''}}>{{$tipo->tipo}}</option>
        @endforeach
    </select>

</div>

<div class="form-group ml-5 ml-md-0">
    <label for="tipo" class="mb-3"> <img src="{{'/images/cliente.png'}}" class="mr-2">Cliente</label>
    <select name="cliente" id="cliente" class="form-control selects shadow">
        <option value="">-- Seleccione --</option>
        @foreach ($clientes as $cliente)
            <option value="{{$cliente->id}}" {{old('cliente')==$cliente->id ? 'selected': ''}}>{{$cliente->cliente}}</option>
        @endforeach
    </select>

</div>

<section class="kpis mt-5 pt-3 ml-5 ml-md-0">
    <div class="row mensaje">
    </div>

        <div class="col-md-12 mt-5 pt-5 card card-body  border-0 shadow mb-5"style="border-radius: 2rem;">
            <figure>
                <div id="kpis"></div>
            </figure>
        </div>




</section>
@endsection
