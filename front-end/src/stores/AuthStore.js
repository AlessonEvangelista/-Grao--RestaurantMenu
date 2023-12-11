import {ref} from 'vue';
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
    function saveUserData(user) {
        const passwd = user.password
    }

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

    async function logoutUser() {
        try {
            const tokenAuth = getToken();
            const userLog = {
                email: user.email,
                password: passwd
            }
            
            const {data} = await Http.post('/auth/v1/logout',userLog, {
                headers: {
                    Authorization: tokenAuth
                }
            });
            console.log(data)
            return data.status == 200 ? true : false;
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
        logoutUser
    }
})