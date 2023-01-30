@extends('layouts.app')

@section('scripts')
<script src="{{asset('js/registrarUsuario.js')}}" defer></script>
@endsection
@section('botones')
<div class="panel">
    <a href="{{ route('embarques.index') }}" id="btnVolver" class="btn btn-outline-primary mr-2 text-white text-uppercase font-weight-bold ">
        <svg class="w-6 h-6 icono" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z"
                clip-rule="evenodd"></path>
        </svg>
        Volver</a>

    {{-- <a href="{{ route('palet.create') }}" class="btn btn-outline-primary mx-4 text-uppercase font-weight-bold">
        <svg class="w-6 h-6 icono" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z"
                clip-rule="evenodd"></path>
        </svg>
        Agregar Distribución</a> --}}
</div>
@endsection
@section('content')

<h1 class="text-left text-white font-weight-bold">Crear Usuario</h1>
<div class="row justify-content-start mt-5 pb-5" style="width: 70%">
    <div class="col-md-8">
         <form action="{{route('register.store')}}" id="registrar" method="POST" class="form-create text-white">
            @csrf

            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}">
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{$message}}</strong>
                </span>

                @enderror
            </div>

            <div class="form-group">
                <label for="email">Correo</label>

                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="someone@example.com">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="number">Rol</label>

                <input type="number" name="rol_id" id="rol_id" max="3" min="1" class="form-control @error('rol_id') is-invalid @enderror" value="{{old('rol_id')}}">
                @error('rol_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" autocomplete="off" name="password" id="password" class="form-control @error('password') is-invalid @enderror" >
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{$message}}</strong>
                </span>

                @enderror
            </div>

            <div class="form-group">
                <label for="password2">Repetir contraseña</label>
                <input type="password" autocomplete="off"  name="password2" id="password2" class="form-control @error('password2') is-invalid @enderror">
                @error('password2')
                <span class="invalid-feedback" role="alert">
                    <strong>{{$message}}</strong>
                </span>

                @enderror
            </div>

            @if(session('estado'))
    <div class="alert alert-primary" role="alert">
        {{session('estado') }}
    </div>
    @endif

            <div class=" form-group d-flex justify-content-center">
                <input type="submit" value="Registrar Usuario" class="btn btn-primary mx-auto mt-4">
            </div>

        </form>
    </div>
</div>

<div class="spinner-section fixed-top">
    <div class="orbit-spinner mx-auto">
        <div class="orbit"></div>
        <div class="orbit"></div>
        <div class="orbit"></div>
      </div>

</div>
@endsection
