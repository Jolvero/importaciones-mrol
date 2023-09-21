const tabla = document.querySelector('table');
document.addEventListener('DOMContentLoaded', asignarPedimento)
const mes = new Date();
const numero = mes.getMonth()
const acomodar = numero + 1;
const url = document.querySelector('#url')

if (tabla) {
    $('#table-embarques').DataTable({
        responsive: true,
        colReorder: true,
        RowReorder: true,
        language: {
            "decimal": "",
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty": "Mostrando 0 de 0 de 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Entradas",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            },

        }, columnDefs: [
            {
                className: 'dt-center', targets: '_all'
            }
        ]
    }
    )
};

// el mes se actualiza cuando se crean embarques
if (url) {
    $('#mes_id option[value=' + acomodar + ']').attr('selected', true)
}

// validación
$('#formulario').on('submit', function validarFormulario() {
    const cliente_id = document.getElementById('cliente_id').value;

    if (cliente_id == null || cliente_id == 0 || /^\+$/.test(cliente_id)) {
        Swal.fire({
            title: 'validación',
            text: 'El campo cliente es requerido',
            icon: 'error',
        })
        return false;

    }

    const tipoImportacion = document.getElementById('tipo_id').value;

    if (tipoImportacion == null || tipoImportacion == 0 || /^\+$/.test(tipoImportacion)) {
        Swal.fire({
            title: 'validación',
            text: 'El campo Tipo de Importación es requerido',
            icon: 'error'
        })
        return false;
    }

    const mes_id = document.getElementById('mes_id').value;

    if (mes_id == null || mes_id == 0 || /^\+$/.test(mes_id)) {
        Swal.fire({
            title: 'validación',
            text: 'El campo Mes es requerido',
            icon: 'error'
        })

        return false;
    }

    const referencia = document.getElementById('referencia').value;

    if (referencia == null || referencia == 0 || /^\+$/.test(referencia)) {
        Swal.fire({
            title: 'validación',
            text: 'El campo Referencia es requerido',
            icon: 'error'
        })
        return false;

    }

    const estado_id = document.getElementById('estado_id').value;

    if (estado_id == null || estado_id == 0 || /^\+$/.test(estado_id)) {
        Swal.fire({
            title: 'validación',
            text: 'El campo Estado es requerido',
            icon: 'error'
        })
        return false;
    }

    const prealertado = document.getElementById('prealertado').value;

    if (prealertado == null || prealertado == 0 || /^\+$/.test(prealertado)) {
        Swal.fire({
            title: 'validación',
            text: 'la fecha de prealerta es requerida',
            icon: 'error'
        })
        return false;
    }

    const documentacion_id = document.getElementById('documentacion_id').value;

    if (documentacion_id == null || documentacion_id == 0 || /^\+$/.test(documentacion_id)) {
        Swal.fire({
            title: 'validación',
            text: 'El campo estatus documentacion es requerido',
            icon: 'error'
        })
        return false;
    }

    const fecha_documentacion = document.getElementById('documentacion').value;

    if (fecha_documentacion == null || fecha_documentacion == 0 || /^\+$/.test(fecha_documentacion)) {
        Swal.fire({
            title: 'validación',
            text: 'El campo fecha documentacion es requerido',
            icon: 'error'
        })
        return false;
    }

    const documentacionArchivos = document.getElementById('files').files.length;
    // validar si el usuario esta editando la importacion y no validar documentacion
    const tipoDocumentacion = document.querySelector('#files').getAttribute('data-tipo');
    if (documentacionArchivos == 0 && tipoDocumentacion == null) {
        Swal.fire({
            title: 'validación',
            text: 'Debes subir los archivos de documentación',
            icon: 'error'
        })

        return false;
    }

    const arribo = document.getElementById('arribo').value;

    if (arribo == null || arribo == 0 || /^\+$/.test(arribo)) {
        Swal.fire({
            title: 'validación',
            text: 'El campo arribo es requerido',
            icon: 'error'
        })
        return false;
    }

    const despacho = document.getElementById('despacho').value;

    if (arribo == despacho) {

        Swal.fire({
            title: 'validación',
            text: 'la fecha despacho debe ser posterior a Arribo',
            icon: 'error'
        })
        return false;
    }

    if (new Date(despacho) < new Date(arribo)) {
        Swal.fire({
            title: 'validación',
            text: 'la fecha Despacho debe ser posterior a Arribo',
            icon: 'error'
        })
        return false;
    }

    const previo = document.getElementById('previo').value;
    const cuenta_gastos = document.getElementById('cuenta_gastos').value;

    if (cuenta_gastos) {
        if (new Date(arribo) >= new Date(cuenta_gastos) || new Date(cuenta_gastos) <= new Date(previo)) {

            Swal.fire({
                title: 'validación',
                text: 'la fecha Cuenta de gastos debe ser posterior a Arribo y a previo',
                icon: 'error'
            })
            return false;
        }
    }

    if (arribo && previo) {
        if (new Date(arribo) > new Date(previo)) {
            Swal.fire({
                title: 'validación',
                text: 'la fecha de previo debe ser posterior a Arribo',
                icon: 'error'
            })
            return false;
        }
    }

    // validar tamaño de archivos de documentación
    const archivos = document.getElementById('files')
    const contarArchivos = archivos.files.length;

    if(contarArchivos > 0) {
        for(let i = 0; i < contarArchivos; i++) {
            var pesoArchivo = archivos.files[i].size
            if(pesoArchivo > 20000000) {
                Swal.fire({
                    title: 'Archivos',
                    text: 'El tamaño máximo de archivo de la documentación es de 20 M, revisa el tamaño de los archivos cargados',
                    icon: 'error'
                })
                return false;
            }
        }
    }

     // validar tamaño de archivos de cuenta de gastos
     const archivosCG = document.getElementById('file_ctagastos_id')
     const contarArchivosCG = archivosCG.files.length;

     if(contarArchivosCG > 0) {
         for(let i = 0; i < contarArchivos; i++) {
             var pesoArchivo = archivosCG.files[i].size
             if(pesoArchivo > 20000000) {
                 Swal.fire({
                     title: 'Archivos',
                     text: 'El tamaño máximo de archivo de las Cuentas de Gastos es de 20 M, revisa el tamaño de los archivos cargados',
                     icon: 'error'
                 })
                 return false;
             }
         }
     }

     const despacho_id = document.querySelector('#despacho_id')

     if(despacho_id) {
        if (estado_id == 6 && despacho_id.value == 0 || /^\+$/.test(despacho_id.value)) {

            Swal.fire({
                title: 'validación',
                text: 'Debes seleccionar un estatus de despacho',
                icon: 'error'
            })
            return false;
        }
     }


    Swal.fire({
        title: 'importacion',
        text: 'Subiendo Importacion',
        icon: 'info',
        allowOutsideClick: false,
        allowEscapeKey: false,
        didOpen: () => {
            Swal.showLoading()
        }
    })
    $('#agregar-embarque').prop('disabled', true)
})

