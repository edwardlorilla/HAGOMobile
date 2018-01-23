<template>
    <ons-page>
        <ons-toolbar>
            <div class="center">Log In</div>
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
    import {signin} from './loginMixin'
    export default {
        mixins: [signin]
    }
</script>
