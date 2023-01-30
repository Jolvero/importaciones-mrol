$('#rol_id').on('change', function validarRolCliente() {
    if($('#rol_id option:selected').text() == 'cliente') {
        $.get('/clientes/all', function (data) {
            var option = '';
                var select = '<select name="cliente_id" class="form-control"id="cliente_id" name="cliente_id"></select>';
                var formGroup = '<div class="form-group form-clientes" <label>Cliente</label></div>';

                $('#cliente').addClass('col-md-6', 'cliente-select');
                $('#cliente').append(formGroup);
                $('.form-clientes').append(select)

                for(let i = 0; i< data.length; ++i) {
                    option+= `<option value= ${data[i].id}>${data[i].cliente}</option>`
                }
                $('#cliente_id').append(option)

        })

    }
})

$('#form-usuario').on('submit', function () {
    const nombre = document.getElementById('nombre').value;

    if(nombre == null || nombre == 0 || /^\+$/.test(nombre)) {

        Swal.fire({
            title: 'validación',
            text: 'El campo nombre es requerido'
        })
        return false;
    }

    const username = document.getElementById('username').value;

    if(username == null || username == 0 || /^\+$/.test(username)) {

        Swal.fire({
            title: 'validación',
            text: 'El campo username es requerido'
        })
        return false;
    }

    const email = document.getElementById('email').value;

    if(email == null || email == 0 || /^\+$/.test(email)) {

        Swal.fire({
            title: 'validación',
            text: 'El campo email es requerido'
        })
        return false;
    }

    const rol_id = document.getElementById('rol_id').value;

    if(rol_id == null || rol_id == 0 || /^\+$/.test(rol_id)) {

        Swal.fire({
            title: 'validación',
            text: 'El campo rol es requerido'
        })
        return false;
    }

    const password = document.getElementById('password').value;

    if(password == null || password == 0 || /^\+$/.test(password)) {

        Swal.fire({
            title: 'validación',
            text: 'El campo password es requerido'
        })
        return false;
    }

    const password_confirmation = document.getElementById('password_confirmation').value;

    if(password_confirmation == null || password_confirmation == 0 || /^\+$/.test(password_confirmation)) {

        Swal.fire({
            title: 'validación',
            text: 'Validar confirmar password'
        })
        return false;
    }

    if(password != password_confirmation) {
        Swal.fire({
            title: 'validación',
            text: 'Las contraseñas no coinciden'
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
