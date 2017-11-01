<template>
        <div class="center">
            <span class="list-item__title">{{search ? search.name : ''}}</span><span
                class="list-item__subtitle">On the Internet</span>
        </div>
</template>
<style>

</style>
<script>
    export default {
        props: ['search'],
        computed: {
            isArray(){
                return _.isArray(this.result)
            },
        }
    }
</script>