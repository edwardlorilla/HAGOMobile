<template id="home">
    <v-ons-page>
        <v-ons-toolbar>
            <div class="left">
                <v-ons-toolbar-button v-if="pageName" @click="changeView">
                    <v-ons-icon icon="ion-navicon, material:md-menu"></v-ons-icon>
                </v-ons-toolbar-button>
                <v-ons-back-button v-else>Page 1</v-ons-back-button>
            </div>
            <div class="right">
                <v-ons-toolbar-button @click="showPopover($event, 'down', true)">
                    <v-ons-icon v-if="$ons.platform.isAndroid()" icon="md-layers"></v-ons-icon>
                    <v-ons-icon v-else icon="ion-gear-b, material:md-settings"></v-ons-icon>
                </v-ons-toolbar-button>
            </div>
            <div class="center">{{ pageName }}</div>

        </v-ons-toolbar>

        <v-ons-popover cancelable
                       :visible.sync="popoverVisible"
                       :target="popoverTarget"
                       :direction="popoverDirection"
                       :cover-target="coverTarget"
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

        {{watchLocation}}
        <!--<p >
            <v-ons-search-input style="width: 90%;" placeholder="Search something"></v-ons-search-input>
        </p>-->
        <div class="addMarker">
            <div style="display: flex;justify-content: center;">
                <search-map v-model="searchQuery"></search-map>
                <search-result-scope v-if="isArray" :style="{'margin-top': $ons.platform.isAndroidPhone() ? 60 + 'px' : 50 + 'px'}">
                    <v-ons-list-item v-for="(search, index) in result" :key="index" @click="onResult(search)">
                        <div class="left">
                            <img class="list-item__thumbnail" src="http://placekitten.com/g/40/40">
                        </div>
                        <search-result :search="search" ></search-result>
                    </v-ons-list-item>
                </search-result-scope>

            </div>
        </div>
        <div id="map"></div>
    </v-ons-page>
</template>
<style scoped>
    .addMarker {
        position: fixed;
        z-index: 1000;

        width: 100%;
        padding-top: 5px;
        padding-bottom: 5px;
    }

    .autocomplete-list {
        position: absolute;
        z-index: 2;
        overflow: auto;
        max-height: 150px;
        margin: 0;

        padding: 0;
        border-radius: 4px;
    }
