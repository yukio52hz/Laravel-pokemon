<template>
     <div style=" display: flex; flex-direction: column;justify-content: center; align-items: center;">
        <img src="../assets/img/loadingPokemon.gif" alt="loader">
        <Loader/>
     </div>
</template>
<script>
import Loader from './Loader.vue';
  export default {
    name: "LoaderPokemon",
    components:{
      Loader
    }

  }
  </script>
