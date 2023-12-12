

<template class="home">
  <h2>Home</h2>

  <template v-if="auth.isAuthenticated">
    <button @click="logout">Logout</button>
  </template>
</template>

<script setup lang="ts">
  import {useAuthStore} from '@/stores/AuthStore.js';
  const auth = useAuthStore();

  function logout() {
    auth.clear();
  }
</script>

<style>
@media (min-width: 1024px) {
   .home{
    min-height: 100vh;
    display: flex;
    align-items: center;
  }
}
</style>
