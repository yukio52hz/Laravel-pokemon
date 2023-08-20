<template>
    <div class="section">
      <div class="container">
        <div class="columns is-centered">
          <div class="column is-4">
            <form class="box" method="post" @submit.prevent="handleLogin">
              <div class="content">
                <div class="title">Log In</div>
                <div class="subtitle">Log in to your account</div>
                <ul class="list-disc text-red-400" v-for="(value, index) in errors" :key="index" v-if="typeof errors === 'object'">
                <li>{{value[0]}}</li>
            </ul>
              </div>
              <div class="field">
                <label class="label">
                  Email
                </label>
                <div class="control">
                  <input class="input" type="text"
                    v-model="form.email" />
                </div>
                <!-- <p class="help is-success">
                  This email is available.
                </p> -->
              </div>
              <div class="field">
                <label class="label">
                  Password
                </label>
                <div class="control">
                  <input class="input" type="password"  id="password"
                   v-model="form.password" />
                </div>
                <!-- <p class="help is-danger">
                  This password is too weak.
                </p> -->
              </div>
              <button type="submit" class="button is-info is-fullwidth">
                    Login
                  </button>
              <div class="has-text-centered mt-4">
                <router-link to="register">
                    Sign Up
                  </router-link>
              </div>
            </form>

          </div>
        </div>

       <div class="is-flex is-justify-content-flex-end">
         <img src="https://assets.pokemon.com/static2/_ui/img/account/pokemon-login.png" alt="">
       </div>
      </div>
    </div>
</template>
<style scoped>

</style>
<script>
import { onMounted, reactive, ref } from 'vue';
import axios from 'axios';
import {useRouter} from "vue-router";
export default {
    name:"Login",
    setup() {
        const errors = ref()
        const router = useRouter();
        const form = reactive({
            email: '',
            password: '',
        })
        const handleLogin = async () => {
            try {
                const result = await axios.post('/api/auth/login', form)
                if (result.status === 200 && result.data && result.data.token) {
                    localStorage.setItem('USER_TOKEN', result.data.token)
                    localStorage.setItem("USER_DATA",JSON.stringify(result.data.user))
                    await router.push('home')
                }
            } catch (e) {
                if(e && e.response.data && e.response.data.errors) {
                    errors.value = Object.values(e.response.data.errors)
                } else {
                    errors.value = e.response.data.message || ""
                }
            }
        }
        onMounted(() => {
        localStorage.clear()
      });
        return {
            form,
            errors,
            handleLogin,
        }
    }
}
</script>
