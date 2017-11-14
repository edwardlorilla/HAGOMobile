<template>
    <v-ons-fab
            position="bottom center"
            :style="{ backgroundColor: $ons.platform.isIOS() ? '#4282cc' : null }"
            :visible="fabVisible"
            @click="capturePhoto"
    >

        <v-ons-icon icon="md-camera"></v-ons-icon>
    </v-ons-fab>
</template>
<script>
    import {Push} from './Ajax/getData'
    export default {
        data(){
            return{
                fabVisible: true
            }
        },
        methods:{
            capturePhoto(){
                Push('capture-photo')
            }
        }
    }
</script>