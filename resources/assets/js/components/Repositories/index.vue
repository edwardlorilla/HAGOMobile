<template>
    <component :is="currentView" :items="plantItem.all"></component>
</template>
<style>

</style>
<script>
    import Grid from './grid.vue';
    import List from './lists.vue';
    import {plantItem} from './../Ajax/getData'
    export default{
        components: {
            Grid,
            List
        },
        data(){
            return {
                plantItem,
                currentView: 'grid'
            }
        }
    }
</script>
