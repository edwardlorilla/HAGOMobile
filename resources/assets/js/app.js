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
import DashBoard from './components/DashBoard.vue';
import Repositories from './components/Repositories/index.vue';
import RepositoryCreate from './components/Repositories/create.vue';
import User from './components/User/index.vue';
import UserEdit from './components/User/edit.vue';
import loginForm from './components/View/LoginHandler.vue';
import registerForm from './components/View/Register.vue';
import {readData} from './components/Ajax/getData';
import AppView from './components/AppView.vue';
import components from './components'
import VueRecyclerviewNew from 'vue-recyclerview'
import VueRouter from 'vue-router'
import VueClazyLoad from 'vue-clazy-load';
import InfiniteScroll from 'v-infinite-scroll'
import Vue2Filters from 'vue2-filters'
import VueHotkey from 'v-hotkey'
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css'

Vue.use(ElementUI)

Vue.use(VueHotkey)
Vue.use(Vue2Filters)
Vue.use(InfiniteScroll)
Vue.use(VueClazyLoad);
Vue.use(VueRouter)
Vue.use(VueRecyclerviewNew)
Vue.use(VueOnsen);

const router = new VueRouter({
    mode: 'history',
    linkActiveClass: 'w3-blue',

    routes: [
        {
            path: '/login',
            component: loginForm,
            name:'login',
            beforeEnter: (function (to, from, next) {
                var vm = this
                    firebase.auth().onAuthStateChanged(function (user) {

                        if (user) {
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
            children: [
                { path: '', component: DashBoard },
                { path: 'users', component: User, title: 'Users'},
                { path: 'users/:id', component: UserEdit },
                { path:'repositories', component: Repositories},
                { path:'repositories/create', component: RepositoryCreate},
            ],
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
