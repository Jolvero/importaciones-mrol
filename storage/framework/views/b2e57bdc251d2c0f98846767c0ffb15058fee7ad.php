<section data-aos="fade-down" data-aos-duration="1000" class="ml-5 ml-md-0">
    <h3 class="font-weight-bold mb-5 mr-5 mr-md-0 p-3">Bienvenido/a <?php echo e($nombre); ?></h3>
    <div class="row ml-4 justify-content-center">
        

        <div class="col-md-3 mr-5 mr-md-0">
            <div class="card ml-3">
                <div class="card-body">
                    <div class="d-flex">
                        <img src="<?php echo e('/images/contenedores.dash.png'); ?>" alt="">
                        <p class="font-weight-bold ml-3"><?php echo e($embarques); ?> Importaciones</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mr-5 mr-md-0">
            <div class="card ml-3 ">
                <div class="card-body">
                    <div class="d-flex">
                        <img src="<?php echo e('/images/cliente.dash.png'); ?>" alt="">
                        <p class="font-weight-bold ml-3"><?php echo e($clientes); ?> Clientes</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="distribuciones mt-5" data-aos="zoom-in" data-aos-duration="1300">
    <h2 class="font-weight-bold ml-5">Importaciones del Mes</h2>
    <figure class="ml-5 ml-md-0">
        <div id="containerImportaciones">

        </div>
    </figure>

    </div>
</section>
<!-- Inventario -->
<section class="inventario mt-5 pt-3">
    <h2 class="font-weight-bold text-center">Importaciones por Cliente</h2>

    <figure class="ml-5 ml-md-0">
        <div id="chartInventario"></div>
    </figure>

</section>

<section class="inventario mt-5 pt-3">
    <div class="row">
        <div class="col-md-8 mt-5 card card-body ml-5 ">
            <h2 class="font-weight-bold text-center">Importaciones del mes</h2>

            <figure>
                <div id="mesClientes"></div>
            </figure>
        </div>

        <div class="col-md-12 mt-5 pt-5">
            <h2 class="text-center font-weight-bold">Kpis</h2>

            <figure>
                <div id="kpis"></div>
            </figure>
        </div>
    </div>




</section>

<?php /**PATH C:\Users\TECH-LOG\Desktop\importaciones.mrollogistics.com\resources\views/dashboard/dashboard.blade.php ENDPATH**/ ?>