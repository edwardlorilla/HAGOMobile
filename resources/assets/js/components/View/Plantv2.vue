<template>
    <v-ons-page>
        <v-ons-toolbar modifier>
            <div class="left">
                <v-ons-toolbar-button v-if="onHold.handler && mySighting.marker === 0" @click="back">
                    <v-ons-icon icon="ion-android-arrow-back"></v-ons-icon>

                </v-ons-toolbar-button>
                <v-ons-toolbar-button v-else @click="changeView">
                    <v-ons-icon icon="ion-navicon, material: md-menu"></v-ons-icon>
                </v-ons-toolbar-button>
            </div>
            <div class="center">
                <div v-if="onHold.handler && mySighting.marker === 0">{{filtersPlantSelect.length}} selected</div>
                <div v-else>
                    <span v-if="!isSearch">{{currentPage.name}}</span>
                    <v-ons-search-input style="margin-top: 4px; width: 100%;" v-else v-model="search"
                                        placeholder="Search something"
                    ></v-ons-search-input>
                </div>
            </div>
            <div class="right">
                <v-ons-toolbar-button v-if="onHold.handler && mySighting.marker === 0" @click="deletePlant">
                    <v-ons-icon icon="ion-trash-a, material: md-delete"></v-ons-icon>
                </v-ons-toolbar-button>
                <div v-else>
                    <v-ons-toolbar-button @click="onSearch">
                        <v-ons-icon icon="ion-search, material: md-search"></v-ons-icon>
                    </v-ons-toolbar-button>
                    <v-ons-toolbar-button @click="showPopover($event, 'down', true)">
                        <v-ons-icon icon="md-more-vert"></v-ons-icon>
                    </v-ons-toolbar-button>
                </div>
            </div>
        </v-ons-toolbar>
        <v-ons-progress-bar v-if="!getSearch.length > 0" indeterminate></v-ons-progress-bar>
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
                                      :disabled="!getSearch.length > 0"
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
                    <div class="right" @click="toggleView">
                        <v-ons-switch input-id="switch2"
                                      :disabled="!getSearch.length > 0"
                                      v-model="isView"
                        >
                        </v-ons-switch>
                    </div>
                </v-ons-list-item>
            </ons-list>
        </v-ons-popover>

            <v-ons-list>
                <virtual-list v-if="getSearch.length > 0" :size="50" :remain="14" :bench="44" class="scroll"  :start="startIndex">
                    <v-ons-list-item v-for="(plant, index) in getSearch" :key="index" @click="getMapInfo(plant)">
                        <v-ons-row modifier="chevron"">
                           <!-- <v-ons-col  width="95px">
                                <v-ons-checkbox
                                        :input-id="'checkbox-' + index"
                                        v-model="plant.checkedPlant"
                                >
                                </v-ons-checkbox>
                            </v-ons-col>-->
                            <v-ons-col style="width:95px;"
                            >

                                <img class="thumbnail"
                                     style="object-fit: cover;width: 60px; height:60px;"
                                     :src="getPhoto(plant.photos)">
                            </v-ons-col>
                            <v-ons-col>
                                <div class="name">
                                    {{plant.title}}
                                </div>
                                <div class="location">
                                    <i class="fa fa-map-marker"></i>
                                    {{plant.description.slice(0, 20)}}
                                </div>
                            </v-ons-col>
                        </v-ons-row><!--
                        <v-ons-row modifier="chevron"
                                   @click="getMapInfo(plant)"
                                   v-else-if="listView.view && mySighting.marker === 1">

                            <v-ons-col style="width:95px;">
                                <img class="thumbnail"
                                     style="object-fit: cover;width: 60px; height:60px;"
                                     :src="getPhoto(plant.photos)">
                            </v-ons-col>
                            <v-ons-col>
                                <div class="name">
                                    {{plant.title}}
                                </div>
                                <div class="location">
                                    <i class="fa fa-map-marker"></i>
                                    {{plant.description.slice(0, 20)}}
                                </div>
                            </v-ons-col>
                        </v-ons-row>
                        <v-ons-row v-else>
                            <v-ons-col style="width: 60px;" v-for="(row, index) in plant" :key="index"
                                       @click="getMapInfo(row)">
                                <v-ons-card>
                                   &lt;!&ndash; <img class="thumbnail" style="object-fit: cover;width: 60px; height:60px;"
                                         :src="getPhoto(row.photos !==null ? row.photos : row)"/>&ndash;&gt;
                                </v-ons-card>
                            </v-ons-col>
                        </v-ons-row>-->
                    </v-ons-list-item>
                </virtual-list>
            </v-ons-list>

        <floating-action></floating-action>
        <v-ons-bottom-toolbar>
            <div class="tabbar" :class="isAndroid ? 'tabbar--top tabbar--material' : ''">
                <label @click="currentPageSwitcher('Repositories of Plants', 1)"
                       :class="isAndroid ? 'tabbar--material__item' : ''" class="tabbar__item">
                    <input type="radio" name="tabbar-a" :checked="mySighting.marker === 0 ? '' : 'checked'">
                    <button class="tabbar__button" :class="isAndroid ? 'tabbar--material__button' : ''">
                        <!--<i class="tabbar__icon fa fa-leaf" :class="isAndroid ? 'tabbar&#45;&#45;material__icon' : ''"></i>-->
                        <ons-ripple modifier="material" class="ripple--material ripple">
                            <div class="ripple__wave ripple--material__wave"></div>
                            <div class="ripple__background ripple--material__background"></div>
                        </ons-ripple>
                        <div class="tabbar__icon"><ons-icon modifier="material" class="ons-icon fa-leaf fa" icon="fa-leaf"></ons-icon></div>
                        <div class="tabbar__label" :class="isAndroid ? 'tabbar--material__label' : ''">Repositories of
                            Plants
                        </div>
                    </button>
                </label>

                <label @click="currentPageSwitcher('My Sighting', 0)" :class="isAndroid ? 'tabbar--material__item' : ''"
                       class="tabbar__item">
                    <input type="radio" name="tabbar-a"
                           :checked="mySighting.marker === 1 || mySighting.marker === null ? '' : 'checked'">
                    <button class="tabbar__button" :class="isAndroid ? 'tabbar--material__button' : ''">
                        <ons-ripple modifier="material" class="ripple--material ripple">
                            <div class="ripple__wave ripple--material__wave"></div>
                            <div class="ripple__background ripple--material__background"></div>
                        </ons-ripple>
                        <div class="tabbar__icon"><ons-icon modifier="material" class="ons-icon fa-eye fa" icon="fa-eye"></ons-icon></div>
                        <div class="tabbar__label" :class="isAndroid ? 'tabbar--material__label' : ''">My Sighting</div>
                    </button>
                </label>
            </div>
        </v-ons-bottom-toolbar>


    </v-ons-page>
