<template>
    <v-ons-list-item @click="getMapInfo(data)" class="list-item-container">
        <staggered-fade>
            <v-ons-row>
                <v-ons-col width="95px">
                    <img class="thumbnail"
                         :src="getPhoto">
                </v-ons-col>
                <v-ons-col>
                    <div class="name">
                        {{data.name}}
                    </div>
                    <div class="location">
                        <i class="fa fa-map-marker"></i>
                        {{data.description}}
                    </div>
                </v-ons-col>
                <v-ons-col width="40px"></v-ons-col>
            </v-ons-row>
        </staggered-fade>
    </v-ons-list-item>
</template>

<script>
    import {PlantItem} from './../Ajax/getData'
    export default {
        props: {
            data: Object
        },
        methods: {
            getMapInfo(plantInfo){
                var vm = this
                PlantItem(plantInfo)

            }
        },
        computed: {
            getPhoto(){
                var vm = this
                var plant = vm.data
                return !_.isEmpty(plant.photos) ? plant.photos[0].file : 'https://placekitten.com/g/40/40'
            }
        }

    }
</script>