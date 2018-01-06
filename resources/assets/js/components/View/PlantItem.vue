<template>
    <v-ons-page v-if="plantInfo" modifier="shop-details">
        {{foundIndex(plantInfo.id)}}
        <v-ons-toolbar>
            <div class="left">
                <v-ons-toolbar-button>
                    <v-ons-back-button>Back</v-ons-back-button>
                </v-ons-toolbar-button>
            </div>
            <div class="center">{{plantInfo.title}}</div>
        </v-ons-toolbar>

        <div style="
                height: 240px;"
        >
            <clazy-load :src="getPhoto">
                <transition name="fade" slot="image">
                    <img :src="getPhoto" style="object-fit: cover;width: 100%;  height: 240px;" :alt="plantInfo.name">
                </transition>
                <transition name="fade" slot="placeholder">
                    <div slot="placeholder">
                        Loading....
                    </div>
                </transition>
            </clazy-load>

        </div>




        <v-ons-list>
            <v-ons-list-item>
                <div class="card-name">{{plantInfo.title}}</div>
            </v-ons-list-item>
            <v-ons-list-header>Description</v-ons-list-header>
            <v-ons-list-item>{{plantInfo.description}}</v-ons-list-item>
            <v-ons-list-header>Habitat</v-ons-list-header>
            <v-ons-list-item>
                <div @click="viewMap = !viewMap" class="map-container">
                    <clazy-load :src="backgroundImage">
                        <transition name="fade" slot="image">
                            <div  :class="viewMap ? 'satellite': 'map'" :style="{ 'background-image': 'url(' + backgroundImage + ')' }"></div>
                        </transition>
                        <transition name="fade" slot="placeholder">
                            <div slot="placeholder">
                                Loading....
                            </div>
                        </transition>
                    </clazy-load>


                </div>
            </v-ons-list-item>
        </v-ons-list>
        <v-ons-bottom-toolbar modifier="transparent" style="margin: 16px">
            <v-ons-button class="btn" v-if="plantInfo.id" modifier="large" @click="getMapInfo"
                          style="margin: 6px 0; text-align: center;">
                <v-ons-icon icon="ion-search"></v-ons-icon>
                Find Location
            </v-ons-button>
        </v-ons-bottom-toolbar>
    </v-ons-page>
</template>
<style>
    .map-container {
        display: block;
        position: relative;
        width: 100%;
        height: 240px;
        overflow: hidden;
        border: 1px solid #ccc;
        margin: 0 auto;
    }

    .map-container a {
        position: absolute;
        display: block;
        width: 100%;
        height: 100%;
        z-index: 3;
    }

    .map-container .map,
    .map-container .satellite {
        position: absolute;
        opacity: 1;
        width: 100%;
        height: 100%;
        background-repeat: no-repeat;
        background-position: center center;
        background-size: cover;
        -webkit-transition: opacity 500ms ease, -webkit-transform 500ms ease;
        transition: opacity 500ms ease, -webkit-transform 500ms ease;
        transition: transform 500ms ease, opacity 500ms ease;
        transition: transform 500ms ease, opacity 500ms ease, -webkit-transform 500ms ease;
    }
    .fade-enter, .fade-leave-to {
        opacity: 0;
    }
</style>
<script>
    import {PlantInfo, Push, PlantIndex, currentPageSwitcher, popItem} from './../Ajax/getData'
    export default {
        data(){
            return {
                plantInfo: PlantInfo,
                viewMap:true
            }
        },
        computed: {

            backgroundImage(){
                var vm = this
                return `https://maps.googleapis.com/maps/api/staticmap?center=${vm.plantInfo.latitude},${vm.plantInfo.longitude}&zoom=30&size=500x500&sensor=false&markers=color:blue%7C${vm.plantInfo.latitude},${vm.plantInfo.longitude}&scale=2&maptype=${vm.viewMap ? 'roadmap': 'satellite'}&key=AIzaSyDpziJj9FNZsHcCJamWE2I_NNMzH3luh3U`
            },
            getPhoto(){
                var vm = this
                var photo = vm.plantInfo.photos[0]
                console.log(vm.plantInfo)
                return photo ? 'images/' + photo.file : null
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
