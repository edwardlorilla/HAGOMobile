<template id="home">
    <v-ons-page>

        <div id="map">

        </div>


    </v-ons-page>
</template>
<style scoped>
    #map {
        width: 100%;
        height: 100vh;
    }
</style>
<script>
    import {get} from './getData'
    export default{
        data(){
            return {
                map: null,
                markers: [],
                lists: [1]
            }
        },
        mounted(){
            var vm = this
            vm.map = L.map('map', {scrollWheelZoom: false})
            L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(vm.map);

            // map google data
            vm.getGoogleData();
        },
        computed: {
            getLists(){
                return this.lists
            }
        },
        methods: {
            getGoogleData: function () {
                var vm = this
                get().then(function (response) {
                    _.forEach(response.data.feed.entry, function (val, i) {
                        var markerX = L.marker([val.gsx$lat.$t, val.gsx$lng.$t], {title: "marker_" + i}).addTo(vm.map)
                                .bindPopup('<h2>' + val.gsx$markertitle.$t + '</h2>' + val.gsx$markercontent.$t + '<img src="' + val.gsx$markerimage.$t + '" />');

                        vm.markers.push(markerX)
                        var group = L.featureGroup(vm.markers).addTo(vm.map);
                        vm.map.fitBounds(group.getBounds());
                    });
                })
                        .catch(function (error) {
                            console.log(error);
                        });
            },
        }
    }
</script>