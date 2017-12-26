<template>
    <v-ons-page>
        <custom-toolbar :title="currentPage.name" v-model="searchQuery"
                        :show-popover="showPopover"
                        :search="isSearch"></custom-toolbar>


        <v-ons-progress-bar v-if="!getFuseList.list" indeterminate></v-ons-progress-bar>
        <v-ons-popover cancelable
                       :visible.sync="popoverVisible"
                       :target="popoverTarget"
                       :direction="popoverDirection"
                       :cover-target="coverTarget"
        >
            <v-ons-list-title>Views</v-ons-list-title>
            <ons-list>
                <ons-list-item @click="isGrid">
                    <label class="center" for="switch1">

                        <v-ons-icon :icon="!listView.view ? 'ion-grid, material: md-apps' : 'ion-ios-list-outline, material: md-format-list-bulleted'"></v-ons-icon>
                        {{ listView.view ? ' List View' : ' Grid View' }}
                    </label>
                    <div class="right">
                        <v-ons-switch  input-id="switch1"
                                       :disabled="!getSearchQuery.length > 0"
                        >
                        </v-ons-switch>
                    </div>
                </ons-list-item>
                <ons-list-item @click="isNearestMarkerSort">
                    <label class="center" for="switch1">

                        <v-ons-icon icon="fa-street-view"></v-ons-icon>
                        Sort Nearest
                    </label>

                    <div class="right">
                        <v-ons-switch  input-id="switch1"
                                       :disabled="!getSearchQuery.length > 0"
                        >
                        </v-ons-switch>
                    </div>
                </ons-list-item>

            </ons-list>

        </v-ons-popover>
        <v-ons-list v-show="getSearchQuery.length > 0 ">
            <v-ons-lazy-repeat
                    v-if="getSearchQuery.length > 0"
                    :render-item="renderItem"
                    :length="getSearchQuery.length">
            </v-ons-lazy-repeat>
        </v-ons-list>
        <floating-action></floating-action>
    </v-ons-page>
</template>
<script>
import {toggleMySighting,currentPage, mySighting, getData, plantItem, PlantItem, Push, setSigthingResults, getSigthingResults, toggleView, listView, isNearestMarkerSort, nearest} from './../Ajax/getData'

export default{
props: ['toggleMenu', 'pageName'],
data(){
return {
toggle: 1,
    currentPage,
    mySighting,
    popoverVisible: false,
    popoverTarget: null,
    popoverDirection: 'up',
    coverTarget: false,
    plantItem,
    renderItem(i) {
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
                           {{plant.all[index].name}}
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
                    plant: getSigthingResults,
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
                    return !_.isEmpty(photo[0]) ? 'thumbnail/' + photo[0].file : 'http://placekitten.com/g/40/40'
                },

            },
            computed: {

                onOrientation(){
                    return parseInt(this.windowWidth / 100)
                },
                getPhoto(){
                    var vm = this
                    var plant = vm.getItem[vm.index];
                    return !_.isEmpty(plant.photos) ?  'thumbnail/' +plant.photos[0].file : 'http://placekitten.com/g/40/40'
                },
                getItem() {
                    var vm = this
                    return vm.listView.view ? vm.plant.all :  _.chunk(getSigthingResults.all, vm.onOrientation)
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
    keys: ['name'],
    isSearch: true,
    isSearching: false,
    results: [],
    fuse: '',
    searchQuery: '',
    listView: listView,
    windowWidth:  window.innerWidth
}
},
deactivated(){

},
mounted(){
var vm = this
    getData()
    window.addEventListener('resize', this.handleWindowResize);
},
beforeDestroy: function () {
window.removeEventListener('resize', this. handleWindowResize)
},
computed: {

onOrientation(){
    return parseInt(this.windowWidth / 100)
},
getSearchQuery() {
    var vm = this
    if (vm.searchQuery.trim() === '') {
        setSigthingResults(vm.fuse.list)
    }
    else {
        setSigthingResults(vm.getFuseList.search(vm.searchQuery.trim()))
    }
    return listView.view ? getSigthingResults.all :  _.chunk(getSigthingResults.all, vm.onOrientation)
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
    vm.fuse = new Fuse(vm.plantItem.all, options);

    return vm.fuse
},

},

watch: {},
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
handleWindowResize(event)
{
    this.windowWidth = event.currentTarget.innerWidth;
},
isGrid(){
    toggleView()
},
}
}







</script>