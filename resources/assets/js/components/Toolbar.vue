<template>
    <v-ons-toolbar>
        <div class="left">
            <v-ons-toolbar-button @click="changeView">
                <v-ons-icon icon="ion-navicon, material:md-menu"></v-ons-icon>
            </v-ons-toolbar-button>
        </div>
        <div class="center">{{ title }}</div>
        <div class="right">
            <v-ons-toolbar-button @click="search()">
                <v-ons-icon icon="ion-search, material: md-search"></v-ons-icon>
            </v-ons-toolbar-button>
        </div>
    </v-ons-toolbar>
</template>
<script>
    import {change_view} from './Ajax/getData'
    export default {
        props:{
            title:{
                type: String
            },
            search: Function
        },
        methods:{
            changeView(){
                change_view()
            }
        }
    }
</script>