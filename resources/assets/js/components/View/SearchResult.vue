<template>
        <div class="center">
            <span class="list-item__title">{{search ? search.title : ''}}</span><span
                class="list-item__subtitle"></span>
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