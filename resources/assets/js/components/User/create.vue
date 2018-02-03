<template>
    <div id="id01"  :style="{ display: showModal}" class="w3-modal">
        <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">

            <div class="w3-center"><br>
                <span v-hotkey="keymap"
                      @click="stateModal"
                      class="w3-button w3-xlarge w3-transparent w3-display-topright" title="Close Modal">&times;</span>
                <i class="fa fa-user-circle-o fa-6 w3-xxlarge" aria-hidden="true"></i>
                <!--<img src="img_avatar4.png" alt="Avatar" style="width:30%" class="w3-circle w3-margin-top">-->
            </div>

            <form class="w3-container">
                <div class="w3-section">
                    <label>Name</label>
                    <input class="w3-input w3-border w3-margin-bottom"
                           type="text"
                           v-model="name"
                           placeholder="Enter Name"
                           name="Name"
                           required>
                    <label><b>Email</b></label>
                    <input class="w3-input w3-border"
                           v-model="email"
                           type="email"
                           placeholder="Enter Email"
                           name="email"
                           required>
                    <label><b>Password</b></label>
                    <input class="w3-input w3-border"
                           v-model="password"
                           type="password"
                           placeholder="Enter Password"
                           name="psw"
                           required>
                    <label><b>Confirm Password</b></label>
                    <input class="w3-input w3-border"
                           v-model="password_confirmation"
                           type="password"
                           placeholder="Enter Password"
                           name="psw"
                           required>
                    <ons-button v-if="!loading"
                                @click="register"
                                class="w3-button w3-block w3-green w3-section w3-padding"
                                modifier="large--cta">Add User</ons-button>
                    <ons-button v-else disabled modifier="large--cta"><v-ons-progress-circular indeterminate></v-ons-progress-circular></ons-button>

                </div>
            </form>

            <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
                <button  @click="stateModal" type="button"
                        class="w3-button w3-red">Cancel
                </button>
            </div>

        </div>
    </div>

</template>
<script>
    export default{
        data(){
            return{
                showModal: 'block',
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                errors: [],
                userRef: firebase.database().ref('users'),
                loading: false
            }
        },
        mounted(){

        },
        computed:{
            hasErrors(){
                var vm = this
                return vm.errors.length > 0
            },
            keymap () {
                var vm = this
                return {
                    // bind to hotkey
                    'esc': vm.stateModal
                }
            }
        },
        methods:{
            stateModal(){
                var vm = this
                vm.showModal == 'none' ? vm.showModal = 'block' : vm.showModal = 'none'
                vm.$emit('close')
            },
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
                            registerFirebase.auth().createUserWithEmailAndPassword(vm.email, vm.password)
                                .then(function(user){
                                    axios.put(`/api/user/${response.data.id}`, {firebase_uid: user.uid})

                                    user.updateProfile({
                                        displayName: response.data.id,
                                        photoURL: `https://www.gravatar.com/avatar/${md5(user.email)}?d=identicon`,
                                    }).then(function(){
                                        vm.$emit('closeModal')
                                        vm.saveUserToUsersRef(user).then(function(){
                                            registerFirebase.auth().signOut();
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
