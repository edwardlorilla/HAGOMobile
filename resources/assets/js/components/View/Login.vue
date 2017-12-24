<template>
    <div class="login-form">

        <input type="email" v-model="loginUser.email" class="text-input--underbar" placeholder="Email"
               pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" value="">
        <input type="password" v-model="loginUser.password" class="text-input--underbar" pattern=".{6,}"
               placeholder="Password" value="">
        <br><br>
        <v-ons-button :disabled="isDisable.state" @click="userLogin" modifier="large" class="login-button">Log In
        </v-ons-button>
        <br><br>
        <v-ons-button modifier="quiet" class="forgot-password">Forgot password?</v-ons-button>
    </div>
</template>
<script>
import {isDisable, changeDisable, toggleAuth} from './../Ajax/getData'
export default{
    data(){
        return{
            isDisable,
            loginUser:{
                email: '',
                password: '',
            }
        }
    },
    methods:{
        userLogin(){
            var vm = this
             changeDisable(true)
           axios.post('/login', vm.loginUser)
              .then(function (response) {
                console.log(response);
                changeDisable(false)
                toggleAuth()
              })
              .catch(function (error) {
                console.log(error);
                 changeDisable(false)
              });
        }
    }
}



</script>
