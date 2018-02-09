<template>
    <v-ons-page  id="main"  >

        <v-ons-toolbar>
            <div class="left">
                <v-ons-toolbar-button @click="changeView">
                    <v-ons-icon icon="ion-navicon, material:md-menu"></v-ons-icon>
                </v-ons-toolbar-button>
            </div>
            <div class="center">Lists</div>
        </v-ons-toolbar>
        <v-ons-progress-bar v-if="!chats.users.length > 0" indeterminate></v-ons-progress-bar>
        <v-ons-list >
            <v-ons-lazy-repeat
                    v-if="chats.users.length > 0"
                    :render-item="renderItem"
                    :length="chats.users.length"
            >
            </v-ons-lazy-repeat>
        </v-ons-list>
    </v-ons-page>
</template>
<script>
    import {chats,ChatPush, change_view, getChatInfo}  from './../Ajax/getData'
    export default{
        data(){

            return {
                chats,
                renderItem(i)  {
                    return new Vue({
                        template: `
                            <v-ons-list-item
                                     v-if="getUser"
                                     tappable
                                     modifier="chevron"
                                     :key="index"
                                     @click="chat"
                                 >
                                <div class="left">
                                    <img class="list-item__thumbnail" :src="getUser.avatar">
                                </div>
                                <div class="center">
                                    <span class="list-item__title">Cutest kitty</span><span
                                        class="list-item__subtitle">On the Internet</span>
                                </div>
                            </v-ons-list-item>
                          `,
                        methods:{
                          chat(){
                              var vm = this
                              getChatInfo(vm.chats.users[vm.index])
                              ChatPush('chat');
                          }
                        },
                        computed: {
                            getUser(){
                                var vm = this
                                return _.isEmpty(vm.chats.users[vm.index]) ? false : vm.chats.users[vm.index]
                            }
                        },
                        data() {
                            return {
                                chats,
                                index: i
                            };
                        }
                    })
                },

            }
        },
        mounted()
        {
            var vm = this;


        },
        methods:{
            changeView(){
                var vm = this
                change_view()
                vm.onBack = true
            },
        }
    }
</script>
