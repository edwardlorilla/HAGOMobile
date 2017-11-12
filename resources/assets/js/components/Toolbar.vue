<template>
    <v-ons-toolbar>
        <div class="left">
            <v-ons-toolbar-button @click="changeView">
                <v-ons-icon icon="ion-navicon, material:md-menu"></v-ons-icon>
            </v-ons-toolbar-button>
        </div>
        <div class="center" >
            <span v-if="!isSearch">{{title}}</span>
            <v-ons-search-input style="margin-top: 4px; width: 100%;" v-else :value="my_prop" @input="send($event.target.value)" placeholder="Search something"
                                ></v-ons-search-input>
        </div>
        <div class="right" v-if="search" >
            <v-ons-toolbar-button @click="searchLocal">
                <v-ons-icon icon="ion-search, material: md-search"></v-ons-icon>
            </v-ons-toolbar-button>
        </div>
    </v-ons-toolbar>
</template>
<script>
    import {change_view} from './Ajax/getData'
    export default {
        model: {
            prop: 'my_prop',
            event: 'my_event'
        },
        props: {
            my_prop: {

            },
            title: {
                type: String
            },
            search: Boolean
        },
        data(){
            return{
                isSearch: false
            }
        },
        methods: {
            searchLocal(){
                var vm = this
                vm.isSearch = !vm.isSearch
            },
            changeView(){
                change_view()
            },
            send: function (v) {
                this.$emit('my_event', v)
            }
        }
    }
</script>