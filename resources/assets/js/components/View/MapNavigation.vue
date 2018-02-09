<template>
    <v-ons-navigator swipeable
                     :page-stack="navigationMap.stack"
    ></v-ons-navigator>
</template>
<script>
    import {navigationMap} from './../Ajax/getData'
    export default{
        data(){
            return {
                navigationMap
            }
        }
    }
</script>