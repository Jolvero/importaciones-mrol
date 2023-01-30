<div class="col-md-4 mt-4">
    <div class="card shadow">
        <div class="card-body">
            <h3 class="card-title"><?php echo e($embarque->referencia); ?></h3>

            <div class="d-block justify-content-between">
                <?php
                $fecha = $embarque->arribo

                ?>
                </div>

    <p class="text-primary font-weight-bold">Arribo: <fecha-embarque class="text-dark" fecha="<?php echo e($fecha); ?>"></fecha-embarque></p>

    <a href="<?php echo e(route('embarques.show', ['embarque' => $embarque->id])); ?>" class="btn btn-primary d-block btn-receta">Ver importación
    </a>

        </div>
    </div>
</div>
<?php /**PATH C:\Users\TECH-LOG\Desktop\importaciones.mrollogistics.com\resources\views/ui/embarque.blade.php ENDPATH**/ ?>