<template>
    <v-ons-page>
        <v-ons-list-item v-for='(flora, index) in plantRepository' :key="index">
            <div class="left">
                <img class="list-item__thumbnail"
                     :src="flora.gsx$markerimage.$t ? flora.gsx$markerimage.$t : 'http://placekitten.com/g/40/40'">
            </div>
            <div class="center">
                <span class="list-item__title">{{flora.gsx$listtitle.$t}}</span><span class="list-item__subtitle">{{flora.gsx$markercontent.$t}}</span>
            </div>
        </v-ons-list-item>

    </v-ons-page>
</template>
<script>
    import {get} from './getData'
    export default{
        data(){
            return {
                plantRepository: []
            }
        },
        mounted(){
            this.getPlantRepository()
        },
        methods: {
            getPlantRepository(){
                var vm = this
                get().then(function (response) {
                    vm.plantRepository = response.data.feed.entry
                })
            }
        }
    }
</script>