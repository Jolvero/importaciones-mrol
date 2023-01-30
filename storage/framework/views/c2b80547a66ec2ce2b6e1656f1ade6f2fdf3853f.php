<?php $__env->startSection('botones'); ?>
<a href="<?php echo e(route('inicio.index')); ?>"
class="btn btn-outline-primary mr-2 text-uppercase font-weight-bold mt-5" >
<svg class="w-6 h-6 icono" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z" clip-rule="evenodd"></path></svg>
Volver</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <?php if(count($embarques) > 0): ?>
    <h2 class="titulo-estado text-uppercase mt-5 mb-4">
        Resultados Busqueda: <?php echo e($busqueda); ?>

    </h2>
    <?php endif; ?>

    <div class="row">
        <?php $__currentLoopData = $embarques; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $embarque): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php echo $__env->make('ui.embarque', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="container">
        <?php if(count($embarques) ==0 ): ?>

        <div class="container d-flex flex-column align-items-center">
            <h2 class="text-center">No se encontraron resultados para tu busqueda</h2>
            <img src="/storage/sin-resultados/container-186-781049.webp" class="img-fluid mx-auto mt-5" alt="">
        </div>
        </div>
        <?php endif; ?>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\TECH-LOG\Desktop\importaciones.mrollogistics.com\resources\views/busquedas/show.blade.php ENDPATH**/ ?>