</style>
<script>
    import {tileSet} from './TileSet'
    import {change_view, PlantFound, userLocation, plantItem} from './../Ajax/getData'
    export default{
        props: {
            pageName: {
                type: String,
                required: false
            }
        },
        data(){
            return {
                keys: ['name'],
                fuse: '',
                searchQuery: '',

                plantFound: PlantFound,
                popoverVisible: false,
                popoverTarget: null,
                popoverDirection: 'up',
                coverTarget: false,

                numAttempts: 0,
                map: null,
                totalPanX: 6.7400,
                panStep: 0.001,
                totalPanY: 126.1817,
                markers: [],
                markerClusters: null,
                selectedTileSet: 3,
                tileSets: tileSet,
                userLocation: userLocation,
                initialize: null,
                accuracy: null,
                altitude: null,
                heading: null,
                speed: null,
                positionOptions: {
                    enableHighAccuracy: true,
                    timeout: 10000,
                    maximumAge: 10000
                },
                watchId: null,
                resultFuse: [],
                result: null
            }
        },
        mounted(){
            var vm = this
            vm.markerClusters = L.markerClusterGroup();
            var userIcon = L.icon({
                iconUrl: 'https://cdn0.iconfinder.com/data/icons/small-n-flat/24/678111-map-marker-64.png',
                iconSize: [32, 32]
            });
            vm.map = L.map('map', {
                center: [10.0, 5.0],
                minZoom: 2,
                zoom: 2,
                zoomControl: true
            })
            vm.map.zoomControl.setPosition('bottomleft');
            var options = {
                shouldSort: true,
                threshold: 0.6,
                location: 0,
                distance: 100,
                maxPatternLength: 32,
                minMatchCharLength: 1,
                keys: vm.keys
            };

            vm.fuse = new Fuse(vm.resultFuse, options);
            vm.map.locate({setView: true, maxZoom: 15});
            vm.setTileSet(vm.selectedTileSet)
            vm.map.on('locationfound', vm.onLocationFound);
        },
        watch: {
            searchQuery(){
                var vm = this
                if (this.searchQuery.trim() === '')
                    this.result = null
                else
                    this.result = this.fuse.search(this.searchQuery.trim())
            }
        },
        computed: {
            isArray(){
                return _.isArray(this.result)
            },
            watchLocation(){
                var vm = this
                return vm.markers == [] ? vm.getGoogleData() : null;
            },
            getLocation(){
                var vm = this;
                return ('geolocation' in navigator) ? vm.watchId = navigator.geolocation.watchPosition(vm.onSuccess, vm.onError, vm.positionOptions) : vm.initialize = 'Sorry, geolocation does not appear to be supported in this browser.'
            },
        },
        methods: {
            onResult(search){
                var vm = this,  plant = _.findIndex(vm.markers, {options: {id: search.id}});
                vm.markerFunction(plant)
            },
            onSuccess (position) {
                var vm = this
                vm.numAttempts++
                vm.initialize = 'Success! Attempt ' + vm.numAttempts + ' results:'
                vm.userLocation.lat = position.coords.latitude
                vm.userLocation.lng = position.coords.longitude

                vm.accuracy = "Accuracy: " + position.coords.accuracy + ' meters'
                vm.altitude = "Altitude: " + position.coords.altitude || 'null'
                vm.heading = "Heading: " + position.coords.heading || 'null'
                vm.speed = "Speed: " + position.coords.speed || 'null'
                //frame.setAttribute('src', frameUrl + position.coords.latitude + ',' + position.coords.longitude)

                setTimeout(function () {
                    vm.initialize = "Success!"
                }, 1000)
            },
            onError: function (error) {
                var msg = 'An unknown error occurred while requesting your location.'

                // https://www.w3.org/TR/geolocation-API/#position_error_interface
                switch (error.code) {
                    case 1:
                        msg = 'The document does not have permission to use the Geolocation API.'
                        break
                    case 2:
                        msg = 'The position of the device could not be determined.'
                        break
                    case 3:
                        msg = 'The position request timed out.'
                        break
                    default:
                        break
                }
            },
            onLocationFound(e) {
                var vm = this
                var radius = e.accuracy / 2;
                var userIcon = L.icon({
                    iconUrl: 'https://cdn0.iconfinder.com/data/icons/small-n-flat/24/678111-map-marker-64.png',
                    iconSize: [32, 32]
                });
                var userLocation = L.marker([e.latlng.lat, e.latlng.lng], {
                    icon: userIcon,
                    title: "marker_",
                    name: 'User Location',
                    content: 'you are here',
                    image: 'https://cdn0.iconfinder.com/data/icons/small-n-flat/24/678111-map-marker-64.png'
                }).bindPopup("You are within " + radius + " meters from this point").openPopup();
                vm.map.initlat = e.latlng.lat;
                vm.map.initlng = e.latlng.lng
                vm.markerClusters.addLayer(userLocation);
                vm.markers.push(userLocation);
                vm.map.addLayer(vm.markerClusters)
                vm.userLocation = new L.LatLng(e.latlng.lat, e.latlng.lng);
                vm.getGoogleData()
            },
            changeView(){
                change_view()
            },
            showPopover(event, direction, coverTarget = false) {
                var vm = this;
                vm.popoverTarget = event;
                vm.popoverDirection = direction;
                vm.coverTarget = coverTarget;
                vm.popoverVisible = true;
            },
            displayLocation(position) {
                var vm = this;
                var userIcon = L.icon({
                    iconUrl: 'https://cdn0.iconfinder.com/data/icons/small-n-flat/24/678111-map-marker-64.png',
                    iconSize: [32, 32]
                });
                console.log('position', position);
                var lat = 6.7400;
                var lng = 126.1817;
                var userLocation = L.marker([lat, lng], {icon: userIcon}).bindPopup('<h2> Your Locations</h2>');
                vm.map.setView([lat, lng], 16);
                vm.markerClusters.addLayer(userLocation);
                vm.markers.push(userLocation);
                vm.map.addLayer(vm.markerClusters)
                vm.userLocation = new L.LatLng(lat, lng);
                vm.getGoogleData()


            },
            setTileSet(selectedTileLayer){
                console.log(selectedTileLayer)
                var vm = this;
                var basemap = null
                var tile = this.tileSets.all[selectedTileLayer]
                if (tile.name == 'OpenStreetMap') {
                    basemap = L.tileLayer(tile.tileLayer, {
                        attribution: tile.attribution
                    })
                } else {
                    basemap = L.tileLayer(tile.tileLayer, {
                        maxZoom: 20,
                        subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
                    });
                }


                if (vm.map.hasLayer(basemap)) {
                    vm.map.removeLayer(basemap);
                }
                else {
                    vm.map.addLayer(basemap);
                }
            },
            markerFunction(id) {
                var vm = this
                var marker = vm.markers[id]
                console.log(marker)
                var itemObject = marker.options;
                var position = marker.getLatLng();
                var floraLocation = new L.LatLng(position.lat, position.lng);
                var userDistance = vm.createPolyLine(floraLocation, vm.userLocation);
                console.log(position)
                vm.map.setView(position, 15);
                vm.markers[id]._popup._content = userDistance + '<h2>' + itemObject.name + '</h2>' + itemObject.content + '<img width="100%" src="' + itemObject.image + '" />'
                if (!marker._icon) marker.__parent.spiderfy();
                marker.openPopup();


            },
            createPolyLine(floraLocation, userLocation){
                return 'About ' + (floraLocation.distanceTo(userLocation) / 1000).toFixed(0) + 'km away from you.</p>';
            },
            getGoogleData: function () {
                var vm = this, userDistance = null

                _.forEach(plantItem.all, function (val, i) {
                    vm.resultFuse.push(val)
                    var photo = !_.isEmpty(val.photos) ? val.photos[0].file : 'http://placekitten.com/g/40/40'
                    var floralocation = new L.LatLng(val.latitude, val.longitude);
                    vm.userLocation ? userDistance = vm.createPolyLine(floralocation, vm.userLocation) : null;
                    var markerX = L.marker([val.latitude, val.longitude], {
                        id: val.id,
                        title: "marker_" + i,
                        name: val.name,
                        content: val.description,
                        image: photo
                    })
                            .bindPopup(userDistance + '<h2>' + val.name + '</h2>' + val.description + '<img width="100%" src="' + photo + '" />');
                    vm.markerClusters.addLayer(markerX);
                    vm.markers.push(markerX);
                    vm.map.addLayer(vm.markerClusters)

                });
                if (vm.plantFound.index) {
                    var plant = _.findIndex(vm.markers, {options: {id: vm.plantFound.index.id}});
                    vm.markerFunction(plant)
                }


            },
        }
    }
</script>