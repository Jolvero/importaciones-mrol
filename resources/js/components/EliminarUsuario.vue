<template>
    <input type="submit" class="btn btn-danger d-block my-2 mx-2 mb-2 float-right" value="Eliminar X"
    @click="eliminarUsuario" />
</template>

<script>
export default {
    props: ['usuarioId'],
    methods: {
        eliminarUsuario() {
            this.$swal({
                title: "¿Deseas eliminar el usuario?",
                text: "Una vez eliminado, el usuario no se podrá recuperar",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si",
                cancelButtonText: "No",
            }).then((result)=> {
                if(result.value) {

                    this.$swal({
                title: 'Eliminar',
                text: 'Eliminando Usuario',
                icon: 'info',
                allowOutsideClick: false,
                AllowEscapeKey: false,
                didOpen:()=>{
                    this.$swal.showLoading()
                }
            })
            const params = {
                id:this.clienteId
            };

            // Enviar petición servidor
            axios.post(`/user/${this.usuarioId}`, {
                params,
                _method: "delete",
            })
            .then((respuesta)=> {
                this.$swal({
                title: "Usuario Eliminado",
                text: "Se eliminó el usuario",
                icon: "success",
              });

              // eliminar del DOM
              this.$el.parentNode.parentNode.parentNode.removeChild(
                this.$el.parentNode.parentNode
              );
            })
            .catch((error)=> {
                console.log(error);
            })
                }
            })
        }
    }
}
</script>
