@if (Auth::user()->rol_id == 1)

<div style="margin-top: 4.1rem" id="sidemenu" data-aos="fade-down" data-aos-duration="1000" class="menu-collapsed">
    <div id="header">
        <div id="title">
            <span>{{Auth::user()->name}}</span>
        </div>
        <div id="menu-btn">
            <div class="btn-hamburguer"></div>
            <div class="btn-hamburguer"></div>
            <div class="btn-hamburguer"></div>
        </div>
    </div>

    <div id="menu-items">
        <div class="item">
            <div class="title"> <span> <a href="{{route('asistencia.index')}}" class="font-weigth-bold entradas">Entradas <img src="{{'/icons/icon-enter.png'}}" alt=""></a> </span></div>
        </a>
    </div>
        <div class="item">
                <div class="title"> <span> <a href="{{route('comida.index')}}" class="font-weigth-bold comidas">Comidas <img src="{{'/icons/lunch-icon-panel.png'}}" alt=""></a></span></div>
            </a>
        </div>
        <div class="item-separator">

        </div>

    </div>

</div>
@endif

