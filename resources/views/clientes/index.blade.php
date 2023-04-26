@extends('layouts.app')

@section('scripts')
<script src="{{asset('js/clientes.js')}}" defer></script>
<script src="{{asset('js/alertas.js')}}" defer></script>
@endsection

@section('content')

@if (session('validacion'))
    <div class="alert alert-danger text-center" role="alert">
        {{session('validacion')}}
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success text-center" role="alert">
        {{session('success')}}
    </div>
@endif
<!-- modal -->

<div class="modal fade" id="nuevoCliente" tabindex="-1" aria-hidden="true" data-keyboard="false" aria-labelledby="nuevoClienteLabel" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="font-weight-bold">Nuevo Cliente</h5>
                <button type="button" data-dismiss="modal" class="close" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
            </div>

            <div class="modal-body">
                <form action="{{route('cliente.store')}}" method="POST" novalidate id="formulario-clientes">
                @csrf
                <p>Campos obligatorios  <span class="text-danger">*</span></p>
                <div class="form-group">
                    <label for="cliente">Cliente <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('cliente') is-invalid @enderror" name="cliente" id="cliente" value="{{old('cliente')}}">

                    @error('cliente')
                        <span class="invalid-feedback" role="alert"><strong>{{$message}}</strong></span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="cliente">RFC</label>
                    <input type="text" class="form-control @error('rfc') is-invalid @enderror" name="rfc" id="rfc" value="{{old('rfc')}}">

                    @error('rfc')
                        <span class="invalid-feedback" role="alert"><strong>{{$message}}</strong></span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="cliente">Dirección</label>
                    <input type="text" class="form-control @error('direccion') is-invalid @enderror" name="direccion" id="direccion" value="{{old('direccion')}}">

                    @error('direccion')
                        <span class="invalid-feedback" role="alert"><strong>{{$message}}</strong></span>
                    @enderror
                </div>

                <div class="row justify-content-center">
                <input type="submit" class="btn btn-success mt-3" value="Crear" id="crear-cliente" name="crear-cliente">
            </div>
                </form>
            </div>
        </div>
    </div>
</div>
    <div class="container ml-5 ml-md-0">
        <h2 class="font-weight-bold">Clientes</h2>

        <button type="button" data-target="#nuevoCliente" data-toggle="modal" class="float-right btn btn-nuevo-cliente text-white mb-5"><img src="{{ '/images/anadir.png' }}" width="50px" alt=""> Nuevo
            Cliente</button>

            <table class="table w-100 display responsive nowrap ml-5 ml-md-0" id="table-clientes">
                <thead class="bg-primary">
                <tr class="text-center text-white">
                    <th>#</th>
                    <th>Nombre</th>
                    <th>RFC</th>
                    <th>Dirección</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clientes as $cliente)
                    <tr class="text-center">
                        <td>{{$cliente->id}}</td>
                        <td>{{$cliente->cliente}}</td>
                        <td>{{$cliente->rfc}}</td>
                        <td>{{$cliente->direccion}}</td>
                        <td>
                            <a href="{{route('cliente.edit', ['cliente' => $cliente->id])}}" class="btn my-2 d-block " style="background: #c3c3c3;"><img src="{{'/images/editar.png'}}" alt=""></a>

                            <form method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="eliminarCliente({{$cliente->id}});" id="{{$cliente->id}}" class="btn btn-dark d-block mb-3 w-100" data-toggle="tooltip" data-placement="top" title="Eliminar Cliente"  ><img src="{{'/images/eliminar.png'}}" alt="" ></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
