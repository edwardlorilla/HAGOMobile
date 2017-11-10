<template>
    <v-ons-page>
        <v-ons-toolbar>
            <div class="left">
                <v-ons-back-button>Page 1</v-ons-back-button>
            </div>
            <div class="right">
                <v-ons-toolbar-button @click="showPopover($event, 'down', true)">
                    <v-ons-icon v-if="$ons.platform.isAndroid()" icon="md-layers"></v-ons-icon>
                    <v-ons-icon v-else icon="ion-gear-b, material:md-settings"></v-ons-icon>
                </v-ons-toolbar-button>
            </div>
            <div class="center">Page 2</div>
        </v-ons-toolbar>

        <v-ons-popover cancelable
                       :visible.sync="popUp.popoverVisible"
                       :target="popUp.popoverTarget"
                       :direction="popUp.popoverDirection"
                       :cover-target="popUp.coverTarget"
        >

            <v-ons-list-item v-for="(tileset, index) in tileSets.all" :key="index" tappable
                             @change="setTileSet(selectedTileSet)">
                <label class="left">
                    <v-ons-radio
                            :input-id="'checkbox-' + index"
                            :value="index"
                            v-model="selectedTileSet"
                    >
                    </v-ons-radio>
                </label>
                <label class="center" :for="'checkbox-' + index">
                    {{ tileset.name }}
                </label>
            </v-ons-list-item>

        </v-ons-popover>
        <div id="map"></div>
    </v-ons-page>
</template>
<style>

</style>
<script>
    import {map, mapInit, markerClusters, options, tileSet, setTileSet, popUp, showPopover} from './../Ajax/getData'
    export default {
        data(){
            return {
                map: map,
                /* Popover */
                markerClusters: markerClusters,
                popUp: popUp,

                tileSets: tileSet,
                selectedTileSet: 3,
            }
        },
        computed:{
        },
        mounted(){
            var vm = this
            mapInit()
        },
        methods:{
            showPopover(event, direction, coverTarget = false) {
                showPopover(event, direction, coverTarget)
            },
            setTileSet(selectedTileLayer){
                setTileSet(selectedTileLayer)
            },
        }
    }
</script>