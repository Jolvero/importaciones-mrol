<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('js/embarques.js')); ?>" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/dropzone.min.js"
        integrity="sha512-Mn7ASMLjh+iTYruSWoq2nhoLJ/xcaCbCzFs0ZrltJn7ksDBx+e7r5TS7Ce5WH02jDr0w5CmGgklFoP9pejfCNA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>
    <script src="<?php echo e(asset('js/spinner.js')); ?>" defer></script>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/dropzone.min.css"
        integrity="sha512-0ns35ZLjozd6e3fJtuze7XJCQXMWmb4kPRbb+H/hacbqu6XfIX0ZRGt6SrmNmv5btrBpbzfdISSd8BAsXJ4t1Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('botones'); ?>
    <div data-aos="fade-right" data-aos-duration="1000" class="ml-5 ml-md-0">
        <a href="<?php echo e(route('embarques.index')); ?>" class="text-dark btn btn-outline-primary" id="btnvolver"
            class="btn btn-outline-primary mr-2 text-uppercase font-weight-bold mt-5">
            <svg class="w-6 h-6 icono" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z"
                    clip-rule="evenodd"></path>
            </svg>
            Volver</a>
    </div>
<?php $__env->stopSection(); ?>
<style>
    @media(min-width:768px) {
        .formulario {
            max-width: 70%;
        }
    }
