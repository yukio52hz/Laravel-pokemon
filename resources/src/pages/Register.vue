<template>
   <div class="section">
      <div class="container">
        <div class="columns is-centered">
          <div class="column is-4">
            <form class="box" method="post" @submit.prevent="handleSubmit">
              <div class="content">
                <div class="title"> Sign Up</div>
                <div class="subtitle">Create your account</div>
                <ul class="list-disc text-red-400" v-for="(value, index) in errors" :key="index">
                <li>{{value[0]}}</li>
            </ul>
              </div>
              <div class="field">
                <label class="label">
                  Name
                </label>
                <div class="control">
                  <input class="input"  type="text"
                    v-model="form.name" />
                </div>
                <!-- <p class="help is-success">
                  This email is available.
                </p> -->
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
                    Create
                  </button>
              <div class="has-text-centered mt-4">
                <router-link to="/">
                   Back to
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
<script>
import {reactive, ref} from 'vue';
import axios from 'axios';
import {useRouter} from "vue-router";

export default {
    name:"Register",
    setup() {
        const errors = ref();
        let router = useRouter();
        const form = reactive({
            name: '',
            email: '',
            password: '',
        })
        const handleSubmit = async(evt) => {
            evt.preventDefault()
            try {
                const result = await axios.post('/api/auth/register', form);
                if (result.status === 200 && result.data && result.data.token) {
                    localStorage.setItem('USER_TOKEN', result.data.token)
                    localStorage.setItem("USER_DATA",result.data.user)
                    await router.push('home')
                }
            }catch (e) {
                if(e.response.data && e.response.data.errors) {
                    errors.value = Object.values(e.response.data.errors)
                }
            }
        }
        return {
            form,
            errors,
            handleSubmit,
        }
    }
}
</script>
