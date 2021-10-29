<template>
    <div>
        <span class="like-btn" @click="likeReceta" :class="{ 'like-active' : this.like}"></span>

        <p>{{ cantidadLikes }} Les gusto esta receta</p>
    </div>
</template>


<script>
export default {
    props: ['recetaId', 'like', 'likes'],
    data: function() {
        return {
            totalLikes: this.likes
        }
    },
    // mounted() {
    //     console.log(this.like);
    // },
    methods: {
        likeReceta() {
            axios.post('/recetas/' + this.recetaId)
                  .then(respuesta => {
                      
                      if (respuesta.data.attached.length > 0) {
                          this.$data.totalLikes++;
                      } else {
                          this.$data.totalLikes--;
                      }
                  })
                  .catch(error => {
                      console.log(error)
                  });
            
        }
    },
    computed: {
        cantidadLikes: function() {
            return this.totalLikes
        }
    }
}
</script>