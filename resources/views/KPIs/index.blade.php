@extends('layouts.app')

@section('scripts')
<script src="{{asset('js/kpis.js')}}" defer></script>
@endsection
@section('content')

<h2 class="font-weight-bold ml-5 ml-md-0">KPI's</h2>

<div class="form-group ml-5 ml-md-0">
    <label for="mes">Mes</label>
    <select name="mes" id="mes" class="form-control">
        <option value="">-- Seleccione --</option>

        @foreach ($meses as $mes)
            <option value="{{$mes->id}}" {{old('mes')==$mes->id ? 'selected': ''}}>{{$mes->mes}}</option>
        @endforeach
    </select>

</div>

<div class="form-group ml-5 ml-md-0">
    <label for="tipo">Tipo</label>
    <select name="tipo" id="tipo" class="form-control">
        <option value="">-- Seleccione --</option>
        @foreach ($tipos as $tipo)
            <option value="{{$tipo->id}}" {{old('tipo')==$tipo->id ? 'selected': ''}}>{{$tipo->tipo}}</option>
        @endforeach
    </select>

</div>

<div class="form-group ml-5 ml-md-0">
    <label for="tipo">Cliente</label>
    <select name="cliente" id="cliente" class="form-control">
        <option value="">-- Seleccione --</option>
        @foreach ($clientes as $cliente)
            <option value="{{$cliente->id}}" {{old('cliente')==$cliente->id ? 'selected': ''}}>{{$cliente->cliente}}</option>
        @endforeach
    </select>

</div>

<section class="kpis mt-5 pt-3 ml-5 ml-md-0">
    <div class="row mensaje">
    </div>

        <div class="col-md-12 mt-5 pt-5">
            <figure>
                <div id="kpis"></div>
            </figure>
        </div>




</section>
@endsection
