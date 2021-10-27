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
            console.log('diste click', this.recetaId);
        }
    },
    
}
</script>