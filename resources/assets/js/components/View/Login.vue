<template>
    <ons-page modifier="full_bg">
        <!--<v-ons-progress-bar v-show="isDisable.state" indeterminate></v-ons-progress-bar>
        <slide-fade>
            <div class="login-form">

                &lt;!&ndash;<input type="email" v-model="loginUser.email" class="text-input&#45;&#45;underbar" placeholder="Email"
                       pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" value="">&ndash;&gt;
                <input type="text" v-model="loginUser.email" class="text-input&#45;&#45;underbar" placeholder="Username"
                       value="">
                <input type="password" v-model="loginUser.password" class="text-input&#45;&#45;underbar" pattern=".{6,}"
                       placeholder="Password" value="">
                <br><br>
                <v-ons-button :disabled="isDisable.state" @click="userLogin" modifier="large" class="login-button">Log In
                </v-ons-button>
                <br><br>
                <v-ons-button modifier="quiet" class="forgot-password">Forgot password?</v-ons-button>

            </div>
        </slide-fade>-->

        <div class="login">
            <div class="login-screen">
                <div class="app-title">
                    <h1>Login</h1>
                </div>

                <div class="login-form">
                    <div class="control-group">
                        <input type="text" class="login-field"  v-model="loginUser.email" value="" placeholder="username" id="login-name">
                        <label class="login-field-icon fui-user" for="login-name"></label>
                    </div>

                    <div class="control-group">
                        <input type="password" v-model="loginUser.password" class="login-field" value="" placeholder="password" id="login-pass">
                        <label class="login-field-icon fui-lock" for="login-pass"></label>
                    </div>

                    <v-ons-button :disabled="isDisable.state" @click="userLogin" modifier="large" class="login-button">Log In
                    </v-ons-button>
                    <v-ons-button modifier="quiet" style="color: #fff;" class="forgot-password">Forgot password?</v-ons-button>
                </div>
            </div>
        </div>
    </ons-page>

</template>
<style scoped>
    img {

    }
    .login {
        margin: 157px auto;
        width: 300px;
    }
    .login-screen {
        /*background-color: #FFF;*/
        /*padding: 20px;*/
        /*border-radius: 5px*/
    }

    .app-title {
        text-align: center;
        color: #777;
    }

    .login-form {
        text-align: center;
    }
    .control-group {
        margin-bottom: 10px;
    }

    input {
        text-align: center;
        background-color: #ECF0F1;
        border: 2px solid transparent;
        border-radius: 3px;
        font-size: 16px;
        font-weight: 200;
        padding: 10px 0;
        width: 250px;
        transition: border .5s;
    }

    input:focus {
        border: 2px solid #3498DB;
        box-shadow: none;
    }

    .btn {
        border: 2px solid transparent;
        background: #3498DB;
        color: #ffffff;
        font-size: 16px;
        line-height: 25px;
        padding: 10px 0;
        text-decoration: none;
        text-shadow: none;
        border-radius: 3px;
        box-shadow: none;
        transition: 0.25s;
        display: block;
        width: 250px;
        margin: 0 auto;
    }

    .btn:hover {
        background-color: #2980B9;
    }

    .login-link {
        font-size: 12px;
        color: #444;
        display: block;
        margin-top: 12px;
    }
</style>
<script>
    import {signin} from './loginMixin'
    export default {
        mixins: [signin]
    }
</script>
