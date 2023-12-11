import { createRouter, createWebHistory } from 'vue-router'
import LoginView from '../views/LoginView.vue'
import {useAuthStore} from '@/stores/AuthStore.js'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: '',
      component: LoginView
    },
    {
      path: '/home',
      name: 'home',
      component: () => import('../views/HomeView.vue'),
      meta: {
        auth:true
      }
    },
    {
      path: '/food',
      name: 'food',
      component: () => import('../views/FoodView.vue'),
      meta: {
        auth:true
      }
    },
    {
      path: '/logout',
      name: 'logout',
      component: () => import('../views/LogoutView.vue'),
      meta: {
        auth:true
      }
    }
  ]
})

router.beforeEach(async (to, from, next) => {
  if (to.meta?.auth) {
    const auth = useAuthStore();
    if( auth.token && auth.user) {
      const isAuthenticated = await auth.checkToken()
      console.log(isAuthenticated);
      if (isAuthenticated) {
        next();
      } else {
        next({name: ''});
      }
    } else {
      next({name: ''})
    }
    console.log(to.name);
  } else {
    next();
  }
})

export default router
