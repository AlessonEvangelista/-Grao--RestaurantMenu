import {computed, ref} from 'vue';
import {defineStore} from 'pinia'
import Http from '@/services/http.js';


export const useAuthStore = defineStore('auth', () => {
    const token = ref(localStorage.getItem('token'));
    const user = ref(localStorage.getItem('user'));

    function setToken(tokenValue) {
        console.log(tokenValue);
        localStorage.setItem('token', tokenValue);
        token.value = tokenValue
    }

    function setUser(userValue) {
        localStorage.setItem('user', JSON.stringify(userValue));
        token.user = userValue
    }

    const isAuthenticated = computed(() => {
        return token.value && user.value;
    });

    function getToken(){
        return 'Bearer ' + token.value;
    }

    async function checkToken() {
        try {
            const tokenAuth = getToken();
            const {data} = await Http.get('auth/v1/verify', {
                headers: {
                    Authorization: tokenAuth
                }
            });
            console.log(data)
            return data.data.data;
        } catch (error) {
            console.log(error.response.data);
        }
    }

    async function clear() {
        try {
            localStorage.removeItem('token');
            localStorage.removeItem('user');
            token.value = '';
            user.value = '';
        } catch (error) {
            console.log(error.response.data);
        }
    }

    return {
        token,
        user,
        setToken, 
        setUser,
        checkToken,
        isAuthenticated,
        clear
    }
})