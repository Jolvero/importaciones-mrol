@extends('layouts.app')

@section('scripts')
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init();
  </script>
@endsection
@section('styles')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

@endsection

@section('content')

<h1 class="mb-5">Bienvenido/a {{Auth::user()->name}}</h1>
<div class="hero"  data-aos="fade-up" data-aos-duration="1000">
    <form action="{{route('cliente.buscar')}}" class="container h-100">
        <div class="row h-100 align-items-center mt-4 justify-content-center">
           <div class="col-md-6 texto-buscar">
            <p class="display-4 mb-4">Buscar Importación</p>

            <input type="search" name="buscar" class="form-control mt-5" placeholder="Buscar Importación">
           </div>
        </div>
    </form>
</div>

<div class="importaciones-cliente">
    <div class="col-md-10 mx-auto" data-aos="fade-up" data-aos-duration="1000">
        <h2 class="text-center my-5 pt-4">Consulta tus Importaciones</h2>

        <table class="table bg-white">
            <thead class="bg-primary text-light">
                <tr>
                    <th scole="col">Referencia</th>
                    <th scole="col">Estatus</th>

                    <th scole="col" class="text-center">Acciones</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($embarquesCliente as $embarque)
                <tr>
                    <td>{{$embarque->referencia}}</td>
                    <td class="font-weight-bold">{{$embarque->estado->nombre}}</td>
                    <td>
                        <a href="{{ route('embarques.show', ['embarque' => $embarque->id])}}" class="btn btn-primary d-block mb-2" id="ver">Ver</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>


    </div>
</div>

@endsection
