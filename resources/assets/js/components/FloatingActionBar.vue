<template>
    <v-ons-fab
            position="bottom center"
            :style="{ backgroundColor: $ons.platform.isIOS() ? '#4282cc' : null }"
            :visible="fabVisible"
            @click="capturePhoto"
    >
        <v-ons-icon style="position: absolute;left:0; right: 0; top: 0px;" @click="buttonFile" icon="md-camera"></v-ons-icon>

            <input ref="fileInput" id="file-input" style="display:none;" @change="capturePhoto" class="FileUpload" type="file" name="image"
                   accept="image/*" capture="camera"/>

    </v-ons-fab>
</template>
<style>




</style>
<script>
    import {Splice, Push, cameraInfo, capturePhoto} from './Ajax/getData'
    export default {
        data(){
            return{
                fabVisible: true
            }
        },
        mounted(){

        },
        methods:{
            buttonFile(){
                var vm = this
                vm.$refs.fileInput.click()
            },
            capturePhoto(event){
                cameraInfo(event)
                if(this.$refs.fileInput.value ){
                    Splice()
                    Push('capture-photo')
                }

            }
        }
    }



</script>