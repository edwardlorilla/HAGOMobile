<template>
    <v-ons-navigator v-if="stack" swipeable
                     options.animation="slide"
                     :page-stack="stack.page"
    ></v-ons-navigator>
</template>
<script>
    import {Stack} from './../Ajax/getData'
    export default{
        data(){
            return {
                stack: Stack
            }
        }
    }
</script>