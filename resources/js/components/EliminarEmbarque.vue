<template>
    <input type="submit" class="btn btn-danger d-block w-100 mb-2" value="Eliminar x" @click="eliminarEmbarque" />
</template>

<script>
export default {
    props: ["embarqueId"],
    methods: {
        eliminarEmbarque() {
            this.$swal({
                title: "¿Deseas eliminar esta importación?",
                text: "Una vez eliminada, la importación no se podrá recuperar",
                icon: "warning",
                showCancelButton: true,
                cancelButtonColor: "#3085d6",
                confirmButtonColor: "#d33",
                confirmButtonText: "Si",
                cancelButtonText: "No",
            }).then((result) => {
                if (result.value) {

                    this.$swal({
                        title: 'Eliminar',
                        text: 'Eliminando Importación',
                        icon: 'info',
                        allowOutsideClick: false,
                        AllowEscapeKey: false,
                        didOpen: () => {
                            this.$swal.showLoading()
                        }
                    })
                    const params = {
                        id: this.recetaId,
                    };
                    // Enviar la petición al servidor
                    axios
                        .post(`/embarques/${this.embarqueId}/eliminar`, {
                            params,
                            _method: "delete",
                        })
                        .then((respuesta) => {
                            this.$swal({
                                title: "Importación Eliminada",
                                text: "Se eliminó la Importación",
                                icon: "success",
                            });

                            // Eliminar embarque del DOM
                            this.$el.parentNode.parentNode.parentNode.removeChild(
                                this.$el.parentNode.parentNode
                            );
                        })
                        .catch((error) => {
                            console.log(error);
                        });
                }
            });
        },
    },
};
</script>
