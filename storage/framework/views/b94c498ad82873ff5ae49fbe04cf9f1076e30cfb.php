<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Despacho</title>
</head>
<body>
    <?php $__currentLoopData = $despachos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $despacho): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <h2>Estatus de despacho <?php echo e($despacho->referencia); ?>:<span><?php echo e($despacho->despachos->nombre); ?></span></h2>
    <p >Consulta toda la información en <a href="http://127.0.0.1:8000/importacion/<?php echo e($despacho->id); ?>">http://127.0.0.1:8000/importacion/<?php echo e($despacho->id); ?></a></p>

    <img style="display:block" src='http://127.0.0.1:8000/images/logo.jpeg' alt="">
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</body>
</html>
<?php /**PATH C:\Users\TECH-LOG\Desktop\importaciones.mrollogistics.com\resources\views/email/despacho.blade.php ENDPATH**/ ?>