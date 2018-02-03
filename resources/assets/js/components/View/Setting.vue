<template>
    <v-ons-page>
        <v-ons-toolbar>
            <div class="center">{{ title }}</div>
            <div class="left">
                <v-ons-toolbar-button @click="changeView">
                    <v-ons-icon icon="ion-android-arrow-back"></v-ons-icon>
                </v-ons-toolbar-button>
            </div>
            <div class="right">
                <ons-toolbar-button><ons-icon icon="ion-gear-a" style="vertical-align: -4px; font-size: 28px;"></ons-icon></ons-toolbar-button>
            </div>
        </v-ons-toolbar>



        <div class="window"  >
            <div :style="{ 'background':  '#158 url(' + user.photoURL + ') center no-repeat', 'background-size': 'cover' }" style="height: calc(100% + 40px);margin: -20px;
        position: relative;
        width: calc(100% + 40px);
        -webkit-filter: blur(10px);
        -moz-filter: blur(10px);
        filter: blur(10px);"></div>
            <div class="box header" v-if="userCurrent">
                <img :src="user.photoURL" class="profile-image">

                <h1>{{userCurrent.name}} </h1>
                <h2>{{userCurrent.email}} </h2>

            </div>
            <div class="box footer">
                <ul>
                    <li><a href=""><span class="ion-ios-camera-outline"></span> 401</a></li>
                    <li><a href=""><span class="ion-ios-heart-outline"></span> 333K</a></li>
                    <li><a href=""><span class="ion-ios-person-outline"></span> 225M</a></li>
                </ul>
                <a @click="signOut" class="btn">Sign Out</a>
            </div>
        </div>





        <!--<v-ons-row class="profile-wrapper" v-if="user">
            <v-ons-col width="60px" class="profile-image-wrapper">
                <img :src="user.photoURL" class="profile-image">
            </v-ons-col>

            <v-ons-col v-if="userCurrent">
                <div class="profile-name">{{userCurrent.name}}</div>
                <div class="profile-email">{{userCurrent.email}}</div>
            </v-ons-col>

        </v-ons-row>
        <ons-list modifier="inset" class="settings-list">
            <ons-list-item  modifier="tappable">
                <ons-icon icon="ion-log-out" class="settings-logout"></ons-icon>
                Sign out
            </ons-list-item>
        </ons-list>-->

    </v-ons-page>

</template>
<style scoped>
    body {
        background: #383838;
        font-family: 'Open Sans', sans-serif;
        margin: 0;
        padding: 0;
    }

    a {
        color: inherit;
        text-decoration: none;
    }

    a:hover {
        color: rgba(0, 0, 0, .65);
    }

    a:hover {
        color: rgba(0, 0, 0, .45);
    }

    .window,
    .box,
    ul,
    li {
        margin: 0;
        overflow: hidden;
        padding: 0;
        position: relative;
    }

    ul {
        font-family: 'Fjalla One', sans-serif;
        list-style-type: none;
        text-transform: uppercase;
    }

    li {
        display: inline-block;
    }

    img {
        display: block;
        width: 100%;
    }

    .btn {
        background: rgba(255,255,255,0.8);
        border: 1px solid rgba(255,255,255,0.5);
        border-radius: 40px;
        color: rgba(0,0,0,0.75);
        display: block;
        font-size: 1em;
        font-weight: 400;
        height: 44px;
        letter-spacing: 5px;
        line-height: 42px;
        margin: 10px auto;
        padding: 0;
        position: relative;
        text-align: center;
        text-transform: uppercase;
        -webkit-transition: all .5s ease;
        transition: all .5s ease;
        vertical-align: middle;
        width: 60%;
    }

    .btn:hover {
        background: rgba(0,0,0,0.1);
        border: 1px solid rgba(0,0,0,0.15);
    }


    .window {
        box-shadow: 0 0 100px  rgba(0,0,0,0.25);
        height: 100%;
        width: 100%;
    }

    .header {
        background: rgba(0, 97, 145, 0.45);
        color: #FFF;
        height: 380px;
        left: 0;
        position: absolute;
        text-align: center;
        top: 0;
        width: inherit;
    }

    .header:before {
        border: 2px solid rgba(161, 220, 255, 0.34);
        border-radius: 100%;
        content: "";
        height: 140px;
        left: 0;
        margin: 67px auto;
        padding: 0;
        position: absolute;
        right: 0;
        top: 0;
        width: 140px;
        z-index: 2;
        -webkit-transform: scale(1.24, 1.24);
        -moz-transform: scale(1.24, 1.24);
        transform: scale(1.24, 1.24);
    }

    .header img {
        border: 5px solid #A1DCFF;
        border-radius: 100%;
        height: 140px;
        margin: 4em auto 2.5em;
        object-fit: cover;
        width: 140px;
    }

    .header h2 {
        display: inline-block;
        font-family: 'Quicksand', sans-serif;
        font-size: 28px;
        font-weight: 400;
        letter-spacing: -2px;
        margin: 0 auto;
        padding: 0;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.15);
    }

    .header h4 {
        color: rgba(255, 255, 255, 0.75);
        display: block;
        font-size: 15px;
        margin: 0 auto;
        padding: 5px 0 0;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.15);
        text-transform: uppercase;
    }

    .footer {
        background: rgba(0, 97, 145, 0.75);
        bottom: 0;
        color: #FFF;
        left: 0;
        position: absolute;
        text-align: center;
        top: 380px;
        width: inherit;
    }

    .footer ul {
        display: flex;
        font-size: 16px;
        font-weight: 400;
        height: 40px;
        line-height: 40px;
        padding: 20px 20px;
    }

    .footer li:first-child {
        border: 0;
    }

    .footer li {
        border-left: 2px solid rgba(255, 255, 255, .15);
        font-family: 'Quicksand', sans-serif;
        padding: 0 4px 0 6px;
        width: 100%;
    }

    .footer a span {
        color: #9CDFF5;
        display: inline-block;
        font-size: 26px;
        padding: 0 4px 0 0;
        vertical-align: middle;
    }
</style>
<script>
    import {change_view} from './../Ajax/getData'
    export default{
        data(){
            return {
                title: 'Profile',
                currentUser: null,
                user: firebase.auth().currentUser,
            }
        },
        mounted(){
            var vm = this,
                user = vm.user.displayName,
                uid = vm.user.uid;

            axios.get(`api/user/${user}/${uid}`).then(function (response) {
                vm.currentUser =  response.data
            })

        },
        methods: {
            signOut(){
                firebase.auth().signOut().then(function () {
                    axios.get('api/repository/signout')
                }, function (error) {
                    console.error('Sign Out Error', error);
                });
            },
            changeView(){
                change_view()
            },
        },
        computed:{
            userCurrent(){
                var vm = this
                return vm.currentUser !== null ?  vm.currentUser : false
            }
        }
    }
</script>
