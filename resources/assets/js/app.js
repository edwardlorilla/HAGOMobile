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
import App from './components/AppHandler.vue';
import loginForm from './components/View/LoginHandler.vue';
import registerForm from './components/View/Register.vue';
import {readData} from './components/Ajax/getData';
import AppView from './components/AppView.vue';
import components from './components'
import VueRecyclerviewNew from 'vue-recyclerview'
import VueRouter from 'vue-router'
import VueClazyLoad from 'vue-clazy-load';
import InfiniteScroll from 'v-infinite-scroll'
Vue.use(InfiniteScroll)
Vue.use(VueClazyLoad);
Vue.use(VueRouter)
Vue.use(VueRecyclerviewNew)
Vue.use(VueOnsen);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/login',
            component: loginForm,
            name:'login',
            beforeEnter: (function (to, from, next) {
                var vm = this
                firebase.auth().onAuthStateChanged(function (user) {
                    if (user ) {
                        next('/')
                    } else {
                        next()
                    }
                });
            })
        },
        {
            path: '/register',
            component: registerForm,
            name:'register',
            beforeEnter: (function (to, from, next) {
                firebase.auth().onAuthStateChanged(function (user) {
                    if (user) {
                        next({ path: '/' })
                    } else {
                        next()
                    }
                });
            })
        },
        {
            path: '/', component: App,
            beforeEnter: (function (to, from, next) {
                firebase.auth().onAuthStateChanged(function (user) {
                    if (user ) {
                        next()
                    } else {
                        next('/login')
                    }
                });
            })
        },

    ]
})
new Vue(Vue.util.extend({
    router,
    methods:{
        handleConnectivityChange(status) {
            if(status){
                if('serviceWorker' in navigator && 'SyncManager' in window){
                    navigator.serviceWorker.ready
                        .then(function(sw){
                            sw.sync.register('sync-new-posts')
                        })
                        .catch(function (error) {
                            console.log(error)
                        })
                }else{

                }

            }
        }
    },
    created(){
        document.addEventListener('init', function (e) {
            var scrollValue = 0;
            var page = e.target;

            page.querySelector('.page__content').addEventListener('scroll', function (e) {
                var delta = this.scrollTop - scrollValue;
                if (Math.abs(delta) > 8) {
                    page.classList.toggle('hidden-bar', delta > 0 && scrollValue > 36)
                    scrollValue = this.scrollTop;
                }
            });
        })
    }
}, AppView)).$mount('#app');
