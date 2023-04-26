<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('js/clientes.js')); ?>" defer></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <h1 class="font-weight-bold ml-5 ml-md-0">Editar Cliente</h1>

    <form action="<?php echo e(route('cliente.update', ['cliente' => $cliente->id])); ?>" method="POST" id="formulario-clientes" class="ml-5 ml-md-0">
        <?php echo method_field('PUT'); ?>
        <?php echo csrf_field(); ?>
        <p class="font-weight-bold text-center">Campos obligatorios <span class="text-danger">*</span></p>
        <div class="form-group mt-4">
            <label for="cliente">Cliente <span class="text-danger">*</span></label>
            <input type="text" name="cliente" id="cliente" class="form-control <?php $__errorArgs = ['cliente'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                value="<?php echo e($cliente->cliente); ?>">

            <?php $__errorArgs = ['nombre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="invalid-feedback" role="alert"><strong><?php echo e($message); ?></strong></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <?php if($cliente->rfc): ?>
            <div class="form-group">
                <label for="rfc">Rfc</label>
                <input type="text" name="rfc" id="rfc" class="form-control" value="<?php echo e($cliente->rfc); ?>">
            </div>
        <?php else: ?>
        <div class="form-group">
            <label for="rfc">Rfc</label>
            <input type="text" name="rfc" id="rfc" class="form-control" value="<?php echo e(old('rfc')); ?>">

        </div>
        <?php endif; ?>

        <?php if($cliente->direccion): ?>
            <div class="form-group">
                <label for="direccion">Direccion</label>
                <input type="text" name="direccion" id="direccion" class="form-control"
                    value="<?php echo e($cliente->direccion); ?>">
            </div>
        <?php else: ?>
        <div class="form-group">
            <label for="direccion">Dirección<nav></nav></label>
            <input type="text" name="direccion" id="direccion" class="form-control" value="<?php echo e(old('direccion')); ?>">

        </div>
        <?php endif; ?>

        <button type="submit" class="btn btn-success">Editar Cliente</button>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\TECH-LOG\Desktop\importaciones.mrollogistics.com\resources\views/clientes/edit.blade.php ENDPATH**/ ?>