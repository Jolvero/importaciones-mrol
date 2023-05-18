<?php if(Auth::user()->rol_id !=3): ?>
<div id="sidemenu" class="menu-collapsed">
    <div id="header">
        

        <div id="menu-btn" class="mr-5">
            <div class="btn-hamburguer"></div>
            <div class="btn-hamburguer"></div>
            <div class="btn-hamburguer"></div>
        </div>
    </div>
    <div id="menu-items" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="200">
        <ul class="list-unstyled components mb-1">
            <li class="active">
                <div class="d-flex link item-separator pb-2" id="imei" href="<?php echo e(route('kpis.index')); ?>" style="border-bottom: solid 2px #dcdcdc">
                    <a href="<?php echo e(url('/')); ?>"
                        class="mt-2"><img src="<?php echo e('/images/logo-panel-removebg-preview.png'); ?>" class="logo-panel" width="50px" height="50px"alt="" ></a>
                </div>
                <div class="item-parent py-2">
                <a href="#submenuEmbarques" id="importaciones"data-toggle="collapse" aria-expanded="false" class="dropdown-toggle sidebar-link collapsed"><img
                        class="ml-2 item-img mr-3 ml-0"  src="<?php echo e('/images/contenedores.png'); ?>" alt=""><span
                        class="mt-5">Importaciones</span></a>
                    </div>
                <ul class="sidebar-dropdown list-unstyled collapse"id="submenuEmbarques">
                    <li>
                        <a class="sidebar-item d-flex link link-importaciones my-2" id="embarque-index" href="<?php echo e(route('embarques.index')); ?>">
                            <img class="ml-2 item-img mr-3 ml-0" src="<?php echo e('/images/crear.embarque.png'); ?>"
                                alt=""><span class="mt-0 consultar-embarque">Consultar o ingresar
                                Importación</span>
                        </a>
                    </li>

                    <li>

                    </li>

                    <li class="mt-2">

                    </li>
                </ul>
            </li>

                <a class="d-flex link item-separator pb-2" id="imei" href="<?php echo e(route('kpis.index')); ?>">
                    <img class="ml-2 mr-3 mt-2 item-img" src="<?php echo e('/images/kpis.png'); ?>" alt=""> <span
                        class="mt-2">KPI's</span>
                </a>


            <li class="mt-2">
                <div class="item-parent py-2">
                <a href="#submenuCatalogos" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> <img
                        src="<?php echo e('/images/cuadricula.png'); ?>" class="ml-2 item-img mr-3 ml-0"
                        alt=""><span>Catalogos</span></a>
                    </div>
                <ul class="collapse list-unstyled" id="submenuCatalogos">
                    <li>
                        <a class="d-flex link my-2 py-2"id="clientes" href="<?php echo e(route('cliente.index')); ?>">
                            <img class="ml-2 mr-3 item-img" src="<?php echo e('/images/cliente.png'); ?>" alt=""> <span
                                class="mt-0">Clientes</span>
                        </a>
                    </li>

                </ul>
            </li>
            

            
        </ul>

        

            <a class="d-flex link item-separator pb-2 " id="imei" href="<?php echo e(route('usuarios.index')); ?>">
                <img class="ml-2 mr-3 mt-2 item-img" src="<?php echo e('/images/usuario.png'); ?>" alt=""> <span
                    class="mt-2">Usuarios</span>
            </a>

    </div>

</div>
<?php endif; ?>




<?php /**PATH C:\Users\TECH-LOG\Desktop\importaciones.mrollogistics.com\resources\views/panel/panel.blade.php ENDPATH**/ ?>