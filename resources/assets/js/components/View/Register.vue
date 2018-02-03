<template>
    <v-ons-page>
        <v-ons-toolbar>
            <div class="center">Sign up</div>
        </v-ons-toolbar>
        <div class="formarea" >
            <div class="form-row">
                <input type="text" class="text-input--underbar width-full" placeholder="Name" v-model="name" >
            </div>

            <div class="form-row">
                <input type="text" class="text-input--underbar width-full" placeholder="Email" v-model="email">
            </div>

            <div class="form-row">
                <input type="password" class="text-input--underbar width-full" placeholder="Password" v-model="password">
            </div>

            <div class="form-row">
                <input type="password" class="text-input--underbar width-full" placeholder="Confirm Password" v-model="password_confirmation">
            </div>

            <div class="lucent">
                <p class="note">Password - 6 characters or more</p>
            </div>

            <div class="vspc form-row">
                <ons-button v-if="!loading" @click="register"  modifier="large--cta">Sign up</ons-button>
                <ons-button v-else disabled modifier="large--cta"><v-ons-progress-circular indeterminate></v-ons-progress-circular></ons-button>
            </div>
        </div>

    </v-ons-page>
</template>
<style scoped>
    .form-row {
        margin: 4px;
    }

    .width-full {
        width: 100%;
    }

    .width-half {
        width: 48%;
    }

    .lucent {
        opacity: 0.4;
    }

    .note {
        margin: 12px 8px;
        font-size: 13px;
    }

    .vspc {
        margin-top: 20px;
    }

    .formarea {
        width: 90%;
        margin: 50px auto 0px auto;
    }

    input[type=text],
    input[type=email],
    input[type=password] {
        height: 40px;
        padding-top: 10px;
        padding-bottom: 10px;
    }

</style>
<script>

    export default{
        data(){
            return{
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                errors: [],
                userRef: firebase.database().ref('users'),
                loading: false
            }
        },
        computed:{
            hasErrors(){
                var vm = this
                return vm.errors.length > 0
            }
        },
        methods:{
            register(){
                var vm = this
                vm.errors = []
                if(vm.isFormValid){
                    vm.loading = true
                    axios.post('/api/user', {
                        name: vm.name,
                        email: vm.email,
                        password: vm.password,
                        password_confirmation: vm.password_confirmation
                    })
                        .then(function (response) {
                            firebase.auth().createUserWithEmailAndPassword(vm.email, vm.password)
                                .then(function(user){
                                    axios.put(`/api/user/${response.data.id}`, {firebase_uid: user.uid})

                                    user.updateProfile({
                                        displayName: response.data.id,
                                        photoURL: `https://www.gravatar.com/avatar/${md5(user.email)}?d=identicon`,
                                    }).then(function(){
                                        vm.saveUserToUsersRef(user).then(function(){

                                        })
                                    }).catch(function(error){
                                        vm.errors.push(error.message)
                                    })



                                }).catch(function(error) {
                                var errorCode = error.code;
                                vm.errors.push(error.message);
                            });
                        })
                        .catch(function (error) {
                            vm.loading = false
                            console.log(error);
                        });

                }

            },
            saveUserToUsersRef(user ){
                var vm = this
                vm.loading = false
                return vm.userRef.child(user.uid).set({
                    name:user.displayName,
                    display: vm.name,
                    avatar: user.photoURL,
                    uid: user.uid
                })
            },
            isEmpty(){
                var vm = this
                if(vm.name.length ==  0 || vm.email.length == 0 || vm.password.length == 0 || vm.password_confirmation.length == 0){
                    return true
                }
                return false
            },
            passwordValid(){
                var vm = this
                if(vm.password.length < 6 || vm.password_confirmation < 6){
                    return false
                }
                if(vm.password !== vm.password_confirmation){
                    return false
                }
                return true
            },
            isFormValid(){
                var vm = this
                if(vm.isEmpty()){
                    vm.errors.push('Empty Field')
                    return false
                }
                if(!vm.passwordValid){
                    vm.errors.push('password incorrect')
                    return false
                }
                return true
            }
        }
    }
</script>
