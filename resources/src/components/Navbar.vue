<template>
   <nav class="navbar is-flex is-justify-content-space-between" role="navigation" aria-label="main navigation">
    <p class="mt-2 ml-3 has-text-white is-size-4"><strong>{{ nameUser.name }}</strong></p>
    <div class="buttons mr-4">
          <a class="button has-text-dark" @click="logOut">
            <ion-icon class="mr-2" name="log-out-outline" size="large"></ion-icon>
            <strong>Log out</strong>
          </a>
        </div>
</nav>
</template>
<script>
import {useRouter} from "vue-router";
export default {
    name: "Nabvar",
    setup() {
        const router = useRouter();
        const nameUser = JSON.parse(localStorage.getItem("USER_DATA"));
        const logOut = ()=>{
           localStorage.clear();
           router.push('login');
        }
        return {
            logOut,
            nameUser
        }
    }
  }
</script>
<style scoped>
 .navbar{
    background-color:#EF5350 ;
 }
</style>
