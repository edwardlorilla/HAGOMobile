<template>
    <v-ons-page  id="main">
        <custom-toolbar :title="viewUrls[radioToggle]"
                        v-model="searchQuery"
                        :selectCount="filtersPlantSelect"
                        :deletePlant="selectedDelete"
                        :show-popover="showPopover"
                        :search="isSearch"></custom-toolbar>
        <v-ons-progress-bar v-if="!getSearchQuery.length > 0" indeterminate></v-ons-progress-bar>
        <v-ons-popover cancelable
                       :visible.sync="popoverVisible"
                       :target="popoverTarget"
                       :direction="popoverDirection"
                       :cover-target="coverTarget"
        >
            <v-ons-list-title>Views</v-ons-list-title>

            <ons-list>
                <v-ons-list-item>
                    <label class="center" for="switch1">

                        <v-ons-icon icon="fa-street-view"></v-ons-icon>
                        Sort Nearest
                    </label>

                    <div class="right" @click="isNearestMarkerSort">
                        <v-ons-switch input-id="switch1"
                                      :disabled="!getSearchQuery.length > 0"
                                      v-model="nearestMarker"
                        >
                        </v-ons-switch>
                    </div>
                </v-ons-list-item>
                <v-ons-list-item>
                    <label class="center" for="switch2">

                        <v-ons-icon
                                :icon="!listView.view ? 'ion-grid, material: md-apps' : 'ion-ios-list-outline, material: md-format-list-bulleted'"></v-ons-icon>
                        {{ listView.view ? ' List View' : ' Grid View' }}
                    </label>
                    <div class="right" @click="isGrid">
                        <v-ons-switch input-id="switch2"
                                      :disabled="!getSearchQuery.length > 0"
                                      v-model="isView"
                        >
                        </v-ons-switch>
                    </div>
                </v-ons-list-item>

            </ons-list>

        </v-ons-popover>
        <v-ons-pull-hook
                :action="loadItem"
                @changestate="state = $event.state"
        >
            <span v-show="state === 'initial'"> Pull to refresh </span>
            <span v-show="state === 'preaction'"> Release </span>
            <span v-show="state === 'action'"> Loading... </span>
        </v-ons-pull-hook>
        <v-ons-gesture-detector>
        <v-ons-list>
            <v-ons-lazy-repeat
                    v-if="getFuseList.list"
                    :render-item="renderItem"
                    :calculate-item-height="calculateItemHeight"
                    :length="getSearchQuery.length">
            </v-ons-lazy-repeat>
        </v-ons-list>
        </v-ons-gesture-detector>
        <floating-action position="bottom center"></floating-action>
    </v-ons-page>
