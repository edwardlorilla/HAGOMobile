<template id="plant">
    <v-ons-page>
        <v-ons-progress-bar v-if="!getFuseList.list" indeterminate></v-ons-progress-bar>
        <custom-toolbar title="Repositories of Plants" :search="searchToggle"></custom-toolbar>
        <search-scope v-show="onSearch.query">
            <v-ons-search-input v-model="searchQuery" placeholder="Search something"
                                style="width: 96%;"></v-ons-search-input>
        </search-scope>


        <v-ons-list style="transition: all .3s ease;" :style="{'margin-top': onSearch.query ? 60 + 'px' : 0 + 'px'}">
            <v-ons-lazy-repeat
                    v-if="getFuseList.list"
                    :render-item="renderItem"
                    :key="1 "
                    :length="getSearchQuery.length">
            </v-ons-lazy-repeat>

        </v-ons-list>
        <floating-action></floating-action>
    </v-ons-page>
</template>

<script>
    import {searchInput,toggleSearch, getData, plantItem, PlantItem, Push, setResults, getResults} from './../Ajax/getData'

    export default{
        props: ['toggleMenu', 'pageName'],
        name: 'viewPlant',
        data(){
            return {
                plant: plantItem,
                renderItem(i) {
                    return new Vue({
                        template: `
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
                                    {{plant.all[index].description}}
                                  </div>
                                </v-ons-col>
                                <v-ons-col width="40px"></v-ons-col>
                              </v-ons-row>
                              </staggered-fade>
                            </v-ons-list-item>
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
                isSearching: false,
                results: [],
                fuse: '',
                searchQuery: '',
                onSearch: searchInput
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
            },
            searchToggle(){
                toggleSearch()
            }
        }
    }
</script>