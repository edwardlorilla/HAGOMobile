<template>
    <v-ons-navigator swipeable
                     :page-stack="stack.page"
    ></v-ons-navigator>
</template>
<script>
    import {StackItem} from './../Ajax/getData'
    export default{
        data(){
            return {
                stack: StackItem
            }
        }
    }
</script>