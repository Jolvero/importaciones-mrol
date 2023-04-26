$('#formulario-clientes').on('submit', function validarFormulario() {
    const cliente = document.getElementById('cliente').value;

    if(cliente == null || cliente == 0 || /^\+$/.test(cliente)) {
        Swal.fire({
            title: 'validación',
            text: 'El campo cliente es requerido',
            icon: 'error'
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

const tablaClientes = document.querySelector('table');
if(tablaClientes) {
    $('#table-clientes').DataTable({
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

    function eliminarCliente(id) {
        const cliente = document.getElementById(id);

        Swal.fire({
            title: 'Eliminar',
            text: '¿Deseas eliminar el cliente?, una vez eliminado ya no se podrá recuperar',
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            cancelButtonColor: '#605f5f',
            confirmButtonText: 'Si',
            confirmButtonColor: '#722f37',
            icon: 'warning',
            allowEscapeKey: false,
            allowOutsideClick: false
        }).then((result)=> {
            if(result.value) {
                Swal.fire({
                    title: 'Eliminar',
                    text: 'Eliminando Cliente',
                    icon: 'info',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    didOpen:()=> {
                        Swal.showLoading()
                    }
                });

                $.ajax({
                    url: `/clientes/eliminar/${id}`,
                    method: 'DELETE',
                    data:{
                        id: id,
                        _token: $('input[name="_token"]').val()
                    }
                }).done(function() {
                    Swal.fire({
                        title: 'Eliminar',
                        text: 'Cliente eliminado',
                        icon: 'success',
                        allowEscapeKey: false,
                        allowOutsideClick: false
                    })
                })

                cliente.parentElement.parentElement.parentElement.remove()
            $('.child').remove();
            }
        })
    }





