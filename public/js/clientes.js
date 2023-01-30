$('#formulario-clientes').on('submit', function validarFormulario() {
    const cliente = document.getElementById('cliente').value;

    if(cliente == null || cliente == 0 || /^\+$/.test(cliente)) {
        Swal.fire({
            title: 'validación',
            text: 'El campo cliente es requerido'
        })
        return false;
    }

    $('#crear-cliente').prop('disabled', true)

    Swal.fire({
        title: 'Cliente',
        text: 'Generando Cliente',
        icon: 'info',
        allowOutsideClick: false,
        allowEscapeKey: false,
        didOpen:()=> {
            Swal.showLoading()
        }
    })
})

