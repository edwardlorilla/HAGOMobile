<template>
    <div id="id01" :style="{ display: showModal}" class="w3-modal">
        <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">

            <div class="w3-center"><br>
                <span @click="stateModal"
                      v-hotkey="keymap"
                      class="w3-button w3-xlarge w3-transparent w3-display-topright" title="Close Modal">&times;</span>
                <i class="fa fa-user-circle-o fa-6 w3-jumbo" aria-hidden="true"></i>
                <!--<img src="img_avatar4.png" alt="Avatar" style="width:30%" class="w3-circle w3-margin-top">-->
            </div>

            <form class="w3-container">
                <div class="w3-section">
                    <label>Name</label>
                    <input class="w3-input w3-border w3-margin-bottom"
                           type="text"
                           v-model="user.name"
                           placeholder="Enter Name"
                           name="Name"
                           required>
                    <label><b>Email</b></label>
                    <input class="w3-input w3-border"
                           v-model="user.email"
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
                                @click="updateUser"
                                class="w3-button w3-block w3-teal w3-section w3-padding"
                                modifier="large--cta">Update User
                    </ons-button>
                    <ons-button v-else disabled modifier="large--cta">
                        <v-ons-progress-circular indeterminate></v-ons-progress-circular>
                    </ons-button>

                </div>
            </form>

            <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
                <button @click="stateModal" type="button"
                        class="w3-button w3-red">Cancel
                </button>
            </div>

        </div>
    </div>
</template>
<style>
</style>
<script>
    import {updateUser} from './../Ajax/getData'
    export default{
        props: ['user'],
        data(){
            return {
                cloneUser: _.clone(this.user),
                password: '',
                password_confirmation: '',
                errors: [],
                loading: false,
                showModal: 'block'
            }
        },
        methods: {
            stateModal(){
                var vm = this
                vm.showModal == 'none' ? vm.showModal = 'block' : vm.showModal = 'none'
                if(vm.checkEdit){
                    console.log('wew')
                    vm.$emit('close')
                }else{
                    vm.$emit('close', vm.cloneUser)
                }
            },
            updateUser(link){
                var vm = this
                /*firebase.database().ref(`users/${btoa(link.url)}`).update(link).then(function(){
                 console.log('update Successfully!')
                 })*/
                //api/user/{user}
               // updateUser(vm.user)
                axios.put(`api/user/${vm.user.id}/update`, vm.user).then(function () {

                })
                vm.$emit('close', vm.user)
            },
        },
        computed: {
            checkEdit(){
              var vm = this;
               return  _.isEqual(vm.cloneUser, vm.user);
            },
            keymap () {
                var vm = this
                return {
                    // bind to hotkey
                    'esc': vm.stateModal
                }
            }
        }
    }
</script>
