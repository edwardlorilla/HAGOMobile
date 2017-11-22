<template>
    <v-ons-navigator swipeable
                     :page-stack="StackItem.page"
    ></v-ons-navigator>
</template>
<script>
    import {StackItem} from './../Ajax/getData'
    export default{
        data(){
            return {
                StackItem
            }
        }
    }
</script>