<template>
    <ons-page>
        <ons-toolbar>
            <div class="center">Log In</div>
            <!--<div class="right"><v-ons-toolbar-button @click="changeAuth" >Close</v-ons-toolbar-button></div>-->
        </ons-toolbar>
        <v-ons-progress-bar v-show="isDisable.state" indeterminate></v-ons-progress-bar>
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

    </ons-page>

</template>
<script>
import {isDisable, changeDisable, toggleAuth} from './../Ajax/getData'
export default{
    data(){
        return {
            isDisable,
            loginUser: {
                email: '',
                password: '',
            },
            isLoading: false,
            errors: []
        }
    },
    mounted(){
        console.log('123qwe')
    },
    methods: {
        isFormValid(){
            var vm = this
            return !!(vm.loginUser.email.length > 0 && vm.loginUser.password.length > 0);

        },
        userLogin(){
            var vm = this

            if (vm.isFormValid()) {
                changeDisable(true)
                vm.errors = []
                firebase.auth().signInWithEmailAndPassword(vm.loginUser.email, vm.loginUser.password).then(function (user) {
                    changeDisable(false)
                    vm.$router.push('/')
                }).catch(function (error) {
                    changeDisable(false)
                    vm.errors.push(error.message)
                })
            }
            /* var vm = this
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
               });*/

        }
    }
}




</script>
