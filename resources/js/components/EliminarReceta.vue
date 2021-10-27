<template>
   <input 
     type="submit" 
     class="btn btn-danger d-block w-100 mb-2" 
     value="Eliminar ×"
     v-on:click="eliminarReceta"
     >
</template>

<script>
export default {
    props: ['recetaId'],
    // mounted() {
    //     console.log('receta actual', this.recetaId)
    // },
    methods: {
        eliminarReceta() {
            // console.log('diste click', this.recetaId);
            this.$swal({
            title: '¿Deseas eliminar esta receta?',
            text: "Una vez eliminada no se puede recuperar",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si!',
            cancelButtonText: 'No'
           }).then((result) => {
              if (result.isConfirmed) {

                  //ENVIAR LA PETICION AL SERVIDOR
              this.$swal({
                  title: 'Receta eliminada',
                  text: 'se elimino la receta',
                  icon: 'success'


              })
          }
        })
      }
    }
    
}
</script>