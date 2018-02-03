<template>
   <v-ons-page>
       <v-ons-toolbar class="w3-bar w3-top w3-black w3-large" style="z-index:4">
           <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i></button>
           <span class="w3-bar-item w3-right">HAGO</span>
       </v-ons-toolbar>

       <!-- Sidebar/menu -->
       <nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
           <avatar :photo="user.photoURL"
                   :user="userCurrent"
           ></avatar>
           <hr>
           <div class="w3-container">
               <h5>Dashboard</h5>
           </div>
          <side-bar></side-bar>
       </nav>


       <!-- Overlay effect when opening sidebar on small screens -->
       <div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

       <!-- !PAGE CONTENT! -->
       <div class="w3-main" style="margin-left:300px;margin-top:10px;">

           <!-- Header -->


          <main-content></main-content>


           <!-- Footer -->
           <!--<footer class="w3-container w3-padding-16 w3-light-grey">
               <p>Powered by <a target="_blank">HAGO</a></p>
           </footer>-->

           <!-- End page content -->
       </div>

   </v-ons-page>
</template>
<style scoped>
    footer {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        background-color: red;
        color: white;
        text-align: center;
    }
</style>
<script>
    import {AppMixin} from './AppMixin'
    import {listUser, fetchAll} from './Ajax/getData'
    import Avatar from './Avatar.vue'
    import SideBar from './SideBar.vue'
    import MainContent from './MainContent.vue'

    export default {
        mixins: [AppMixin],
        mounted(){
            axios.get(`../api/user/${firebase.auth().currentUser.uid}`).then(function (response) {
                listUser(response.data)
            })
            axios.all([
                axios.get(`../api/distribution/${firebase.auth().currentUser.uid}`),
                axios.get(`../api/category/${firebase.auth().currentUser.uid}`),
                axios.get(`../api/family/${firebase.auth().currentUser.uid}`),
                axios.get(`../api/vegetation/${firebase.auth().currentUser.uid}`),
            ]).then(axios.spread(function (distribution, category, family, vegetation) {
                fetchAll(distribution.data, category.data, family.data, vegetation.data)
            }));
        },
        components:{
            Avatar,
            SideBar,
            MainContent
        }
    }
</script>
