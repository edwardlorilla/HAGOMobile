<template>
    <v-ons-page>
        <custom-toolbar  :title="viewUrls[radioToggle]" v-model="searchQuery"
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

                <!--<v-ons-list-item tappable>
                    <label class="left">
                        <v-ons-radio
                                input-id="radio_1"
                                value="0"
                                v-model="selectedView"
                        >
                        </v-ons-radio>
                    </label>
                    <label for="radio_1" class="center">
                        {{viewUrls[0]}}
                    </label>
                </v-ons-list-item>
                <v-ons-list-item tappable>
                    <label class="left">
                        <v-ons-radio
                                input-id="radio_2"
                                value="1"
                                v-model="selectedView"
                        >
                        </v-ons-radio>
                    </label>
                    <label for="radio_2" class="center">
                        {{viewUrls[1]}}
                    </label>
                </v-ons-list-item>-->
                <v-ons-list-item>
                    <label class="center" for="switch1">

                        <v-ons-icon icon="fa-street-view"></v-ons-icon>
                        Sort Nearest
                    </label>

                    <div class="right"  @click="isNearestMarkerSort">
                        <v-ons-switch  input-id="switch1"
                                       :disabled="!getSearchQuery.length > 0"
                                       v-model="nearestMarker"
                        >
                        </v-ons-switch>
                    </div>
                </v-ons-list-item>
                <v-ons-list-item >
                    <label class="center" for="switch2">

                        <v-ons-icon :icon="!listView.view ? 'ion-grid, material: md-apps' : 'ion-ios-list-outline, material: md-format-list-bulleted'"></v-ons-icon>
                        {{ listView.view ? ' List View' : ' Grid View' }}
                    </label>
                    <div class="right" @click="isGrid">
                        <v-ons-switch  input-id="switch2"
                                       :disabled="!getSearchQuery.length > 0"
                                       v-model="isView"
                        >
                        </v-ons-switch>
                    </div>
                </v-ons-list-item>

            </ons-list>

        </v-ons-popover>
        <v-ons-list>
            <v-ons-lazy-repeat
                    v-if="getFuseList.list"
                    :render-item="renderItem"
                    :calculate-item-height="calculateItemHeight"
                    :length="getSearchQuery.length">
            </v-ons-lazy-repeat>
        </v-ons-list>
        <floating-action></floating-action>
    </v-ons-page>
</template>
<script>
    import {toggleMySighting, isNearestMarkerSort, nearest, currentPage, mySighting, userLocation, getData, plantItem, PlantItem, Push, setResults, getResults, toggleView, listView, gps_distance} from './../Ajax/getData'

    export default{
        data(){
            return {
                nearestMarker: false,
                isView: false,
                selectedView: mySighting.marker.toString(),
                viewUrls: ['My Sighting','Repositories of Plants'],
                nearest,
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
                            <div v-if="plant.all[index]"  :key="index" >
                            <v-ons-list-item @click="getMapInfo(plant.all[index])"  v-if="listView.view">
                                <v-ons-row  >
                                    <v-ons-col  width="95px">
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
                                        {{plant.all[index].description.slice(0, 20)}}
                                      </div>
                                    </v-ons-col>
                                    <v-ons-col width="40px"></v-ons-col>
                                  </v-ons-row>
                              </v-ons-list-item>
                            <v-ons-row  v-else>
                                <v-ons-col  style="width: 60px;"  v-for="row in getItem[index]" :key="index">
                                  <v-ons-card @click="getMapInfo(row)"   :key="index"><img class="thumbnail" style="object-fit: cover;width: 60px; height:60px;" :src="row.photos | getGridPhoto"/></v-ons-card>
                                </v-ons-col>
                             </v-ons-row>
                            </div>
                        `,
                        data() {
                            return {
                                index: i,
                                plant: getResults,
                                listView: listView,
                                windowWidth:  window.innerWidth
                            };
                        },
                        mounted(){
                            window.addEventListener('resize', this.handleWindowResize);
                        },
                        beforeDestroy: function () {
                            window.removeEventListener('resize', this. handleWindowResize)
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
                                return !_.isEmpty(plant.photos) ?  'images/thumb_' +plant.photos[0].file :  plant.photos
                            },
                            getItem() {
                                var vm = this
                                return vm.listView.view ? vm.plant.all :  _.chunk(getResults.all, vm.onOrientation)
                            }
                        },
                        methods: {
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
                windowWidth:  window.innerWidth
            }
        },
        mounted(){
            var vm = this
            window.addEventListener('resize', this.handleWindowResize);
            vm.getPlantRepository()
        },
        beforeDestroy: function () {
            window.removeEventListener('resize', this. handleWindowResize)
        },
        computed: {
            radioToggle(){
                return mySighting.marker
            },
            toggleMySighting(){
            var vm = this
                toggleMySighting(vm.selectedView)
                return vm.selectedView
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
                 return  listView.view ? getResults.all  :  _.chunk(getResults.all, vm.onOrientation)
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

        },
        filters:{
            parseInt(value){
                return _.parseInt(value)
            }
        },
        watch: {
            searchQuery(){

            }
        },
        methods: {
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