<template>
        <div id="id01" :style="{ display: showModal}"  class="w3-modal">
            <div class="w3-modal-content" style="max-width: 600px;">
                <div class="w3-container">
                    <span @click="stateModal"
                          v-hotkey="keymap"
                          class="w3-button w3-display-topright">&times;</span>
                    <p>Do you want to delete {{user.name}}?</p>
                    <button @click="deleteUser" class="w3-button w3-block w3-black w3-section w3-padding" style="width:30%">Delete</button>
                </div>
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
        props:['user', 'key'],
        data(){
            return{
                showModal: 'block'
            }
        },
        methods:{
            deleteUser(){
                var vm = this
                //api/user/{user}
                axios.post(`/api/user/${vm.user.id}/${vm.user.firebase_uid}`).then(function(response) {

                    vm.$emit('close')

                    firebase.database().ref(`users/${vm.user.firebase_uid}`).remove().then(function () {
                        console.log('Remove Successfully!')
                    })
                });

            },
            stateModal(){
                var vm = this
                vm.showModal == 'none' ? vm.showModal = 'block' : vm.showModal = 'none'
                vm.$emit('close')
            }
        },
        computed:{
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