// validar si cliente es vivo y habilitar input de proforma
const cliente_id = document.querySelector('#cliente_id');
cliente_id.addEventListener('change', asignarPedimento);


function asignarPedimento() {
    // archivo proforma
    var input = '<div class="col-md-6 mb-5"><div class="form-group"><label for="Proforma-pedimento" class="font-weight-bold ml-3 proforma-pedimento-label">Proforma Pedimento</label><input type="file" name="proforma_pedimento[]" id="proforma_pedimento"accept=".pdf, class="form-control mt-3"></div></div>';

    // Observaciones

    const validarNuevaImportacion = document.querySelector('.nueva-importacion');
    if ($('#cliente_id').val() == 2 && validarNuevaImportacion) {
        $('.input-proforma').append(input)

    } else if ($('#cliente_id').val() == 2 && validarNuevaImportacion == null) {
        $('.input-proforma').append(input)
        $('.proforma-pedimento-label').text('Proforma Pedimento Pagado');

    }

    else {
        $('.input-proforma').children().remove()
    }
}

// Filtros
$('#clientes_filtro').on('change', function filtrar() {
    if ($('#clientes_filtro').val()) {
        var embarques = '';
        $.get('/embarques/' + $('#clientes_filtro').val() + '/filtro', function (data) {
            $('tbody').children().remove();

            for (let i = 0; i < data.length; ++i) {
                embarques += `<tr><td>${data[i].referencia}</td>` +
                    `<td class="font-weight-bold">${data[i].estado.nombre}</td>` +
                    `<td><a href="/importacion/${data[i].id}" class="btn btn-primary d-block mb-2">Ver</a>` +
                    `<a href="/embarques/${data[i].id}/edit" class="btn btn-dark d-block mb-2">Editar</a>` +
                    `<a class="btn btn-danger d-block mb-2" data-id="${data[i].id}" id="eliminar-embarque">Eliminar x</a></td></tr>`
            }

            $('tbody').append(embarques);

            $('#eliminar-embarque').on('click', function (el) {
                const attribute = document.querySelector('#eliminar-embarque').getAttribute('data-id');

                Swal.fire({
                    title: '¿Deseas eliminar la importación',
                    text: 'Una vez eliminada, no se podrá recuperar',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Si',
                    cancelButtonColor: "#3085d6",
                    confirmButtonColor: "#d33",
                    cancelButtonText: 'No'
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Eliminar',
                            text: 'Eliminando Importación',
                            icon: 'info',
                            showOkButton: false,
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            didOpen: () => {
                                Swal.showLoading()
                            }
                        })

                        const params = {
                            id: this.recetaId,
                        };
                        // Enviar la petición al servidor
                        axios
                            .post(`/embarques/${attribute}/eliminar`, {
                                params,
                                _method: "delete",
                            })
                            .then((respuesta) => {
                                Swal.fire({
                                    title: "Importación Eliminada",
                                    text: "Se eliminó la Importación",
                                    icon: "success",
                                });

                                // Eliminar embarque del DOM
                                location.reload();

                            })

                            .catch((error) => {
                                console.log(error);
                            });
                    }
                })

            })

        })
    } else {
        location.reload()
    }


})

function eliminarEmbarque(id) {
    const elemento = document.getElementById(id);
    Swal.fire({
        title: 'Eliminar',
        text: '¿Deseas eliminar la importación?, una vez eliminada ya no se podrá recuperar',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        cancelButtonColor: '#605f5f',
        confirmButtonText: 'Si',
        confirmButtonColor: '#722f37',
        icon: 'warning',
        allowEscapeKey: false,
        allowOutsideClick: false
    }).then((result) => {
        if (result.value) {
            Swal.fire({
                title: 'Eliminar',
                text: 'Eliminando Importación',
                icon: 'info',
                allowEscapeKey: false,
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading()
                }
            });
            $.ajax({
                url: `/embarques/${id}/eliminar`,
                method: 'DELETE',
                data: {
                    id: id,
                    _token: $('input[name="_token"]').val()
                }
            }).done(function () {
                Swal.fire({
                    title: 'Eliminar',
                    text: 'Importación eliminada',
                    icon: 'success',
                    allowEscapeKey: false,
                    allowOutsideClick: false
                })
            })

            elemento.parentElement.parentElement.parentElement.remove()
            $('.child').remove();
        }
    })
}
