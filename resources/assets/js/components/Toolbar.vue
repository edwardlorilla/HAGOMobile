<template>
    <v-ons-toolbar  modifier>
        <div class="left">
            <v-ons-toolbar-button v-if="onHold.handler && mySighting.marker === 0" @click="onHoldHandler">
                <v-ons-icon icon="ion-android-arrow-back"></v-ons-icon>

            </v-ons-toolbar-button>
            <v-ons-toolbar-button v-else @click="changeView">
                <v-ons-icon icon="ion-navicon, material:md-menu"></v-ons-icon>
            </v-ons-toolbar-button>
            <!--v-ons-toolbar-button v-if="!isSearch" @click="isNearestMarkerSort"  >
                <v-ons-icon :style="{'color': nearest.marker ? 'red' : ''}" icon="fa-street-view"></v-ons-icon>
            </v-ons-toolbar-button>-->
        </div>
        <div class="center" >
            <div v-if="onHold.handler && mySighting.marker === 0" >{{selectCount.length}} selected</div>
            <div v-else>
                <span v-if="!isSearch">{{title}}</span>
                <v-ons-search-input style="margin-top: 4px; width: 100%;" v-else :value="my_prop" @input="send($event.target.value)" placeholder="Search something"
                ></v-ons-search-input>
            </div>
        </div>
        <div class="right"  >
            <v-ons-toolbar-button v-if="onHold.handler && mySighting.marker === 0"  @click="deletePlant">
                <v-ons-icon icon="ion-trash-a, material: md-delete"></v-ons-icon>
            </v-ons-toolbar-button>
            <div v-else>
                <v-ons-toolbar-button  v-if="search" @click="searchLocal">
                    <v-ons-icon icon="ion-search, material: md-search"></v-ons-icon>
                </v-ons-toolbar-button>
                <v-ons-toolbar-button @click="showPopover($event, 'down', true)">
                    <v-ons-icon icon="md-more-vert"></v-ons-icon>
                </v-ons-toolbar-button>
            </div>

            <!--<v-ons-toolbar-button @click="grid" v-if="grid" >

                <v-ons-icon :icon="isGrid.view ? 'ion-grid, material: md-apps' : 'ion-ios-list-outline, material: md-format-list-bulleted'"></v-ons-icon>
            </v-ons-toolbar-button>-->

        </div>
    </v-ons-toolbar>
</template>
<script>
    import {change_view,onHold,mySighting, onHoldHandler } from './Ajax/getData'

    export default {
        model: {
            prop: 'my_prop',
            event: 'my_event'
        },
        props: {
            selectCount: Array,
            showPopover: Function,
            modifier:{
                default: true
            },
            deletePlant: Function,
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

                onHold,
                mySighting,
                isSearch: false
            }
        },
        methods: {
            onHoldHandler(){
                onHoldHandler()
            },
            searchLocal(){
                var vm = this

                vm.isSearch = !vm.isSearch
            },
            changeView(){
                var vm = this
                change_view()
                vm.onBack = true
            },
            send: function (v) {
                this.$emit('my_event', v)
            },
        }
    }
</script>