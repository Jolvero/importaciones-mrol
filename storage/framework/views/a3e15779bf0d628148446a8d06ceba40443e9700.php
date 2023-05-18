<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('js/clientes.js')); ?>" defer></script>
<script src="<?php echo e(asset('js/alertas.js')); ?>" defer></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php if(session('validacion')): ?>
    <div class="alert alert-danger text-center" role="alert">
        <?php echo e(session('validacion')); ?>

    </div>
<?php endif; ?>

<?php if(session('success')): ?>
    <div class="alert alert-success text-center" role="alert">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>
<!-- modal -->

<div class="modal fade" id="nuevoCliente" tabindex="-1" aria-hidden="true" data-keyboard="false" aria-labelledby="nuevoClienteLabel" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="font-weight-bold">Nuevo Cliente</h5>
                <button type="button" data-dismiss="modal" class="close" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
            </div>

            <div class="modal-body">
                <form action="<?php echo e(route('cliente.store')); ?>" method="POST" novalidate id="formulario-clientes">
                <?php echo csrf_field(); ?>
                <p>Campos obligatorios  <span class="text-danger">*</span></p>
                <div class="form-group">
                    <label for="cliente">Cliente <span class="text-danger">*</span></label>
                    <input type="text" class="form-control <?php $__errorArgs = ['cliente'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="cliente" id="cliente" value="<?php echo e(old('cliente')); ?>">

                    <?php $__errorArgs = ['cliente'];
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

                <div class="form-group">
                    <label for="cliente">RFC</label>
                    <input type="text" class="form-control <?php $__errorArgs = ['rfc'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="rfc" id="rfc" value="<?php echo e(old('rfc')); ?>">

                    <?php $__errorArgs = ['rfc'];
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

                <div class="form-group">
                    <label for="cliente">Dirección</label>
                    <input type="text" class="form-control <?php $__errorArgs = ['direccion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="direccion" id="direccion" value="<?php echo e(old('direccion')); ?>">

                    <?php $__errorArgs = ['direccion'];
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

                <div class="row justify-content-center">
                <input type="submit" class="btn btn-success mt-3" value="Crear" id="crear-cliente" name="crear-cliente">
            </div>
                </form>
            </div>
        </div>
    </div>
</div>
    <div class="container ml-5 ml-md-0">
        <h1 class="text-center font-weight-bold text-uppercase mb-5 card card-body py-2 border-0 shadow" style="border-radius: 2rem;">Clientes</h1>
        <button type="button" style="border-radius: 1rem;" data-target="#nuevoCliente" data-toggle="modal" class="float-right btn btn-nuevo-cliente text-white mb-5"><img src="<?php echo e('/images/anadir.png'); ?>" width="50px"  alt=""> Nuevo
            Cliente</button>

            <table class="table w-100 display responsive nowrap ml-5 ml-md-0" id="table-clientes">
                <thead class="bg-primary">
                <tr class="text-center text-white">
                    <th>#</th>
                    <th>Nombre</th>
                    <th>RFC</th>
                    <th>Dirección</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $clientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cliente): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="text-center">
                        <td><?php echo e($cliente->id); ?></td>
                        <td><?php echo e($cliente->cliente); ?></td>
                        <td><?php echo e($cliente->rfc); ?></td>
                        <td><?php echo e($cliente->direccion); ?></td>
                        <td>
                            <a href="<?php echo e(route('cliente.edit', ['cliente' => $cliente->id])); ?>" class="btn my-2 d-block " style="background: #c3c3c3;"><img src="<?php echo e('/images/editar.png'); ?>" alt=""></a>

                            <form method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="button" onclick="eliminarCliente(<?php echo e($cliente->id); ?>);" id="<?php echo e($cliente->id); ?>" class="btn btn-dark d-block mb-3 w-100" data-toggle="tooltip" data-placement="top" title="Eliminar Cliente"  ><img src="<?php echo e('/images/eliminar.png'); ?>" alt="" ></button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\TECH-LOG\Desktop\importaciones.mrollogistics.com\resources\views/clientes/index.blade.php ENDPATH**/ ?>