@if (Auth::user()->rol_id !=3)
<div id="sidemenu" class="menu-collapsed">
    <div id="header">
        {{-- <div id="title">
            <span>{{Auth::user()->name}}</span>
        </div> --}}

        <div id="menu-btn" class="mr-5">
            <div class="btn-hamburguer"></div>
            <div class="btn-hamburguer"></div>
            <div class="btn-hamburguer"></div>
        </div>
    </div>
    <div id="menu-items" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="200">
        <ul class="list-unstyled components mb-1">
            <li class="active">
                <div class="d-flex link item-separator pb-2" id="imei" href="{{ route('kpis.index') }}" style="border-bottom: solid 2px #dcdcdc">
                    <a href="{{url('/')}}"
                        class="mt-2"><img src="{{'/images/logo-panel-removebg-preview.png'}}" class="logo-panel" width="50px" height="50px"alt="" ></a>
                </div>
                <div class="item-parent py-2">
                <a href="#submenuEmbarques" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><img
                        class="ml-2 item-img mr-3 ml-0" src="{{ '/images/contenedores.png' }}" alt=""><span
                        class="mt-5">Importaciones</span></a>
                    </div>
                <ul class="collapse list-unstyled" id="submenuEmbarques">
                    <li>
                        <a class="d-flex link link-importaciones my-2" id="embarque-index" href="{{ route('embarques.index') }}">
                            <img class="ml-2 item-img mr-3 ml-0" src="{{ '/images/crear.embarque.png' }}"
                                alt=""><span class="mt-0 consultar-embarque">Consultar o ingresar
                                Importacion</span>
                        </a>
                    </li>

                    <li>

                    </li>

                    <li class="mt-2">

                    </li>
                </ul>
            </li>

                <a class="d-flex link item-separator pb-2" id="imei" href="{{ route('kpis.index') }}">
                    <img class="ml-2 mr-3 mt-2 item-img" src="{{ '/images/kpis.png' }}" alt=""> <span
                        class="mt-2">KPI's</span>
                </a>


            <li class="mt-2">
                <div class="item-parent py-2">
                <a href="#submenuCatalogos" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> <img
                        src="{{ '/images/cuadricula.png' }}" class="ml-2 item-img mr-3 ml-0"
                        alt=""><span>Catalogos</span></a>
                    </div>
                <ul class="collapse list-unstyled" id="submenuCatalogos">
                    <li>
                        <a class="d-flex link my-2 py-2"id="clientes" href="{{ route('cliente.index') }}">
                            <img class="ml-2 mr-3 item-img" src="{{ '/images/cliente.png' }}" alt=""> <span
                                class="mt-0">Clientes</span>
                        </a>
                    </li>

                </ul>
            </li>
            {{-- <li class="mt-2">
                <a href="#submenuTransporte" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> <img
                        src="{{ '/images/camion-de-carga.png' }}" class="ml-2 item-img mr-3 ml-0"
                        alt=""><span>Transporte</span></a>
                <ul class="collapse list-unstyled" id="submenuTransporte">
                    <li>

                    </li>
                    <li>

                    </li>

                </ul>
            </li> --}}

            {{-- <li class="mt-2">
                <a href="#submenuProveedores" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><img src="" class="ml-1 item-img mr-3 ml-0" alt=""> <span>Proveedores</span></a>

                <ul class="collapse list-unstyled" id="submenuProveedores">
                    <li>

                    </li>
                    <li>

                    </li>
                </ul>
            </li> --}}
        </ul>

        {{-- <div class="item-separator mt-1 pb-2 d-flex">
            <a class="d-flex" id="imei" href="{{route('distribucion.crear')}}">
            <img class="ml-2 mr-3 item-img" src="{{'/images/distribucion.png'}}" alt=""> <span class="mt-2">Solicitar Distribución</span>
        </a>
        </div> --}}

            <a class="d-flex link item-separator pb-2 " id="imei" href="{{ route('usuarios.index') }}">
                <img class="ml-2 mr-3 mt-2 item-img" src="{{ '/images/usuario.png' }}" alt=""> <span
                    class="mt-2">Usuarios</span>
            </a>

    </div>

</div>
@endif



{{-- @endif --}}
