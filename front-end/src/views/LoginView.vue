<script setup lang="ts">
import Http from '@/services/http.js';
import {reactive} from 'vue';
import {useAuthStore} from '@/stores/AuthStore.js';
import router from '@/router';


const auth = useAuthStore();

const user = reactive({
    email: 'fred@graodireto.com.br',
    password: '123Fred'
})
    
    async function login() {
        try {
            const {data} = await Http.post('/auth/v1/login',user)
            auth.setToken(data.data.token);
            auth.setUser(data.data.user);
            auth.saveUserData(user)

          router.push({ path: '/home'})
        } catch (error) {
            
        }
    }
</script>


<template>
<form @submit.prevent="login">
    <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email</label>
    <input v-model="user.email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input v-model="user.password" type="password" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</template>@/stores/AuthStore.js