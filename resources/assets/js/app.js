
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

import VueOnsen from 'vue-onsenui'; // This already imports 'onsenui'
import App from './components/App.vue';
import loginForm from './components/View/Login.vue';
import AppView from './components/AppView.vue';
import components from './components'
import VueRecyclerviewNew from 'vue-recyclerview'
import VueRouter from 'vue-router'

Vue.use(VueRouter)
Vue.use(VueRecyclerviewNew)
Vue.use(VueOnsen);
const router = new VueRouter({
    mode: 'history',
    routes: [
        { path: '/login', component:   loginForm,
            beforeEnter:(function(to, from, next){
                firebase.auth().onAuthStateChanged(function(user) {
                    if (user) {
                        next('/')
                    } else {
                        next()
                    }
                });
            })
        },
        { path: '/', component:   App,
            beforeEnter:(function(to, from, next){
                firebase.auth().onAuthStateChanged(function(user) {
                    if (user) {
                        next()
                    } else {
                        next('/login')
                    }
                });
            })
        },

    ]
})
new Vue(Vue.util.extend({router, mounted(){

}},AppView)).$mount('#app');
