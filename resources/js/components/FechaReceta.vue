<template>
    <span v-text="formatearFecha">
        
    </span>
</template>

<script>
export default {
    props: ['fecha'],
    
//  mounted() {
//      console.log('la fecha es ', this.fecha);
//  },
 computed: {
     formatearFecha() {
         return moment(this.fecha).locale('es').format('DD MMMM YYYY')

     }
 }
}
</script>