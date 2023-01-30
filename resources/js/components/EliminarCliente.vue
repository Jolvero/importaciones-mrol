<template>
    <input type="submit" class="btn btn-danger d-block my-2 mx-2 mb-2 float-right" value="Eliminar x"
    @click="eliminarCliente" />
</template>

<script>
export default {
    props: ['clienteId'],
    methods: {
        eliminarCliente() {
            this.$swal({
                title: "¿Deseas eliminar el Cliente?",
                text: "Una vez eliminado, el Cliente no se podrá recuperar",
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
                text: 'Eliminando Cliente',
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
            axios.post(`/clientes/eliminar/${this.clienteId}`, {
                params,
                _method: "delete",
            })
            .then((respuesta)=> {
                this.$swal({
                title: "Cliente Eliminado",
                text: "Se eliminó el Cliente",
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
