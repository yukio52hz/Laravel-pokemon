<template>
    <div class="columns">
        <div class="column">
            <div class="card shadow-lg" :class="item.types[0].name">
                        <div class="card-image">
                            <figure class="image cover-image is-overflow-hidden">
                                <img :src="item.image" :alt="item.name">
                                <span class="is-size-6 p-1 px-3 has-background-grey-darker
                                 has-text-white is-absolute is-tr-1 is-rounded"  @click="$emit('addToFavorite', item)">
                                 <ion-icon v-if="item.favorite" class="has-text-danger is-size-5"  name="heart"></ion-icon>
                                 <ion-icon v-else class="is-size-5" name="heart-outline" ></ion-icon>
                                </span>
                                <span class="ml-5">{{ item.numberPokedex }}</span>
                            </figure>
                        </div>
                        <div class="card-content">
                            <div class="content has-text-grey-light">
                                <h3>{{ item.name }}</h3>
                                <div class="is-flex is-justify-content-center">
                                    <div  v-for="(element,index ) in item.types" :key="index">
                                        <figure class="image is-32x32">
                                            <img  class="is-rounded" :src="element.img" :alt="element.name" :class="element.name" />
                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</template>
<script>
  export default {
    props: {
    item: Object,
    },
    name: "CardPokemon",
    setup() {
    const getImageUrl=()=> {
      return `../assets/img/typesIcon/dark.svg`;
    }
     return {
        getImageUrl
     }
    }
  }
</script>
<style lang="css" scoped>
.card{
    width: 270px;
}
.shadow-lg {
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05) !important;
}

.is-tr-1 {
    top: 1rem;
    right: 1rem;
}

.is-rounded {
    border-radius: 0.375rem;
}

.is-absolute {
    position: absolute;
    cursor: pointer;
}
.card:hover .cover-image img {
    transform: scale(1.2);
    -webkit-transform: scale(1.2);
}
.cover-image {
    max-height: 330px;
    border-top-left-radius: 3px;
    border-top-right-radius: 3px;
}

.cover-image img {
    transition: transform 1s, filter 2s ease-in-out;
    -webkit-transition: transform 1s, filter 2s ease-in-out;
    transform: scale(1.1);
    -webkit-transform: scale(1.1);
}
.normal, #normal {
  background-color: #bfb16e;
}

.fighting, #fighting {
  background-color: #cf5c35;
}

.flying, #flying {
  background-color: #bea0c2;
}

.poison, #poison {
  background-color: #b96889;
}

.ground, #ground {
  background-color: #e6c163;
}

.rock, #rock {
  background-color: #c9ab40;
}

.bug, #bug {
  background-color: #bebb30;
}

.ghost, #ghost {
  background-color: #987984;
}

.steel, #steel {
  background-color: #cabbac;
}

.fire, #fire {
  background-color: #f2953b;
}

.water, #water {
  background-color: #92a0c2;
}

.grass, #grass {
  background-color: #9dc652;
}

.electric, #electric {
  background-color: #f7cd3b;
}

.psychic, #psychic {
  background-color: #f77979;
}

.ice, #ice {
  background-color: #b4d2b1;
}

.dragon, #dragon {
  background-color: #a172bf;
}

.dark, #dark {
  background-color: #98794c;
}

.fairy, #fairy {
  background-color: #f0a692;
}

.unknown, #unknown {
  background-color: rgba(255, 202, 142, 0.7);
}

.shadow, #shadow {
  background-color: rgba(42, 78, 141, 0.7);
}
</style>
