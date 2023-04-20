<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js" defer></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js" defer></script>
    <script src="https://cdn.datatables.net/rowreorder/1.3.2/js/dataTables.rowReorder.min.js" defer></script>
    <script type="text/javascript" src="https://cdn.datatables.net/colreorder/1.6.1/js/dataTables.colReorder.min.js" defer>
    </script>
    <script src="<?php echo e(asset('js/menuLateral.js')); ?>" defer></script>
    <script src="<?php echo e(asset('js/spinner.js')); ?>" defer></script>
    <script src="<?php echo e(asset('js/login.js')); ?>" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts" defer></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <?php echo $__env->yieldContent('styles'); ?>

    <link href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/rowreorder/1.3.2/css/rowReorder.dataTables.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/colreorder/1.6.1/css/colReorder.dataTables.min.css">
    <!-- Styles -->
    
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">

</head>

<body>
    <div id="app" class="bg-index">
        <!-- Incluir panel si el usuario esta autenticado -->
       <?php if(auth()->guard()->guest()): ?>

       <?php else: ?>
       <?php echo $__env->make('panel.panel', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

       <?php endif; ?>

        <nav class="navbar navbar-expand-md navbar-light bg-dark shadow-sm py-2 nav-principal">
            <div class="container index m-0 p-0">
                <div class="d-flex justify-content-start ">
                    <a class="navbar-brand text-white p-0" href="<?php echo e(url('/')); ?>">
                    </a>

                </div>

                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="<?php echo e(__('Toggle navigation')); ?>">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <?php if(auth()->guard()->check()): ?>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-5 ml-md-0 d-flex flex-md-row flex-column align-items-center" id="items-nav" >

                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                            <?php echo csrf_field(); ?>
                        </form>
                        <!-- Authentication Links -->
                        <a  href="<?php echo e(route('logout')); ?>" id="logout" style="width: 30px" data-toggle="tooltip" data-placement="top" title="Salir"
                        onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                         <img  src="<?php echo e('/images/log-out.png'); ?>" width="35px" alt="">
                    </a>


                    </ul>
                </div>
                <?php endif; ?>

            </div>
        </nav>




        
        <div class="container">
            <div class="row">
                <div class="py-5 mt-5 col-12">
                    <?php echo $__env->yieldContent('botones'); ?>
                </div>

                <main class="py-1 mt-1 col-12">
                    <?php echo $__env->yieldContent('content'); ?>
                </main>
            </div>

        </div>
        <div class="hero-inicio">
            <?php echo $__env->yieldContent('hero'); ?>
        </div>
        <?php echo $__env->yieldContent('style'); ?>
    </div>

    <?php echo $__env->yieldContent('scripts'); ?>
    <div class="spinner-section fixed-top"></div>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
</body>

</html>
<?php /**PATH C:\Users\TECH-LOG\Desktop\importaciones.mrollogistics.com\resources\views/layouts/app.blade.php ENDPATH**/ ?>