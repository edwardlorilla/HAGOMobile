
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
// Vue.component('example', require('./components/Example.vue'));
import VueRouter from 'vue-router';
import VueOnsen from 'vue-onsenui'; // This already imports 'onsenui'
import routes from './routes.js';
import App from './components/App.vue';
import leaflet from 'leaflet'
Vue.use(VueOnsen);


const router = new VueRouter({
    mode: 'history',
    base: __dirname,
    linkActiveClass: 'active',
    routes: routes
});
new Vue(Vue.util.extend({router}, App)).$mount('#app');
