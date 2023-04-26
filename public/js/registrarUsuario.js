// si el usuario es un cliente se agrega select clientes
$('#rol_id').on('change', function validarRolCliente() {
    if($('#rol_id ').val() == '3' ) {
        $.get('/clientes/all', function (data) {
            var option = '';
                var select = '<select name="cliente_id" class="form-control"id="cliente_id" name="cliente_id"></select>';
                var formGroup = '<div class="form-group form-clientes" id="select-cliente" <label>Cliente</label></div>';

                $('#cliente').addClass('col-md-6', 'cliente-select');
                $('#cliente').append(formGroup);
                $('.form-clientes').append(select)

                for(let i = 0; i< data.length; ++i) {
                    option+= `<option value= ${data[i].id}>${data[i].cliente}</option>`
                }
                $('#cliente_id').append(option)

        })

    } else {
        $('#select-cliente').remove()
    }
})

$('#form-usuario').on('submit', function () {
    const nombre = document.getElementById('name').value;

    if(nombre == null || nombre == 0 || /^\+$/.test(nombre)) {

        Swal.fire({
            title: 'validación',
            text: 'El campo nombre es requerido',
            icon: 'error'
        })
        return false;
    }

    const username = document.querySelector('#username')

    if(username) {
        if(username.value == null || username.value == 0 || /^\+$/.test(username.value)) {

            Swal.fire({
                title: 'validación',
                text: 'El campo username es requerido',
                icon: 'error'
            })
            return false;
        }
    }


    const correo = document.querySelector('#email');

    if(correo) {
// Define our regular expression.
var validEmail = /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;

    if (validEmail.test(correo.value)) {
        if(correo.value.includes('.com,mx')) {
            return;
        }
    } else {
        Swal.fire({
            title: 'Error',
            text: 'El campo email es Requerido, valida que sea una dirección de correo valida',
            icon: 'error'
        })
        return false;
    }

    }


    // validar email


    const rol_id = document.getElementById('rol_id').value;

    if(rol_id == null || rol_id == 0 || /^\+$/.test(rol_id)) {

        Swal.fire({
            title: 'validación',
            text: 'El campo rol es requerido',
            icon: 'error'
        })
        return false;
    }

    const password = document.getElementById('password').value;

    if(password == null || password == 0 || /^\+$/.test(password)) {

        Swal.fire({
            title: 'validación',
            text: 'El campo password es requerido',
            icon: 'error'
        })
        return false;
    }

    const password_confirmation = document.getElementById('password_confirmation').value;

    if(password_confirmation == null || password_confirmation == 0 || /^\+$/.test(password_confirmation)) {

        Swal.fire({
            title: 'validación',
            text: 'Validar confirmar password',
            icon: 'error'
        })
        return false;
    }

    if(password != password_confirmation) {
        Swal.fire({
            title: 'validación',
            text: 'Las contraseñas no coinciden',
            icon: 'error'
        })
        return false;
    }

    Swal.fire({
        title: 'Usuario',
        text: 'Generando Usuario',
        icon: 'info',
        allowOutsideClick: false,
        allowEscapeKey:false,
        didOpen:()=> {
            Swal.showLoading()
        }
    })

    $('#btn-enviar').prop('disabled', true)
})

const tablaUsuarios = document.querySelector('table');
if(tablaUsuarios) {
    $('#table-usuarios').DataTable({
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

},columnDefs: [
    {
        className: 'dt-center', targets: '_all'
        }
]
    }
    )};

