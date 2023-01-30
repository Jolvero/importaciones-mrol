<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{asset('js/menuLateral.js')}}" defer></script>
    <script src="{{asset('js/spinner.js')}}" defer></script>
    <script src="{{asset('js/login.js')}}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts" defer></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    @yield('styles')


    <!-- Styles -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body>
    <div id="app" class="bg-index">
        <!-- Incluir panel si el usuario esta autenticado -->
       @guest

       @else
       @include('panel.panel')

       @endguest



        <nav class="navbar navbar-expand-md navbar-light bg-dark shadow-sm py-2 nav-principal">
            <div class="container index m-0 p-0">
                <div class="d-flex justify-content-start ">
                    <a class="navbar-brand text-white p-0" href="{{ url('/') }}">
                    </a>

                </div>

                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                @auth
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-5 ml-md-0 d-flex flex-md-row flex-column align-items-center" id="items-nav" >

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        <!-- Authentication Links -->
                        <a  href="{{ route('logout') }}" id="logout" style="width: 30px" data-toggle="tooltip" data-placement="top" title="Salir"
                        onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                         <img  src="{{'/images/log-out.png'}}" width="35px" alt="">
                    </a>


                    </ul>
                </div>
                @endauth

            </div>
        </nav>




        {{-- <nav class="navbar navbar-expand-md navbar-light bg-dark mt-5">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#estados" aria-controls="estados" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                    Estados
                </button>
                <div class="collapse navbar-collapse " id="estados">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav w-100 d-flex justify-content-between">
                        @foreach ($estados as $estado)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('estados.show', ['estadoEmbarque' => $estado->id ]) }}">
                               {{ $estado->nombre }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </nav> --}}
        <div class="container">
            <div class="row">
                <div class="py-5 mt-5 col-12">
                    @yield('botones')
                </div>

                <main class="py-1 mt-1 col-12">
                    @yield('content')
                </main>
            </div>

        </div>
        <div class="hero-inicio">
            @yield('hero')
        </div>
        @yield('style')
    </div>

    @yield('scripts')
    <div class="spinner-section fixed-top"></div>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
</body>

</html>
