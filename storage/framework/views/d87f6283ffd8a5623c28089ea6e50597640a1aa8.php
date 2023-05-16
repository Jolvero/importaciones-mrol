<?php $__env->startSection('scripts'); ?>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script src="<?php echo e(asset('js/table-clientes-embarques.js')); ?>" defer></script>
<script>
    AOS.init();
  </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('styles'); ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<h1 class="mb-5 font-weight-bold">Bienvenido/a <?php echo e(Auth::user()->name); ?></h1>


<div class="importaciones-cliente">
    <div class="col-md-10 mx-auto" data-aos="fade-up" data-aos-duration="1000">
        <h2 class="text-center my-5 pt-4">Consulta tus Importaciones</h2>

        <table class="table w-100 display responsive nowrap ml-5 ml-md-0" id="table-clientes-embarques">
            <thead class="bg-primary text-light">
                <tr>
                    <th scole="col">Referencia</th>
                    <th scole="col">Estatus</th>

                    <th scole="col" class="text-center">Acciones</th>
                </tr>
            </thead>

            <tbody>

                <?php $__currentLoopData = $embarquesCliente; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $embarque): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($embarque->referencia); ?></td>
                    <td class="font-weight-bold"><?php echo e($embarque->estado->nombre); ?></td>
                    <td>
                        <a href="<?php echo e(route('embarques.show', ['embarque' => $embarque->id])); ?>" class="btn btn-primary d-block mb-2" id="ver">Ver</a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>


    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\TECH-LOG\Desktop\importaciones.mrollogistics.com\resources\views/clientesEmbarques/index.blade.php ENDPATH**/ ?>