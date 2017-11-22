<template>
    <v-ons-page v-if="plantInfo" modifier="shop-details">
        {{foundIndex(plantInfo.id)}}
        <v-ons-toolbar>
            <div class="left">
                <v-ons-toolbar-button>
                    <v-ons-back-button>Back</v-ons-back-button>
                </v-ons-toolbar-button>
            </div>
            <div class="center">{{plantInfo.name}}</div>
        </v-ons-toolbar>

        <v-ons-card>
            <img :src="getPhoto" style="width: 100%;" :alt="plantInfo.name">
        </v-ons-card>

        <v-ons-list-header>Default</v-ons-list-header>
        <v-ons-list style="display: flex; justify-content: center; border-top: none">
            <v-ons-button class="btn" v-if="plantInfo.id" modifier="cta" @click="getMapInfo"
                          style="margin: 6px 0; text-align: center;">
                <v-ons-icon icon="ion-search"></v-ons-icon>
                Find Location
            </v-ons-button>
        </v-ons-list>

        <v-ons-list style="border-top: 0;">
            <v-ons-list-item>
                <div class="card-name">{{plantInfo.name}}</div>
            </v-ons-list-item>
            <v-ons-list-item>{{plantInfo.description}}</v-ons-list-item>
        </v-ons-list>

    </v-ons-page>
</template>

<script>
    import {PlantInfo, Push, PlantIndex, currentPageSwitcher, popItem} from './../Ajax/getData'
    export default {
        data(){
            return {
                plantInfo: PlantInfo

            }
        },
        computed: {
            getPhoto(){
                var vm = this
                var photo = vm.plantInfo.photos[0];
                return photo ? photo.file : null
            }
        },
        methods: {
            getMapInfo(){
                popItem()
                currentPageSwitcher('view-map', 'View Plant Location')
                //Push('view-map');
                //Push('plant-item-map-view');

            },
            foundIndex(id){
                PlantIndex(id)
            }
        }
    }
</script>