</template>
<script>
    import {
            onHold,
            toggleMySighting,
            isNearestMarkerSort,
            nearest,
            currentPage,
            mySighting,
            userLocation,
            getData,
            plantItem,
            PlantItem,
            Push,
            setResults,
            getResults,
            toggleView,
            onHoldHandler,
            listView,
            gps_distance,
            deletePlants
    } from './../Ajax/getData'

    export default{
        name: 'plant-view',
        data(){
            return {
                state: 'initial',
                nearestMarker: false,
                isView: false,
                selectedView: mySighting.marker.toString(),
                viewUrls: ['Gallery', 'Repositories of Plants'],
                nearest,
                user_id: firebase.auth().currentUser.displayName,
                user_uid: firebase.auth().currentUser.uid,
                currentPage,
                mySighting,
                popoverVisible: false,
                popoverTarget: null,
                popoverDirection: 'up',
                coverTarget: false,
                plant: plantItem,
                renderItem(i)  {
                    return new Vue({
                        template: `
                            <div  v-if="plant.all[index]"  :key="index" >
                                <staggered-fade>
                                    <v-ons-list-item   v-if="listView.view">
                                        <v-ons-row  >
                                            <v-ons-col v-if="onHold.handler && mySighting.marker === 0" width="95px">
                                                <v-ons-checkbox
                                                    :input-id="'checkbox-' + index"
                                                    v-model="plant.all[index].checkedPlant"
                                                  >
                                                </v-ons-checkbox>
                                            </v-ons-col>
                                            <v-ons-col style="width:95px;" @click="getMapInfo(plant.all[index])">
                                              <img class="thumbnail"
                                                    style="object-fit: cover;width: 60px; height:60px;"
                                                     :src="getPhoto">
                                            </v-ons-col>
                                            <v-ons-col>
                                              <div class="name">
                                               {{plant.all[index].title}}
                                              </div>
                                              <div class="location">
                                                <i class="fa fa-map-marker"></i>
                                                {{plant.all[index].description != null ? plant.all[index].description.splice(0, 20) : null}}
                                              </div>
                                            </v-ons-col>
                                          </v-ons-row>
                                      </v-ons-list-item>
                                    <v-ons-row  v-else>
                                        <v-ons-col  style="width: 60px;"  v-for="row in getItem[index]" :key="index">
                                          <v-ons-card @click="getMapInfo(row)"   :key="index"><img class="thumbnail" style="object-fit: cover;width: 60px; height:60px;" :src="row.photos | getGridPhoto"/></v-ons-card>
                                        </v-ons-col>
                                     </v-ons-row>
                                </staggered-fade>
                            </div>
                        `,
                        data() {
                            return {
                                onHold,
                                index: i,
                                plant: getResults,
                                listView: listView,
                                windowWidth: window.innerWidth,
                                mySighting,
                                user_id: firebase.auth().currentUser.displayName
                            };
                        },
                        mounted(){
                            var vm = this
                            window.addEventListener('resize', this.handleWindowResize);
                            vm.$set( vm.plant.all[vm.index], 'checkedPlant', false )


                        },
                        beforeDestroy: function () {
                            window.removeEventListener('resize', this.handleWindowResize)
                        },
                        filters: {
                            getGridPhoto(photo){
                                return !_.isEmpty(photo) ? 'images/thumb_' + photo[0].file : (photo ? photo : null)
                            }
                        },
                        computed: {
                            onOrientation(){
                                return parseInt(this.windowWidth / 100)
                            },
                            getPhoto(){
                                var vm = this
                                var plant = vm.getItem[vm.index];
                                return !_.isEmpty(plant.photos) ? 'images/thumb_' + plant.photos[0].file : plant.photos
                            },
                            getItem() {
                                var vm = this
                                return vm.listView.view ? vm.plant.all : _.chunk(getResults.all, vm.onOrientation)
                            }
                        },
                        methods: {
                            parseInt(value){
                                return _.parseInt(value)
                            },
                            handleWindowResize(event)
                            {
                                this.windowWidth = event.currentTarget.innerWidth;
                            },
                            getMapInfo(plantInfo){
                                var vm = this
                                PlantItem(plantInfo)
                                Push('plant-item');
                            }
                        }
                    });
                },
                keys: ['title'],
                isSearch: true,
                isSearching: false,
                results: [],
                fuse: '',
                searchQuery: '',
                listView: listView,
                windowWidth: window.innerWidth,
                filterPlant: []
            }
        },
        mounted(){
            var vm = this
            window.addEventListener('resize', this.handleWindowResize);
            vm.getPlantRepository()
            //TODO: hold to delete
            if(vm.currentPage.url === "plant-navigator"){
                document.addEventListener('hold', function(event) {
                    onHoldHandler()
                });
            }


        },
        beforeDestroy: function () {
            window.removeEventListener('hold', function(event) {
                onHoldHandler()
            });
            window.removeEventListener('resize', this.handleWindowResize)
        },
        computed: {
            radioToggle(){
                return mySighting.marker
            },

            onOrientation(){
                return parseInt(this.windowWidth / 100)
            },
            getSearchQuery() {
                var vm = this
                if (vm.searchQuery.trim() === '') {
                    setResults(vm.getFuseList.list)
                }
                else {
                    setResults(vm.getFuseList.search(vm.searchQuery.trim()))
                }
                return listView.view ? getResults.all : _.chunk(getResults.all, vm.onOrientation)
            },
            getFuseList(){
                var vm = this
                var options = {
                    shouldSort: false,
                    threshold: 0.6,
                    location: 0,
                    distance: 100,
                    maxPatternLength: 32,
                    minMatchCharLength: 1,
                    keys: vm.keys
                };

                vm.fuse = new Fuse(vm.plant.all, options);
                return vm.fuse
            },
            filtersPlantSelect(){
                var vm = this
                return _.map(_.filter(vm.plant.all, ['checkedPlant', true]))
            }
        },
        filters: {
            parseInt(value){
                return _.parseInt(value)
            }
        },
        watch: {
            searchQuery(){

            }
        },
        methods: {
            toggleMySighting(){
                var vm = this
                toggleMySighting(vm.selectedView)
                return vm.selectedView
            },
            selectedDelete(){
                var vm = this

                deletePlants( vm.filtersPlantSelect, 'id')
            },
            loadItem(done) {
                setTimeout(function () {
                    getData()
                    done();
                }, 400);
            },
            isNearestMarkerSort(){
                isNearestMarkerSort()
            },
            showPopover(event, direction, coverTarget = false) {
                this.popoverTarget = event;
                this.popoverDirection = direction;
                this.coverTarget = coverTarget;
                this.popoverVisible = true;
            },
            calculateItemHeight(){
                return 92;
            },
            handleWindowResize(event){
                this.windowWidth = event.currentTarget.innerWidth;
            },
            getPlantRepository(){
                getData()
            },
            isGrid(){
                toggleView()
            }
        }
    }
</script>