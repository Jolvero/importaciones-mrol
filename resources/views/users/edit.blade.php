@extends('layouts.app')

@section('scripts')
<script src="{{ asset('js/registrarUsuario.js') }}" defer></script>
@endsection
@section('content')

    <form action="{{route('usuario.update', ['user' => $user->id])}}" method="POST" novalidate id="form-usuario" name="form-usuario">
        @csrf
        @method('PUT')
        <p class="text-center font-weight-bold">Todos los campos son obligatorios</p>
        <div class="row justify-content-center ml-5 ml-md-0">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{$user->name}}" name="name" id="name">

                    @error('name')
                        <span class="invalid-feedback" role="alert"><strong>{{$message}}</strong></span>
                    @enderror
                </div>
            </div>


            <div class="col-md-6">
                <div class="form-group">
                    <label for="rol_id">Rol</label>
                <select name="rol_id" id="rol_id" class="form-control @error('rol_id') is-invalid @enderror">
                    <option value="">-- Seleccione --</option>
                    @foreach ($roles as $rol)
                        <option value="{{$rol->id}}" {{$user->rol_id == $rol->id ? 'selected' : ''}}>{{$rol->rol}}</option>
                    @endforeach
                </select>

                @error('rol_id')
                <span class="invalid-feedback" role="alert"><strong>{{$message}}</strong></span>
            @enderror

                </div>
            </div>

            <div id="cliente"></div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="password">Contraseña</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">

                @error('password')
                    <span class="invalid-feedback"><strong>{{$message}}</strong></span>
                @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="password_confirmation">Confirmar</label>
                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password_confirmation">

                @error('password_confirmation')
                    <span class="invalid-feedback"><strong>{{$message}}</strong></span>
                @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3 py-2 text-white" id="btn-enviar">Actualizar</button>
        </div>


    </form>

@endsection
