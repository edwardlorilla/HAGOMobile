<template>
    <v-ons-toolbar  :modifier="modifier">
        <div class="left">
            <v-ons-toolbar-button @click="changeView">
                <v-ons-icon icon="ion-navicon, material:md-menu"></v-ons-icon>
            </v-ons-toolbar-button>
            <v-ons-toolbar-button @click="isNearestMarkerSort"  >
                <v-ons-icon :style="{'color': nearest.marker ? 'red' : ''}" icon="fa-map-marker"></v-ons-icon>
            </v-ons-toolbar-button>
        </div>
        <div class="center" >
            <span v-if="!isSearch">{{title}}</span>
            <v-ons-search-input style="margin-top: 4px; width: 100%;" v-else :value="my_prop" @input="send($event.target.value)" placeholder="Search something"
                                ></v-ons-search-input>
        </div>
        <div class="right"  >
            <v-ons-toolbar-button v-if="search" @click="searchLocal">
                <v-ons-icon icon="ion-search, material: md-search"></v-ons-icon>
            </v-ons-toolbar-button>
            <v-ons-toolbar-button @click="grid" v-if="grid" >
                <v-ons-icon :icon="isGrid.view ? 'ion-grid, material: md-apps' : 'ion-ios-list-outline, material: md-format-list-bulleted'"></v-ons-icon>
            </v-ons-toolbar-button>

        </div>
    </v-ons-toolbar>
</template>
<script>
    import {change_view, listView,isNearestMarkerSort, nearest} from './Ajax/getData'
    export default {
        model: {
            prop: 'my_prop',
            event: 'my_event'
        },
        props: {
            modifier:{
                default: true
            },
            my_prop: {

            },
            title: {
                type: String
            },
            search: Boolean,
            grid: Function,
        },
        data(){
            return{
                nearest,
                isSearch: false,
                isGrid: listView
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
            },
            isNearestMarkerSort(){
                isNearestMarkerSort()
            }
        }
    }
</script>