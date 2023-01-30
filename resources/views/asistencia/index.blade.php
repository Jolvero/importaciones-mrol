@extends('layouts.app')

@section('scripts')
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init();
  </script>
@endsection

@section('styles')
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

@endsection

@section('content')
<div data-aos="fade-down" data-aos-duration="1000">

<h2 class="text-center text-white text-uppercase p-5">Asistencias</h2>

@if(session('asistencia'))
    <div class="alert alert-primary" role="alert">
        {{session('asistencia') }}
    </div>
    @endif

<div class="col-md-10 mx-auto bg-white p-3">
    <table class="table">
        <thead class="bg-primary text-light">
            <tr>
                <th scole="col">Usuario</th>
                <th scole="col" class="text-center">Acciones</th>
            </tr>
        </thead>

        <tbody>

            @foreach ($asistencias as $asistencia)
            <tr>
                <td>{{$asistencia->usuario}}</td>
                <td>
                    <a href="{{ route('asistencia.show', ['asistencia' => $asistencia->id])}}" class="btn btn-primary d-block mb-2">Ver</a>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- <div class="col-12 d-flex  justify-content-center">
    {{ $asistencias->links()}}
</div> --}}
</div>
@endsection
