<section data-aos="fade-down" data-aos-duration="1000" class="ml-5 ml-md-0">
    <h3 class="font-weight-bold mb-5 mr-5 mr-md-0 p-3 card card-body text-center border-0 shadow" style="border-radius: 2rem">Bienvenido/a {{ $nombre }}</h3>
    <div class="row ml-4 justify-content-center">
        {{-- <div class="col-md-3">
            <div class="card ml-3">
                <div class="card-body shadow">
                    <div class="d-flex">
                    <img src="{{'/images/envase.png'}}" alt="">
                    <p class="font-weight-bold ml-3">x importaciones</p>
                </div>
                </div>
            </div>
        </div> --}}

        <div class="col-md-3 mr-5 mr-md-0 mb-3 mb-md-0">
            <div class="card ml-3 border-0 shadow" style="border-radius: 2rem">
                <div class="card-body">
                    <div class="d-flex">
                        <img src="{{ '/images/contenedores.dash.png' }}" alt="">
                        <p class="font-weight-bold">{{ $embarques }} Importaciones</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mr-5 mr-md-0">
            <div class="card ml-3 border-0 shadow" style="border-radius: 2rem">
                <div class="card-body">
                    <div class="d-flex">
                        <img src="{{ '/images/cliente.dash.png' }}" alt="">
                        <p class="font-weight-bold ml-3">{{ $clientes }} Clientes</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="distribuciones mt-5 card card-body h-auto mb-5 border-0 shadow" style="border-radius: 2rem;"  data-aos="zoom-in" data-aos-duration="1300">
    <h2 class="font-weight-bold text-center mt-3">Importaciones del Mes</h2>
    <figure class="ml-5 ml-md-0  mt-4">
        <div id="containerImportaciones">

        </div>
    </figure>
</section>
<!-- Inventario -->
<section class="inventario mt-5 pt-3 card card-body h-auto mt-5 border-0 shadow" style="border-radius: 2rem;">
    <h2 class="font-weight-bold text-center mt-3">Importaciones por Cliente</h2>

    <figure class="ml-5 ml-md-0">
        <div id="chartInventario"></div>
    </figure>

</section>

<section class="inventario mt-5  pt-3 card card-body h-auto mt-5 border-0 shadow" style="border-radius: 2rem;">
    <div class="row">
        <div class="col-md-6" >
            <h2 class="font-weight-bold text-center mt-3">Importaciones del mes</h2>

            <figure>
                <div id="mesClientes"></div>
            </figure>
        </div>
        <div class="col-md-6">

        </div>

        <div class="col-md-12 mt-5 pt-5 ml-5 ml-md-0">
            <h2 class="text-center font-weight-bold">Kpis</h2>
            <figure class="mr-4">
                <div id="kpis"></div>
            </figure>
        </div>
    </div>

</section>

