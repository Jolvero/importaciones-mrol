<?php $__env->startSection('botones'); ?>
    <?php echo $__env->make('ui.navegacion', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php if(session('asistencia')): ?>
        <div class="alert alert-primary text-center mt-5"role="alert">
            <?php echo e(session('asistencia')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('asistenciaCorrecta')): ?>
        <div class="alert alert-success text-center mt-5"role="alert">
            <?php echo e(session('asistenciaCorrecta')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('checarComida')): ?>
        <div class="alert alert-danger text-center mt-5"role="alert">
            <?php echo e(session('checarComida')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('comidaCorrecta')): ?>
        <div class="alert alert-success text-center mt-5"role="alert">
            <?php echo e(session('comidaCorrecta')); ?>

        </div>
    <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/dropzone.min.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('js/embarques.js')); ?>" defer></script>
    <script src="<?php echo e(asset('js/alertas.js')); ?>" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/dropzone.min.js"
        integrity="sha512-Mn7ASMLjh+iTYruSWoq2nhoLJ/xcaCbCzFs0ZrltJn7ksDBx+e7r5TS7Ce5WH02jDr0w5CmGgklFoP9pejfCNA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        AOS.init();
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php if(session('estado')): ?>
        <div class="text-center alert alert-danger" role="alert">
            <?php echo e(session('estado')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('success')): ?>
        <div class="text-center alert alert-success" role="alert">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>
    <div class="modal fade ml-3 ml-md-0" id="nuevaImportacion" tabindex="-1" aria-hidden="true" data-keyboard="false"
        data-backdrop="static" aria-labelledby="nuevaImportacionLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" data-aos="fade-up" data-aos-duration="1000">
                    <h5 class="modal-titile nueva-importacion">Nueva Importación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>

                <div class="modal-body">
                    <form enctype="multipart/form-data" class="text-dark form-create" id="formulario" method="POST"
                        action="<?php echo e(route('embarques.store')); ?>" novalidate>
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cliente_id">Cliente</label>
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
                                                <?php echo e(old('cliente_id') == $cliente->id ? 'selected' : ''); ?>>
                                                <?php echo e($cliente->cliente); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tipo_id">Tipo de Importación</label>
                                    <select name="tipo_id" id="tipo_id"
                                        class="form-control <?php $__errorArgs = ['tipo_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                        <option value="">-- Seleccione</option>
                                        <?php $__currentLoopData = $tipos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($tipo->id); ?>"
                                                <?php echo e(old('tipo_id') == $tipo->id ? 'selected' : ''); ?>><?php echo e($tipo->tipo); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mes_id">Mes</label>
                                    <select name="mes_id" id="mes_id" class="form-control">
                                        <?php $__currentLoopData = $obtenerMeses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option
                                                value="<?php echo e($mes->id); ?>"<?php echo e(old('mes_id') == $mes->id ? 'selected' : ''); ?>>
                                                <?php echo e($mes->mes); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="referencia">Referencia</label>
                                    <input type="text" name="referencia"
                                        class="form-control <?php $__errorArgs = ['referencia'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="referencia"
                                        placeholder="Referencia" value=<?php echo e(old('referencia')); ?>>
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
                                    <label for="estado_id">Estado</label>
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
                                                <?php echo e(old('estado_id') == $estado->id ? 'selected' : ''); ?>>
                                                <?php echo e($estado->nombre); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <?php
                                $fecha = date('Y-m-d');
                            ?>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="prealertado">Prealertado</label>
                                    <input class="form-control <?php $__errorArgs = ['prealertado'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="date"
                                        name="prealertado" id="prealertado"
                                        value="<?php echo e(old('prealertado')); ?><?php echo e($fecha); ?>">
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
                                    <label for="documentacion_id">Estatus de Documentación</label>
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
                                                <?php echo e(old('documentacion_id') == $documentacion->id ? 'selected' : ''); ?>>
                                                <?php echo e($documentacion->nombre); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="documentacion">Fecha Documentación</label>
                                    <input type="date" name="documentacion" id="documentacion"
                                        class="form-control <?php $__errorArgs = ['documentacion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        value="<?php echo e(old('documentacion')); ?>">
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
                            <div class="col-md-12 mb-5">
                                <div class="mb-4 shadow">
                                    <label for="files"
                                        class="block text-dark text-sm font-weight-bold ml-2 my-3 form-control">Documentación</label>
                                    <input type="file" id="files" class="p-3 rounded form-input " name="files[]"
                                        multiple />
                                </div>
                            </div>

                            <div class="input-proforma"></div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="arribo">Arribo</label>
                                    <input class="form-control <?php $__errorArgs = ['arribo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="date"
                                        name="arribo" id="arribo" value="<?php echo e(old('arribo')); ?>">
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
                                        id="revalidación" name="revalidación" value="<?php echo e(old('revalidación')); ?>">
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
                                        id="previo" name="previo" value="<?php echo e(old('previo')); ?>">
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
                                    <label for="pedimento">Pedimento Pagado</label>
                                    <input class="form-control <?php $__errorArgs = ['pedimento'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="date"
                                        id="pedimento" name="pedimento" value="<?php echo e(old('pedimento')); ?>">
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
                                        id="despacho" name="despacho" value="<?php echo e(old('despacho')); ?>">
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
                                    <label for="anticipo">Anticipo</label>
                                    <input type="date" name="pago_anticipo" id="pago_anticipo"
                                        class="form-control <?php $__errorArgs = ['pago_anticipo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        value="<?php echo e(old('pago_anticipo')); ?>">
                                    <?php $__errorArgs = ['pago_anticipo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-feedback"><strong><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
unset($__errorArgs, $__bag); ?>"
                                        type="date" name="cuenta_gastos" id="cuenta_gastos"
                                        value="<?php echo e(old('cuenta_gastos')); ?>">
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

                            <div class="col-md-12 mt-5">
                                <div class="mb-4 shadow">
                                    <label for="file_ctagastos_id"
                                        class="block text-dark text-sm font-weight-bold ml-2 mb-4">Cuenta de
                                        Gastos</label>
                                    <input type="file" id="file_ctagastos_id" class="p-3 rounded form-input "
                                        name="file_ctagastos[]" multiple />
                                </div>
                            </div>

                            <div class="col-md-12">
                                <fieldset>
                                    <legend class="text-white">Previo</legend>
                                    <div class="form-group">
                                        <label for="imagenes"></label>
                                        <div id="dropzone" class="dropzone bg-info">
                                        </div>
                                    </div>
                                </fieldset>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="observaciones">Observaciones Generales</label>
                                    <textarea name="observaciones" id="observaciones"
                                        class="form-control observaciones <?php $__errorArgs = ['observaciones'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo e(old('observaciones')); ?>

                     </textarea>
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
                                </div>
                            </div>
                        </div>

                        <input type="hidden" id="file_id" name="file_id" value="<?php echo e(Str::uuid()->toString()); ?>">
                        <input type="hidden" id="uuid" name="uuid" value="<?php echo e(Str::uuid()->toString()); ?>">
                        <input type="hidden" id="uuid_cta_gastos" name="uuid_cta_gastos"
                            value="<?php echo e(Str::uuid()->tostring()); ?>">
                        <input type="hidden" id="uuid_kpi" name="uuid_kpi" value="<?php echo e(Str::uuid()->toString()); ?>">

                        <div class="form-group d-flex justify-content-center" id="section-btn">
                            <input type="submit" class="btn btn-primary mx-auto mt-4" id="agregar-embarque"
                                name="agregar-embarque" value="Agregar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <form action="<?php echo e(route('buscarEmbarques.show')); ?>"class="container mb-5" id="buscar">

        <div class="row h-100 align-items-center mt-2 ml-3 ml-md-0 justify-content-center" data-aos="fade-down"
            data-aos-duration="1000">
            <div class="col-md-6">
                <p class="buscar display-4 mb-4 ml-5">Buscar Importación</p>
                <input type="search" name="buscarEmbarque" class="form-control mt-5 ml-5" placeholder="Buscar Importación">
            </div>
        </div>
        <p class="ml-5 mt-5">Filtrar Importaciones</p>
        <div class="form-group ml-5 ml-md-4">
            <select name="clientes_filtro" id="clientes_filtro" class="form-control w-25">
                <option value="">-- Todas --</option>
                <?php $__currentLoopData = $clientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cliente): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($cliente->id); ?>"><?php echo e($cliente->cliente); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>


        </div>
    </form>


    <div class="col-md-10 mx-auto" data-aos="fade-up" data-aos-duration="1000">
        <h2 class="text-center my-5 ">Administra tus Importaciones</h2>

        <table class="table bg-white ml-3 ml-md-0">
            <thead class="bg-primary text-light">
                <tr>
                    <th scole="col">Referencia</th>
                    <th scole="col">Estatus</th>

                    <th scole="col" class="text-center">Acciones</th>
                </tr>
            </thead>

            <tbody>

                <?php $__currentLoopData = $embarques; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $embarque): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($embarque->referencia); ?></td>
                        <td class="font-weight-bold"><?php echo e($embarque->estado->nombre); ?></td>
                        <td>
                            <a href="<?php echo e(route('embarques.show', ['embarque' => $embarque->id])); ?>"
                                class="btn btn-primary d-block mb-2" id="ver">Ver</a>
                            <a href="<?php echo e(route('embarques.edit', ['embarque' => $embarque->id])); ?>"
                                class="btn btn-dark d-block mb-2" id="editar">Editar</a>
                            <eliminar-embarque embarque-id=<?php echo e($embarque->id); ?>></eliminar-embarque>

                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <div class="col-12 d-flex mt-4 justify-content-center">
            <?php echo e($embarques->links()); ?>

        </div>
    </div>

    <div class="spinner-section fixed-top">

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\TECH-LOG\Desktop\importaciones.mrollogistics.com\resources\views/embarques/index.blade.php ENDPATH**/ ?>