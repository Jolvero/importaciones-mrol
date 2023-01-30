<template>
    <input type="hidden" name="" id=""
    >
</template>

<script>
export default {
     props:['alerta'],
     methods: {
         EnviarAlerta() {
             this.$swal({
                 title: 'Alerta',
                 text: 'Uno o mas archivos superan los 10 MB permitidos',
                 icon: 'warning',
                 showCancelButton: true,
                 confirmButtonColor: '#3085d6',
                 cancelButtonColor: '#d33',
                 confirmButtonText: 'ok',
             })
         }
     }
}
</script>
