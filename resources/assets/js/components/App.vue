<template>


    <v-ons-splitter>
        <v-ons-splitter-side
                swipeable
                collapse=""
                side="left"
                :open.sync="openSide.side"
                animation="reveal"
        >
            <v-ons-page>

                <v-ons-list>
                    <v-ons-list-header>{{ userCurrent }}</v-ons-list-header>
                    <v-ons-list-item v-for="(page, index) in pages"
                                     :key="index"
                                     tappable modifier="chevron"
                                     @click="changeView(page)"
                    >
                        <div class="center">{{ page.name }}</div>
                    </v-ons-list-item>

                </v-ons-list>
            </v-ons-page>
        </v-ons-splitter-side>


        <v-ons-splitter-content>
            <v-ons-gesture-detector>
            <!--<keep-alive :exclude="isAlive.isWatch ?  null   :'plant-item-map-view'">-->
            <keep-alive exclude="view-timeline">
                <component :is="currentPage.url" :page-name="currentPage.name"></component>
            </keep-alive>
            </v-ons-gesture-detector>
        </v-ons-splitter-content>

    </v-ons-splitter>

</template>
<style scoped>
/*

    .pulse {
        position: fixed;
        top: 45%;
        left: 50%;
        margin-left: -36px;
        width: 72px;
        height: 72px;
        line-height: 72px;
        font-family: sans-serif;
        font-weight: 700;
        font-size: 34px;
        text-align: center;
        color: #5abdde;
    }

    .pulse span,
    .pulse:before,
    .pulse:after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        border: 0 solid #5abdde;
        border-radius: 100%;
        -webkit-animation: da-pulse 1.5s ease-in-out 0s infinite;
        animation: da-pulse 1.5s ease-in-out 0s infinite;
    }

    .pulse span {
        border-color: #5abdde;
        border-width: 4px;
        top: 6px;
        left: 6px;
        right: 6px;
        bottom: 6px;
    }

    .pulse:before {
        border-color: #1f7b9a;
        border-width: 2px;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
    }

    .pulse:after {
        border-color: #16596f;
        border-width: 1px;
        top: -5px;
        left: -5px;
        right: -5px;
        bottom: -5px;
    }

    @-webkit-keyframes da-pulse {
        0%,
        100% {
            -webkit-transform: scale(1.25);
            transform: scale(1.25);
            opacity: 0;
        }
        48%,
        52% {
            -webkit-transform: scale(1);
            transform: scale(1);
            opacity: 1;
        }
    }

    @keyframes da-pulse {
        0%,
        100% {
            -webkit-transform: scale(1.25);
            transform: scale(1.25);
            opacity: 0;
        }
        48%,
        52% {
            -webkit-transform: scale(1);
            transform: scale(1);
            opacity: 1;
        }
    }*/
</style>
<script>
    import {
        chatUserView,
        isAlive,
        onHoldHandler,
        isDisable,
        usersChat,
        currentPageSwitcher,
        currentPage,
        PlantNavigator,
        SWIPE_SIDE,
        change_view,
        getUserLocation,
        isAuth,
        toggleAuth,
        user,
        getCurrentUser,
        getData,
        storeUserDetail
    } from './Ajax/getData'
    export default {
        components: {
            'plant-navigator': PlantNavigator
        },
        data(){
            return {
                user,
                isDisable,
                isAuth,
                currentPage: currentPage,
                pages: [
                    {
                        url: 'plant-navigator',
                        name: 'Repositories of Plants'
                    }, {
                        url: 'plant-navigator',
                        name: 'Gallery'
                    },
                    {
                        url: 'navigation-map',
                        name: 'Map View'
                    },
                   /* {
                        url: 'navigation-timeline',
                        name: 'Recent Searches'
                    },*/
                    {
                        url: 'chat-manage',
                        name: 'Chat '
                    },
                    {
                        url: 'view-settings',
                        name: 'Setting'
                    }

                ],
                openSide: SWIPE_SIDE,
                userLocation: null,
                positionOptions: {
                    enableHighAccuracy: true,
                    timeout: 10000,
                    maximumAge: 10000
                },
                watchId: null,
                user: null,
                currentUser: null,
                userDetail: user,
                userRef: null,
                isAlive
            }
        },
        mounted(){
            var vm = this
            vm.userRef = firebase.database().ref('users')
            vm.userRef.on('value', function (snapshot) {
                var users = snapshot.val();
                var preparedUsers = []
                for (var user in users) {
                    if (users.hasOwnProperty(user)) {
                        preparedUsers.push({
                            uid: user,
                            name: users[user].name,
                            avatar: users[user].avatar
                        })
                    }
                }
                vm.onUserChanged(preparedUsers)

            })
            setTimeout(function(){
                axios.get(`api/user/firebase/${vm.user.uid}`).then(function (response) {
                    vm.currentUser = response.data
                    getCurrentUser(response.data)
                })
            }, 3000);
            //user/admin/chat'
            axios.get(`api/user/admin/chat`).then(function (response) {
                chatUserView(response.data)
            })
            getData()
            document.addEventListener('hold', function (event) {
                onHoldHandler()
            });
        },
        created(){
            var vm = this;
            if ('geolocation' in navigator) {
                navigator.geolocation.getCurrentPosition(vm.onSuccess, vm.onError, vm.positionOptions)
            }

            vm.user =  firebase.auth().currentUser

        },
        methods: {
            onUserChanged(users){
                usersChat(users)
            },
            changeAuth(){
                toggleAuth()
            },
            onSuccess (position) {
                var vm = this
                getUserLocation(position.coords)
                setTimeout(function () {
                    vm.initialize = "Success!"
                }, 1000)
            },

            onError: function (error) {
                var msg = 'An unknown error occurred while requesting your location.'

                // https://www.w3.org/TR/geolocation-API/#position_error_interface
                switch (error.code) {
                    case 1:
                        msg = 'The document does not have permission to use the Geolocation API.'
                        break
                    case 2:
                        msg = 'The position of the device could not be determined.'
                        break
                    case 3:
                        msg = 'The position request timed out.'
                        break
                    default:
                        break
                }
            },
            md() {
                return this.$ons.platform.isAndroid();
            },
            changeView(page){
                var vm = this;
                currentPageSwitcher(page.url, page.name)
                change_view()
            }
        },
        computed: {
            title() {
                return this.tabs[this.activeIndex].label;
            },
            userCurrent(){
                var vm = this
                return vm.currentUser ? vm.currentUser.name : null
            }

        }

    }
</script>
