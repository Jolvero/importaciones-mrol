function eliminarUsuario(id) {
    const elemento = document.getElementById(id);
    Swal.fire({
        title: 'Eliminar',
        text: '¿Deseas eliminar el usuario?, una vez eliminado ya no se podrá recuperar',
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
                text: 'Eliminando Usuario',
                icon: 'info',
                allowEscapeKey: false,
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading()
                }
            });
            $.ajax({
                url: `/user/${id}`,
                method: 'DELETE',
                data: {
                    id: id,
                    _token: $('input[name="_token"]').val()
                }
            }).done(function () {
                Swal.fire({
                    title: 'Eliminar',
                    text: 'Usuario eliminado',
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
