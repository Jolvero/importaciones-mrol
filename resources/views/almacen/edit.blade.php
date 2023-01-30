@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/dropzone.min.css" integrity="sha512-0ns35ZLjozd6e3fJtuze7XJCQXMWmb4kPRbb+H/hacbqu6XfIX0ZRGt6SrmNmv5btrBpbzfdISSd8BAsXJ4t1Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('botones')

<a href="{{route('almacen.index')}}"
class="btn btn-outline-primary mr-2 text-uppercase font-weight-bold mt-5" >
<svg class="w-6 h-6 icono" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z" clip-rule="evenodd"></path></svg>
Volver</a>
@endsection

@section('content')

<h2 class="text-center font-weight-bold">Editar Modelo</h2>

@if (session('estado'))
<div class="alert alert-primary" role="alert">
    {{session('estado') }}
</div>
@endif

<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <form action="{{route('almacen.update', ['almacen' => $almacen->id])}}" novalidate method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="cliente_id">Cliente</label>
                <select name="cliente_id" id="cliente_id" class="form-control @error('cliente_id') is-invalid @enderror">
                    <option value="">-- Seleccione --</option>
                    @foreach ($clientes as $cliente)
                        <option value="{{ $cliente->id }}" {{$almacen->cliente_id == $cliente->id ? 'selected' : ''}}>{{ $cliente->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-grup">
                <label for="modelo">Modelo</label>
                <input type="text" name="modelo" class="form-control @error('modelo') is-invalid @enderror"
                    value="{{ $almacen->modelo }}">
                @error('modelo')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mt-3">
                <label for="color">Color</label>
                <input type="text" name="color" id="color" class="form-control @error('color') is-invalid @enderror"
                    value="{{$almacen->color}}">
                @error('color')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-grup mt-3">
                <label for="palet">Cantidad en Palet</label>
                <input type="number" name="cant_palet" min="1" placeholder="1"
                    class="form-control @error('cant_palet') is-invalid @enderror" value="{{$almacen->cant_palet}}">
                @error('cant_palet')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-grup mt-3">
                <label for="caja_individual">Medidas Caja Individual</label>
                <input type="text" name="medidas_caja_individual"
                    class="form-control @error('caja_individual') is-invalid @enderror"
                    value="{{$almacen->medidas_caja_individual}}">
                @error('medidas_caja_individual')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-grup mt-3">
                <label for="caja_master">Medidas Caja Master</label>
                <input type="text" name="medidas_caja_master"
                    class="form-control @error('medidas_caja_master') is-invalid @enderror"
                    value="{{$almacen->medidas_caja_master}}">
                @error('medidas_caja_master')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mt-3">
                <label for="imagen">Tu Imagen</label>

                <input type="file" id="imagen" name="imagen" class="form-control @error('imagen') is-invalid @enderror">
                @if ($almacen->imagen)
                <div class="mt-4">
                    <p>Imagen Actual</p>
                    <img src="/storage/{{$almacen->imagen}}" class="img-fluid" style="width: 170px" alt="">
                </div>

                @endif
            </div>

            @error('imagen')
                <span class="invalid-feedback d-block" role="alert"> <strong>{{ $message }}</strong>
                </span>
            @enderror

            <div class="form-group d-flex justify-content-center">
                <input type="submit" name="" id="" class="btn btn-primary mx-auto mt-5" value="Actualizar Modelo">
            </div>
        </form>
    </div>
</div>
@endsection

