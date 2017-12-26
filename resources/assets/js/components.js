/**
 * Created by Lorilla on 02/10/2017.
 */
window.Vue = require('vue');
import Plant from  './components/View/Plant.vue'
import MySighting  from  './components/View/MySighting.vue'
import PlantItem from  './components/View/PlantItem.vue'
import PlantItemMapView from  './components/View/PlantMapView.vue'
import PlantItemNavigator from  './components/View/PlantItemNavigator.vue'
import Map from  './components/View/Maps.vue'
import CapturePhoto from  './components/View/CapturePhoto.vue'
import SearchScope from  './components/View/SearchScope.vue'
import SlideFade from  './components/Transition/no-mode-translate-fade.vue'
import Toolbar from  './components/Toolbar.vue'
import AutoComplete from  './components/AutoComplete.vue'
import MapSearch from  './components/View/MapSearch.vue'
import SearchResult from  './components/View/SearchResult.vue'
import LoginUser from  './components/View/Login.vue'
import SearchResultMapScope from  './components/View/SearchResultMapScope.vue'
import FloatingAction from  './components/FloatingActionBar.vue'
import staggeredFade from  './components/Transition/staggered-fade.vue'
import noModeTranslateFade from  './components/Transition/no-mode-translate-fade.vue'
import App from './components/App.vue'
Vue.component('plant-item-map-view', function (resolve, reject) {
        resolve(PlantItemMapView)
});
Vue.component('splitter-content', function (resolve, reject) {
        resolve(App)
});
Vue.component('view-plant', function (resolve, reject) {
    setTimeout(function () {
        resolve(Plant)
    }, 100)
});
Vue.component('plant-item', function (resolve, reject) {
    setTimeout(function () {
        resolve(PlantItem)
    }, 100)
});
Vue.component('view-map', function (resolve, reject) {
    setTimeout(function () {
        resolve(Map)
    }, 100)
});
Vue.component('my-sightings', function (resolve, reject) {
    setTimeout(function () {
        resolve(MySighting)
    }, 100)
});
Vue.component('plant-item-navigator', function (resolve, reject) {
    setTimeout(function () {
        resolve(PlantItemNavigator)
    }, 100)
});
Vue.component('staggered-fade', function (resolve, reject) {
    setTimeout(function () {
        resolve(staggeredFade)
    }, 100)
});
Vue.component('no-mode-translate-fade', function (resolve, reject) {
    setTimeout(function () {
        resolve(noModeTranslateFade)
    }, 100)
});
Vue.component('custom-toolbar', function (resolve, reject) {
    resolve(Toolbar)
});
Vue.component('login-user', function (resolve, reject) {
    resolve(LoginUser)
});
Vue.component('floating-action', function (resolve, reject) {
    resolve(FloatingAction)
});
Vue.component('capture-photo', function (resolve, reject) {
    resolve(CapturePhoto)
});
Vue.component('search-scope', function (resolve, reject) {
    resolve(SearchScope)
});
Vue.component('auto-complete', function (resolve, reject) {
    resolve(AutoComplete)
});
Vue.component('search-map', function (resolve, reject) {
    resolve(MapSearch)
});
Vue.component('search-result', function (resolve, reject) {
    resolve(SearchResult)
});
Vue.component('search-result-scope', function (resolve, reject) {
    resolve(SearchResultMapScope)
});
Vue.component('slide-fade', function (resolve, reject) {
    resolve(SlideFade)
});


