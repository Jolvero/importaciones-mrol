<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Importación</title>
</head>
<body>

    <?php $__currentLoopData = $importaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $importacion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <h2 class="font-weigth-bold">Referencia: <span class="font-weigth-regular"><?php echo e($importacion->referencia); ?></span></h2>
    <p>Proforma</p>

    <p>Consulta toda la información en <a href="http://127.0.0.1:8000/importacion/<?php echo e($importacion->id); ?>">http://127.0.0.1:8000/importacion/<?php echo e($importacion->id); ?></a></p>

    <img style="display:block" src='http://127.0.0.1:8000/images/logo.jpeg' alt="">
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</body>
</html>
<?php /**PATH C:\Users\TECH-LOG\Desktop\importaciones.mrollogistics.com\resources\views/email/proforma.blade.php ENDPATH**/ ?>