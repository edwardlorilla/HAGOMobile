<template>
    <v-ons-fab
            position="bottom center"
            :style="{ backgroundColor: $ons.platform.isIOS() ? '#4282cc' : null }"
            :visible="fabVisible"
            @click="capturePhoto"
    >
        <v-ons-icon style="position: absolute;left:0; right: 0; top: 0px;" icon="md-camera"></v-ons-icon>

            <input ref="fileInput" id="file-input" @change="capturePhoto" class="FileUpload" type="file" name="image"
                   accept="image/*" capture="camera"/>

    </v-ons-fab>
</template>
<style>
.FileUpload {
    opacity: 0;
    position: relative;
    z-index: 1;
    padding: 50px;
}



</style>
<script>
    import {Push, cameraInfo, capturePhoto} from './Ajax/getData'
    export default {
        data(){
            return{
                fabVisible: true
            }
        },
        mounted(){

        },
        methods:{
            capturePhoto(event){
                cameraInfo(event)
                if(this.$refs.fileInput.value ){
                    Push('capture-photo')
                }

            }
        }
    }



</script>