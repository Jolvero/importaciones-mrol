@extends('layouts.app')

@section('content')
    <h1 class="font-weight-bold ml-5 ml-md-0">Editar Cliente</h1>

    <form action="{{ route('cliente.update', ['cliente' => $cliente->id]) }}" method="POST">
        @method('PUT')
        @csrf

        <div class="form-group mt-4">
            <label for="cliente">Cliente</label>
            <input type="text" name="cliente" id="cliente" class="form-control @error('cliente') is-invalid @enderror"
                value="{{ $cliente->cliente }}">

            @error('nombre')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        @if ($cliente->rfc)
            <div class="form-group">
                <label for="rfc">Rfc</label>
                <input type="text" name="rfc" id="rfc" class="form-control" value="{{ $cliente->rfc }}">
            </div>
        @else
        <div class="form-group">
            <label for="rfc">Rfc</label>
            <input type="text" name="rfc" id="rfc" class="form-control" value="{{ old('rfc') }}">

        </div>
        @endforelse

        @if ($cliente->direccion)
            <div class="form-group">
                <label for="direccion">Direccion</label>
                <input type="text" name="direccion" id="direccion" class="form-control"
                    value="{{ $cliente->direccion }}">
            </div>
        @else
        <div class="form-group">
            <label for="direccion">Dirección<nav></nav></label>
            <input type="text" name="direccion" id="direccion" class="form-control" value="{{ old('direccion') }}">

        </div>
        @endforelse

        <button type="submit" class="btn btn-success">Editar Cliente</button>
    </form>
@endsection
