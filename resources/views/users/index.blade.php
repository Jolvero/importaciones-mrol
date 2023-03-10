@extends('layouts.app')

@section('scripts')
<script src="{{asset('js/registrarUsuario.js')}}" defer></script>

@endsection
@section('content')
@if (session('mensaje'))
    <div class="alert alert-success" role="alert">
        {{session('mensaje')}}
    </div>
@endif
    <h1 class="font-weight-bold ml-5 ml-md-0">Usuarios</h1>

    <div class="row justify-content-end mt-4">
        <button class="btn btn-nuevo-usuario" data-toggle="modal" data-target="#nuevousuario"><img
                src="{{ '/images/anadir.png' }}"width="50px" alt=""> Nuevo Usuario</button>

        <!-- Modal -->

        <div class="modal fade" id="nuevousuario" tabindex="-1" data-keyboard="false" aria-hidden="true" aria-labelledby="nuevousuarioLabel"
            data-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 >Agregar Usuario</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="close"><span
                                aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form action="{{route('usuario.store')}}" method="POST" novalidate id="form-usuario" name="form-usuario">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombre">Nombre</label>
                                        <input type="text" class="form-control @error('nombre') is-invalid @enderror" value="{{old('nombre')}}" name="nombre" id="nombre">

                                        @error('nombre')
                                            <span class="invalid-feedback" role="alert"><strong>{{$message}}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control @error('username') is-invalid @enderror" value="{{old('username')}}" name="username" id="username">

                                        @error('username')
                                            <span class="invalid-feedback" role="alert"><strong>{{$message}}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Correo</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email">

                                    @error('email')
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
                                            <option value="{{$rol->id}}" {{old('rol_id') == $rol->id ? 'selected' : ''}}>{{$rol->rol}}</option>
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
                                        <label for="password">Contrase??a</label>
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
                            </div>




                            <button type="submit" class="btn btn-success mt-2 text-white" id="btn-enviar">Enviar</button>

                            <button type="button" class="btn btn-dark mt-2 mx-2" data-dismiss="modal">Cancelar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <table class="table">
            <tr class="text-center">
                <th>#</th>
                <th>Nombre</th>
                <th>Usuario</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>

            <tbody>
                @foreach ($usuarios as $usuario)
                    <tr class="text-center">
                        <td>{{ $usuario->id }}</td>
                        <td>{{ $usuario->name }}</td>
                        <td>{{ $usuario->username }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>{{ $usuario->rol->rol }}</td>
                        <td>
                            <eliminar-usuario usuario-id={{$usuario->id}}></eliminar-usuario>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
