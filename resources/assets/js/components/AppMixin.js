/**
 * Created by Edward Lance Lorilla on 1/24/2018.
 */
import {
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
    getData,
    storeUserDetail
} from './Ajax/getData'
export var AppMixin =  {
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
                    name: 'My Sightings'
                },
                {
                    url: 'view-map',
                    name: 'Map View'
                },
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
            userRef: null
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
            axios.get(`api/user/${vm.user.displayName}/${vm.user.uid}`).then(function (response) {
                vm.currentUser = response.data
            })
        }, 3000);
        getData()

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