</template>
<script>
    import {
        storeData,
        currentPageSwitcher,
        plantItem,
        getData,
        isNearestMarkerSort,
        listView,
        onHold,
        toggleView,
        userLocation,
        change_view,
        nearest,
        gps_distance,
        mySighting,
        toggleMySighting,
        PlantItem,
        deletePlants,
        Push,
        onHoldHandler,
        currentPage,
        deletePlant
    } from './../Ajax/getData'
    export default{
        name: 'plant-view',
        data(){
            return {
                startIndex: 0,
                onHold,
                state: 'initial',
                searchKeys: [],
                checkedSearchKey: [],
                isView: true,
                popoverVisible: false,
                popoverTarget: null,
                popoverDirection: 'up',
                coverTarget: false,
                search: '',
                isSearch: false,
                plantItem,
                listView,
                fuse: null,
                windowWidth: window.innerWidth,
                userLocation,
                nearest,
                nearestMarker: false,
                mySighting,
                sortShould: true,
                options: {
                    shouldSort: true,
                    threshold: 0.6,
                    location: 0,
                    distance: 100,
                    maxPatternLength: 32,
                    minMatchCharLength: 1,
                    keys: [
                        "title"
                    ]
                },
                currentPage,
                filterPlant: [],
                filterResult: []
            }
        },
        mounted(){
            var vm = this

            window.addEventListener('resize', vm.handleWindowResize);

            for (var i = 0; i < vm.plantItem.all.length; i++) {
                vm.$set(vm.plantItem.all[i], 'checkedPlant', false)
            }
//            mySighting.marker === null ?  mySighting.marker = 0 : mySighting.marker = 1
            vm.currentPageSwitcher('Repositories of Plants', 1)
        },
        beforeDestroy: function () {
            var vm = this
        },
        methods: {
            isAndroid() {
                return this.$ons.platform.isAndroid();
            },
            currentPageSwitcher(page, marker){
                currentPageSwitcher("plant-navigator", page, marker)
            },
            loadItem(done) {
                setTimeout(function () {
                    getData()
                    done();
                }, 400);
            },
            getMapInfo(plantInfo){
                var vm = this
                PlantItem(plantInfo)
                Push('plant-item');
            },
            handleWindowResize(event){
                this.windowWidth = event.currentTarget.innerWidth;
            },
            showPopover(event, direction, coverTarget = false) {
                this.popoverTarget = event;
                this.popoverDirection = direction;
                this.coverTarget = coverTarget;
                this.popoverVisible = true;
            },
            onSearch(){
                var vm = this
                vm.search = ''
                vm.isSearch = !vm.isSearch
            },
            getPhoto(plant){
                var vm = this
                return !_.isEmpty(plant) && _.isArray(plant) ? 'images/thumb_' + plant[0].file : plant
            },
            toggleView(){
                toggleView()
            },
            isNearestMarkerSort(){
                isNearestMarkerSort()
            },
            changeView(){
                var vm = this
                change_view()
            },
            deletePlant(){
                var vm = this
                deletePlants(vm.filtersPlantSelect)
            },
            back(){
                onHoldHandler()
            }
        },
        computed: {
            filtersPlantSelect(){
                var vm = this
                return _.map(_.filter(vm.plantItem.all, ['checkedPlant', true]))
            },
            getSearch() {
                var vm = this
                var searchRepositories = vm.mySighting.marker === 0 ? vm.plantItem.sighting : vm.plantItem.repositories
//                var searchRepositories = vm.plantItem.all
                vm.fuse = new window.Fuse(searchRepositories, vm.options);
                var sorted = _.sortBy(searchRepositories, [function (o) {
                    return vm.userLocation.latitude && vm.userLocation.longitude && vm.nearest.marker ? gps_distance(vm.userLocation.latitude, vm.userLocation.longitude, o.latitude, o.longitude) : o
                }])
                var fuseSearch =  (vm.search.trim() === '' ? sorted : vm.fuse.search(vm.search.trim()))

//                vm.listView.view ?: (vm.startIndex = 1 ? vm.startIndex = 0 : vm.startIndex = 1)
//                return vm.filterResult
                return  vm.listView.view ? fuseSearch : _.chunk(fuseSearch, vm.onOrientation);
            },
            onOrientation(){
                return parseInt(this.windowWidth / 100)
            }
        }
    }
</script>
