<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('js/kpis.js')); ?>" defer></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<h2 class="font-weight-bold ml-5 ml-md-0">KPI's</h2>

<div class="form-group ml-5 ml-md-0">
    <label for="mes">Mes</label>
    <select name="mes" id="mes" class="form-control">
        <option value="">-- Seleccione --</option>

        <?php $__currentLoopData = $meses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($mes->id); ?>" <?php echo e(old('mes')==$mes->id ? 'selected': ''); ?>><?php echo e($mes->mes); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>

</div>

<div class="form-group ml-5 ml-md-0">
    <label for="tipo">Tipo</label>
    <select name="tipo" id="tipo" class="form-control">
        <option value="">-- Seleccione --</option>
        <?php $__currentLoopData = $tipos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($tipo->id); ?>" <?php echo e(old('tipo')==$tipo->id ? 'selected': ''); ?>><?php echo e($tipo->tipo); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>

</div>

<div class="form-group ml-5 ml-md-0">
    <label for="tipo">Cliente</label>
    <select name="cliente" id="cliente" class="form-control">
        <option value="">-- Seleccione --</option>
        <?php $__currentLoopData = $clientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cliente): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($cliente->id); ?>" <?php echo e(old('cliente')==$cliente->id ? 'selected': ''); ?>><?php echo e($cliente->cliente); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>

</div>

<section class="kpis mt-5 pt-3 ml-5 ml-md-0">
    <div class="row mensaje">
    </div>

        <div class="col-md-12 mt-5 pt-5">
            <figure>
                <div id="kpis"></div>
            </figure>
        </div>




</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\TECH-LOG\Desktop\importaciones.mrollogistics.com\resources\views/KPIs/index.blade.php ENDPATH**/ ?>