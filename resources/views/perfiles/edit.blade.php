@extends('layouts.app')


@section('botones')

<a href="{{route('embarques.index')}}"
class="btn btn-outline-primary mr-2 text-uppercase font-weight-bold mt-5" >
<svg class="w-6 h-6 icono" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z" clip-rule="evenodd"></path></svg>
Volver</a>
@endsection


@section('content')
<h1 class="text-center mb-5">Editar mi Perfil</h1>

<div class="row justify-content-center">
    <div class="col-md-10 bg-white p-3">
        <form action="{{route('perfiles.update',['perfil' => $perfil->id])}}" method="POST"
            enctype="multipart/form-data"
            >
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input class="form-control @error('nombre') is-invalid @enderror" type="text" id="nombre" name="nombre"
                value="{{$perfil->usuario->name}}" >

                @error('nombre')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{$message}}</strong>
                </span>
                @enderror

            </div>
        <div class="form-group">
            <label for="ingreso">Ingreso</label>
            <input class="form-control @error('ingreso') is-invalid @enderror" type="date" id="ingreso" name="ingreso" value="{{$perfil->ingreso}}">
            @error('ingreso')
            <span class="invalid-feedback d-block" role="alert">
                <strong>{{$message}}</strong>
            </span>
            @enderror

        </div>

        <div class="form-group">
            <label for="puesto">Puesto</label>
            <input class="form-control @error('puesto') is-invalid @enderror" type="text" id="puesto" name="puesto" value="{{$perfil->puesto}}">
            @error('puesto')
            <span class="invalid-feedback d-block" role="alert">
                <strong>{{$message}}</strong>
            </span>
            @enderror

        </div>

        <div class="form-group">
            <label for="imagen">Tu Imagen</label>

            <input type="file" id="imagen" name="imagen" class="form-control @error('imagen') is-invalid @enderror">

            @if($perfil->imagen)
            <div class="mt-4">
                <p>Imagen Actual</p>

                <img class="img-fluid" src="/storage/{{$perfil->imagen}}" style="width: 300px" alt="">
            </div>

            @error('imagen')
            <span class="invalid-feedback d-block" role="alert"> <strong>{{$message}}</strong>
            </span>
            @enderror
            @endif
        </div>

        <div class="form-group d-flex">
            <input type="submit" class="btn btn-primary mx-auto" value="Actualizar Perfil">
        </div>
    </form>
    </div>
</div>



@endsection
