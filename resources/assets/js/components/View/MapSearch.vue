<template>
    <v-ons-search-input
            :value="my_prop"
            @input="send($event.target.value)"
            placeholder="Search something"
            style="width: 70%;"
    >
    </v-ons-search-input>

</template>
<script>
    export default {
        props: [
            'my_prop'
        ],
        model: {
            prop: 'my_prop',
            event: 'my_event'
        },
        data(){
            return {}
        },
        methods: {
            send: function (v) {
                this.$emit('my_event', v)
            }
        }
    }
</script>
