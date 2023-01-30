<?php $__env->startSection('scripts'); ?>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init();
  </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('styles'); ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="hero" style="padding-bottom: 900px" data-aos="fade-up" data-aos-duration="1000">
    <form action="<?php echo e(route('buscar.show')); ?>" class="container h-100">
        <div class="row h-100 align-items-center mt-4 justify-content-center">
           <div class="col-md-6 texto-buscar">
            <p class="display-4 mb-4">Buscar Importación</p>

            <input type="search" name="buscar" class="form-control mt-5" placeholder="Buscar Importación">
           </div>
        </div>
    </form>
</div>

<div class="importaciones-cliente">
    <div class="col-md-10 mx-auto" data-aos="fade-up" data-aos-duration="1000">
        <h2 class="text-center my-5 pt-4">Administra tus Importaciones</h2>

        <table class="table bg-white">
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
                        <a href="<?php echo e(route('embarques.edit', ['embarque' => $embarque->id])); ?>" class="btn btn-dark d-block mb-2" id="editar">Editar</a>
                        <eliminar-embarque embarque-id=<?php echo e($embarque->id); ?>></eliminar-embarque>

                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <div class="col-12 d-flex mt-4 justify-content-center">
        <?php echo e($embarquesCliente->links()); ?>

    </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\TECH-LOG\Desktop\importaciones.mrollogistics.com\resources\views/inicio/index.blade.php ENDPATH**/ ?>