</style>
<?php $__env->startSection('content'); ?>

    <h2 class="text-center text-dark font-weight-bold mb-5">Editar Importación: <?php echo e($embarque->referencia); ?></h2>

    <?php if(session('estado')): ?>
        <div class="alert alert-primary" role="alert">
            <?php echo e(session('estado')); ?>

        </div>
    <?php endif; ?>
    <div class="row justify-content-start mt-5 ml-5 ml-md-0 formulario" data-aos="fade-up" data-aos-duration="1000">
        <div class="col-md-8">
            <?php if($embarque->uuid_proforma): ?>
                <div class="table-responsive text-dark">
                    <div class="card-body">
                        <div class="card-header m-2 shadow">
                            <h3 class="card-title text-center">Proforma</h3>
                        </div>
                        <table class="table text-dark">
                            <thead>
                                <tr>
                                    <th scope="col">Nombre </th>
                                    <th scope="col">Ver</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $__currentLoopData = $proforma; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proforma): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="text-dark">
                                        <td scope="row"><?php echo e($proforma->name); ?></td>
                                        <td>
                                            <a target="blank" href="<?php echo e(route('proforma.show', $proforma->name)); ?>"
                                                class="btn btn-sm btn-outline-secondary">Ver
                                            </a>
                                        </td>

                                        <td>

                                            <form action="<?php echo e(route('proforma.destroy', $proforma->name)); ?>" method="POST"
                                                class="text-dark">
                                                <?php echo method_field('DELETE'); ?>
                                                <?php echo csrf_field(); ?>
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                    Eliminar
                                                </button>
                                            </form>


                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>
            <div class="card-body text-dark">
                <div class="card-header m-2 shadow ">
                    <h3 class="card-title text-center">Documentación</h3>
                </div>
                <div class="table-responsive">
                    <table class="table text-dark">
                        <thead>
                            <tr class="text-dark">
                                <th scope="col">Nombre </th>
                                <th scope="col">Ver</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="text-dark">
                                    <td scope="row"><?php echo e($file->name); ?></td>
                                    <td>
                                        <a target="blank" href="<?php echo e(route('files.show', $file->name)); ?>"
                                            class="btn btn-sm btn-outline-secondary text-dark">Ver
                                        </a>
                                    </td>
                                    <td>

                                        <form action="<?php echo e(route('files.destroy', $file->name)); ?>" method="POST">
                                            <?php echo method_field('DELETE'); ?>
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>

            </div>

            <div class="table-responsive text-dark">
                <div class="card-body">
                    <div class="card-header m-2 shadow">
                        <h3 class="card-title text-center">Cuentas de Gastos</h3>
                    </div>
                    <table class="table text-dark">
                        <thead>
                            <tr>
                                <th scope="col">Nombre </th>
                                <th scope="col">Ver</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $__currentLoopData = $cuentas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cuenta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="text-dark">
                                    <td scope="row"><?php echo e($cuenta->name); ?></td>
                                    <td>
                                        <a target="blank" href="<?php echo e(route('cuentas.show', $cuenta->name)); ?>"
                                            class="btn btn-sm btn-outline-secondary">Ver
                                        </a>
                                    </td>

                                    <td>

                                        <form action="<?php echo e(route('cuentas.destroy', $cuenta->name)); ?>" method="POST"
                                            class="text-dark">
                                            <?php echo method_field('DELETE'); ?>
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                Eliminar
                                            </button>
                                        </form>


                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>



            <form enctype="multipart/form-data" method="POST" class="text-dark form-edit"
                action="<?php echo e(route('embarques.update', ['embarque' => $embarque->id])); ?>" id="formulario" novalidate>
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <p>Campos obligatorios  <span class="text-danger">*</span></p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cliente_id">Cliente <span class="text-danger">*</span></label>
                            <select name="cliente_id" class="form-control <?php $__errorArgs = ['cliente_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                id="cliente_id">
                                <option value="">-- Seleccione --</option>
                                <?php $__currentLoopData = $clientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cliente): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($cliente->id); ?>"
                                        <?php echo e($embarque->cliente_id == $cliente->id ? 'selected' : ''); ?>>
                                        <?php echo e($cliente->cliente); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tipo_id">Tipo Importación <span class="text-danger">*</span></label>
                            <select name="tipo_id" id="tipo_id"
                                class="form-control <?php $__errorArgs = ['tipo_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <option value="">-- Seleccione --</option>
                                <?php $__currentLoopData = $tipos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($tipo->id); ?>"
                                        <?php echo e($embarque->tipo_id == $tipo->id ? 'selected' : ''); ?>>
                                        <?php echo e($tipo->tipo); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="mes_id">Mes <span class="text-danger">*</span></label>
                            <select name="mes_id" id="mes_id" class="form-control">
                                <option value="">-- Seleccione --</option>
                                <?php $__currentLoopData = $obtenerMeses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option
                                        value="<?php echo e($mes->id); ?>"<?php echo e($embarque->mes_id == $mes->id ? 'selected' : ''); ?>>
                                        <?php echo e($mes->mes); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="referencia">Referencia <span class="text-danger">*</span></label>
                            <input type="text" name="referencia"
                                class="form-control <?php $__errorArgs = ['referencia'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="referencia"
                                placeholder="Referencia" value="<?php echo e($embarque->referencia); ?>">

                            <?php $__errorArgs = ['referencia'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="estado_id">Estado <span class="text-danger">*</span></label>
                            <select name="estado_id" class="form-control <?php $__errorArgs = ['estado_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                id="estado_id">
                                <option value="">-- Seleccione --</option>
                                <?php $__currentLoopData = $estados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $estado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($estado->id); ?>"
                                        <?php echo e($embarque->estado_id == $estado->id ? 'selected' : ''); ?>> <?php echo e($estado->nombre); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group ">
                            <label for="prealertado"></label>Prealertado <span class="text-danger">*</span>
                            <input class="form-control mt-2 <?php $__errorArgs = ['prealertado'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="date"
                                name="prealertado" id="prealertado" value="<?php echo e($embarque->prealertado); ?>">
                            <?php $__errorArgs = ['prealertado'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="documentacion_id">Estatus Documentación <span class="text-danger">*</span></label>
                            <select name="documentacion_id"
                                class="form-control <?php $__errorArgs = ['documentacion_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                id="documentacion_id">
                                <option value="">-- Seleccione --</option>
                                <?php $__currentLoopData = $documentaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $documentacion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($documentacion->id); ?>"
                                        <?php echo e($embarque->documentacion_id == $documentacion->id ? 'selected' : ''); ?>>
                                        <?php echo e($documentacion->nombre); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="documentacion">Fecha Documentación <span class="text-danger">*</span></label>
                            <input type="date" name="documentacion" id="documentacion"
                                class="form-control <?php $__errorArgs = ['documentacion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                value="<?php echo e($embarque->documentacion); ?>">
                            <?php $__errorArgs = ['documentacion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback"><strong><?php echo e($message); ?></strong></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="mb-4 ">
                            <label for="file_id"
                                class="block text-dark text-sm font-weight-bold  mb-4 ml-2">Documentación <span class="text-danger">*</span></label>
                            <input type="file" id="files" data-tipo="editar" class="p-3 rounded form-input "
                                name="files[]" multiple />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="input-proforma"></div>

                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label for="observaciones_pedimento">Observaciones Pedimento</label>
                            <textarea name="observaciones_pedimento" id="observaciones_pedimento"
                                class="form-control observaciones_pedimento <?php $__errorArgs = ['observaciones_pedimento'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo e(old('observaciones_pedimento')); ?><?php echo e($embarque->observaciones_pedimento); ?></textarea>
                            <?php $__errorArgs = ['observaciones_pedimento'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <br>
                                <small><?php echo e($message); ?></small>
                                <br>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>


                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="arribo"></label>Arribo <span class="text-danger">*</span>
                            <input class="form-control mt-2 <?php $__errorArgs = ['arribo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="date"
                                name="arribo" id="arribo" value="<?php echo e($embarque->arribo); ?>">
                            <?php $__errorArgs = ['arribo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="revalidación">Revalidación</label>
                            <input class="form-control <?php $__errorArgs = ['revalidación'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="date"
                                id="revalidación" name="revalidación" value="<?php echo e($embarque->revalidación); ?>">
                            <?php $__errorArgs = ['revalidación'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                        </div>

                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="previo">Previo</label>
                            <input class="form-control <?php $__errorArgs = ['previo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="date"
                                id="previo" name="previo" value="<?php echo e($embarque->previo); ?>">
                            <?php $__errorArgs = ['previo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="pedimento">Pedimento</label>
                            <input class="form-control <?php $__errorArgs = ['pedimento'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="date"
                                id="pedimento" name="pedimento" value="<?php echo e($embarque->pedimento); ?>">
                            <?php $__errorArgs = ['pedimento'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="despacho">Despacho</label>
                            <input class="form-control <?php $__errorArgs = ['despacho'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="date"
                                id="despacho" name="despacho" value="<?php echo e($embarque->despacho); ?>">
                            <?php $__errorArgs = ['despacho'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="despacho_id">Estatus Despacho</label>
                            <select class="form-control text-uppercase <?php $__errorArgs = ['despacho_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                type="date" id="despacho_id" name="despacho_id">
                                <option value="">-- Seleccione --</option>

                                <?php $__currentLoopData = $elementosDespachos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $estatus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($estatus->id); ?>"
                                        <?php echo e($embarque->despacho_id == $estatus->id ? 'selected' : ''); ?>>
                                        <?php echo e($estatus->nombre); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php $__errorArgs = ['despacho_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="pago_anticipo">Anticipo</label>
                            <input class="form-control <?php $__errorArgs = ['pago_anticipo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="date"
                                name="pago_anticipo" id="pago_anticipo" value="<?php echo e($embarque->pago_anticipo); ?>">
                            <?php $__errorArgs = ['pago_anticipo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-4">
                            <label for="file_ctagastos_id"
                                class="block text-dark text-sm font-weight-bold  mb-4 ml-2">Cuenta de
                                Gastos</label>
                            <input type="file" id="file_ctagastos_id" class="p-3 rounded form-input "
                                name="file_ctagastos[]" multiple />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cuenta_gastos">Cuenta de gastos</label>
                            <input class="form-control <?php $__errorArgs = ['cuenta_gastos'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="date"
                                name="cuenta_gastos" id="cuenta_gastos" value="<?php echo e($embarque->cuenta_gastos); ?>">
                            <?php $__errorArgs = ['cuenta_gastos'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                </div>

                <fieldset>
                    <div class="form-group">
                        <label for="imagenes">Imagenes</label>
                        <div id="dropzone" class="dropzone bg-info">
                        </div>
                    </div>
                </fieldset>
                <?php if(count($imagenes) > 0): ?>
                    <?php $__currentLoopData = $imagenes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $imagen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <input class="galeria" type="hidden" value="<?php echo e($imagen->ruta_imagen); ?>">
                        <input type="hidden" id="uuid" name="uuid" value="<?php echo e($imagen->id_embarque); ?>">
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>

                <div class="form-group">
                    <label for="observaciones">Observaciones</label>
                    <textarea name="observaciones" id="observaciones"
                        class="form-control observaciones <?php $__errorArgs = ['observaciones'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo e(old('observaciones')); ?><?php echo e($embarque->observaciones); ?></textarea>
                    <?php $__errorArgs = ['observaciones'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <br>
                        <small><?php echo e($message); ?></small>
                        <br>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                    <input type="hidden" id="file_id" name="file_id" value="<?php echo e($embarque->file_id); ?>">
                    <input type="hidden" id="uuid_cta_gastos" name="uuid_cta_gastos"
                        value="<?php echo e($embarque->uuid_cta_gastos); ?>">
                </div>


                <input type="hidden" id="uuid" name="uuid" value="<?php echo e($embarque->uuid); ?>">
                <input type="hidden" id="uuid_kpi" name="uuid_kpi" value="<?php echo e($embarque->uuid_kpi); ?>">


                <div class="form-group d-flex justify-content-center">
                    <input type="submit" class="btn btn-primary mx-auto mt-4" value="Actualizar Embarque"
                        id="agregar-embarque">
                </div>
        </div>

        <div class="spinner-section fixed-top">
            <div class="orbit-spinner mx-auto">
                <div class="orbit"></div>
                <div class="orbit"></div>
                <div class="orbit"></div>
            </div>

        </div>

        </form>

    </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\TECH-LOG\Desktop\importaciones.mrollogistics.com\resources\views/embarques/edit.blade.php ENDPATH**/ ?>