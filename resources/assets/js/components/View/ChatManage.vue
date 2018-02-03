<template>
    <v-ons-navigator v-if="Chat" swipeable
                     options.animation="slide"
                     :page-stack="Chat.page"
    ></v-ons-navigator>
</template>
<script>
    import {Chat} from './../Ajax/getData'
    export default{
        data(){
            return {
                Chat
            }
        }
    }
</script>