<template id="plant">
    <v-ons-page>
        <custom-toolbar title="Repositories of Plants" v-model="searchQuery" :search="isSearch"></custom-toolbar>


        <v-ons-list>
            <v-ons-lazy-repeat
                    v-if="getFuseList.list"
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
                plant: plantItem,
                renderItem(i) {
                    return new Vue({
                        template: `
                            <div>
                            <v-ons-list-item v-if="plant.all[index]" :key="index" @click="getMapInfo(plant.all[index])" class="list-item-container">
                              <staggered-fade>
                              <v-ons-row>
                                <v-ons-col width="95px">
                                  <img class="thumbnail"
                                         :src="getPhoto">
                                </v-ons-col>
                                <v-ons-col>
                                  <div class="name">
                                   {{plant.all[index].name}}
                                  </div>
                                  <div class="location">
                                    <i class="fa fa-map-marker"></i>
                                    {{plant.all[index].description.slice(0, 20)}} ...
                                  </div>
                                </v-ons-col>
                                <v-ons-col width="40px"></v-ons-col>
                              </v-ons-row>
                              </staggered-fade>
                            </v-ons-list-item>
                            </div>
                        `,
                        data() {
                            return {
                                index: i,
                                plant: getResults
                            };
                        },
                        computed: {
                            getPhoto(){
                                var vm = this
                                var plant = vm.plant.all[vm.index];
                                return !_.isEmpty(plant.photos) ? plant.photos[0].file : 'http://placekitten.com/g/40/40'
                            }
                        },
                        methods: {
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
            }
        },
        mounted(){
            var vm = this
            vm.getPlantRepository()
        },
        computed: {
            getSearchQuery() {
                var vm = this
                if (vm.searchQuery.trim() === '') {
                    setResults(vm.plant.all)
                }
                else {
                    setResults(vm.getFuseList.search(vm.searchQuery.trim()))
                }
                return getResults.all
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

                vm.fuse = new Fuse(vm.plant.all, options);

                return vm.fuse
            },

        },
        watch: {},
        methods: {
            getPlantRepository(){
                getData()
            }
        }
    }
</script>