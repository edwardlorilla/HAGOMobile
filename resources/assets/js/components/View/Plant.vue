<template id="plant">
    <v-ons-page>
        <custom-toolbar  title="Repositories of Plants" v-model="searchQuery" :grid="isGrid"
                        :search="isSearch"></custom-toolbar>
        <v-ons-progress-bar v-if="!getFuseList.list" indeterminate></v-ons-progress-bar>
        <v-ons-list v-show="plantItem.count > 0">
            <v-ons-lazy-repeat
                    v-if="plantItem.count > 0"
                    :render-item="renderItem"
                    :length="getSearchQuery.length">
            </v-ons-lazy-repeat>
        </v-ons-list>
        <floating-action></floating-action>
    </v-ons-page>
</template>
<script>
    import {getData, plantItem, PlantItem, Push, setResults, getResults, toggleView, listView} from './../Ajax/getData'

    export default{
        props: ['toggleMenu', 'pageName'],
        name: 'viewPlant',
        data(){
            return {
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
                                return !_.isEmpty(photo[0]) ? photo[0].file : 'http://placekitten.com/g/40/40'
                            }
                        },
                        computed: {

                            onOrientation(){
                                return parseInt(this.windowWidth / 100)
                            },
                            getPhoto(){
                                var vm = this
                                var plant = vm.getItem[vm.index];
                                return !_.isEmpty(plant.photos) ? plant.photos[0].file : 'http://placekitten.com/g/40/40'
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
        beforeMount(){
            plantItem
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
                    setResults(vm.plantItem.all)
                }
                else {
                    setResults(vm.getFuseList.search(vm.searchQuery.trim()))
                }
                return listView.view ? getResults.all :  _.chunk(getResults.all, vm.onOrientation)
            },
            getFuseList(){
                var vm = this
                var options = {
                    shouldSort: true,
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
            handleWindowResize(event)
            {
                this.windowWidth = event.currentTarget.innerWidth;
            },
            isGrid(){
                toggleView()
            }
        }
    }
</script>