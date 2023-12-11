<script setup lang="ts">
import router from '@/router';
import {useAuthStore} from '@/stores/AuthStore.js';

const auth = useAuthStore();

if(auth.logoutUser()) { 
  router.push('')
}

</script>

<style>
</style>
