<template>
    <div>
        <Navbar/>
    <div v-if="isLoading">
        <div class="is-flex is-justify-content-center is-align-content-center fullScreen">
            <loader-pokemon/>
        </div>
    </div>
        <div v-else class="container">
            <button class="button mt-5 mb-5 has-text-dark" @click="filterFavorites"><strong>Show favorites</strong></button>

            <div class="columns is-flex-wrap-wrap">
                <div class="column" v-for="pokemon in listPokemonFiltered" :key="pokemon.id">
                <card-pokemon :item="pokemon" @add-To-Favorite="hanledAddFavoritePokemon" />
                </div>
           </div>

           <div class="is-flex is-justify-content-center" v-if="showFavoritesOnly == false">
             <button v-if="loadingPokemons" class="button mt-5 mb-5 has-text-dark" @click="loadMore"><strong>Show more pokemons</strong></button>
             <Loader v-else/>
           </div>
  </div>
    </div>
  </template>

  <script>
  import { ref, onMounted, computed } from 'vue';
  import axios from 'axios';
  import LoaderPokemon from '../components/LoaderPokemon.vue';
  import CardPokemon from '../components/CardPokemon.vue';
  import Navbar from '../components/Navbar.vue'
  import Loader from '../components/Loader.vue';

  export default {
    name: "Home",
    components:{
        LoaderPokemon,
        CardPokemon,
        Navbar,
        Loader

    },
    setup() {

      const isLoading = ref(true);
      const listPokemons = ref([]);
      const listFavorite = ref([]);
      const showFavoritesOnly = ref(false);
      const loadMorePokemons = ref(8);
      const loadingPokemons = ref(true)

      const findByFavorite =(id)=> {
      let pokemmonFavorite = listFavorite.value.find((pokemon) => pokemon.pokemon_id === id);
       return pokemmonFavorite ? true : false
      };

      const newArrayTypes = (array)=>{
        const newArrayType = []

        array.map((types)=>(
            newArrayType.push({name:types.type.name,img:`${import.meta.env.VITE_APP_HOST}/img/${types.type.name}.svg`})
        ))
        return newArrayType;
      };
      const getAllPokemon = async () => {
        try {
          const response = await axios.get(`https://pokeapi.co/api/v2/pokemon/?limit=${loadMorePokemons.value}`);
          const data = response.data;
          const allDataPokemons = [];
          const pokeUrls = data.results.map(item => item.url);
          for (const url of pokeUrls) {
            const response = await axios.get(url);
            const allpokemon = response.data;
            allDataPokemons.push(allpokemon);
          }
          listPokemons.value = allDataPokemons.map((pokemon) => ({
            id : pokemon.id,
            name: pokemon.name,
            image : `https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/${pokemon.id}.png`,
            types : newArrayTypes(pokemon.types),
            height: pokemon.height,
            weight: pokemon.weight,
            numberPokedex: pokemon.id > 9 ? `#00${pokemon.id}` : `#000${pokemon.id}`,
            favorite: findByFavorite(pokemon.id),
          }))
          loadingPokemons.value = true;
          isLoading.value = false
        } catch (error) {
          console.error('Error fetching data:', error);
        }
      };
      const hanledAddFavoritePokemon = async(catchPokemon)=>{
            try {
                await axios.post(`/api/add-to-favorites/${catchPokemon.id}`,{headers: {
                Authorization: `Bearer ${localStorage.getItem('USER_TOKEN')}`,
          },});
                const updatedList = listPokemons.value.map((pokemon) => {
                if (pokemon.id === catchPokemon.id) {
                    return { ...pokemon, favorite: !pokemon.favorite };
                }
                return pokemon;
                });
               listPokemons.value = updatedList;
            } catch (error) {
                console.error(error);
            }
      }
      const getListFavorite = async ()=>{
        try {
          const response = await axios.get('/api/list-favorites-pokemon',{
            headers: {
                Authorization: `Bearer ${localStorage.getItem('USER_TOKEN')}`,
          }
          });
          listFavorite.value = response.data;
        } catch (error) {
          console.error('Error fetching data:', error);
        }
      }
      const filterFavorites = () => {
       showFavoritesOnly.value = !showFavoritesOnly.value;
      };
      const listPokemonFiltered = computed(() => {
        if (showFavoritesOnly.value) {
        return listPokemons.value.filter((pokemon) => pokemon.favorite);
        } else {
        return listPokemons.value;
        }
      });
      const loadMore = () => {
        loadMorePokemons.value += 4;
        getAllPokemon();
        loadingPokemons.value = false;
      };
      onMounted(() => {
        getListFavorite();
        getAllPokemon();
      });

      return {
        listPokemons,
        isLoading,
        hanledAddFavoritePokemon,
        filterFavorites,
        listPokemonFiltered,
        loadMore,
        loadingPokemons,
        showFavoritesOnly
      };
    }
  }
  </script>

<style scoped>
.fullScreen{
 height: 100vh;
}
</style>
