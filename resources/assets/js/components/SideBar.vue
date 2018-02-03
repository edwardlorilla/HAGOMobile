<template>
    <div class="w3-bar-block">
        <a class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>&nbsp; Close Menu</a>
        <router-link :to="{ path: '/'}" class="w3-bar-item w3-button w3-padding">
            <i class="fa fa-eye fa-fw"></i>&nbsp; Overview
        </router-link>
        <router-link :to="{ path: 'users'}" class="w3-bar-item w3-button w3-padding" >
            <i class="fa fa-users fa-fw"></i>&nbsp; Users
        </router-link>
        <router-link :to="{ path: 'repositories'}" class="w3-bar-item w3-button w3-padding" >
            <i class="fa fa-leaf" aria-hidden="true"></i>&nbsp; Repositories
        </router-link>
        <a class="w3-bar-item w3-button w3-padding"><i class="fa fa-bullseye fa-fw"></i>&nbsp; Geo</a>
        <a class="w3-bar-item w3-button w3-padding"><i class="fa fa-diamond fa-fw"></i>&nbsp; Orders</a>
        <a class="w3-bar-item w3-button w3-padding"><i class="fa fa-bell fa-fw"></i>&nbsp; News</a>
        <a class="w3-bar-item w3-button w3-padding"><i class="fa fa-bank fa-fw"></i>&nbsp; General</a>
        <a class="w3-bar-item w3-button w3-padding"><i class="fa fa-history fa-fw"></i>&nbsp; History</a>
        <a class="w3-bar-item w3-button w3-padding"><i class="fa fa-cog fa-fw"></i>&nbsp; Settings</a><br><br>
    </div>
</template>

<script>
    export default{
        data(){
            return{
            }
        },
        computed: {
            routes: function () {
                var routes = [];
                for (var i in this.$router.options.routes) {
                    if (!this.$router.options.routes.hasOwnProperty(i)) {
                        continue
                    }
                    var route = this.$router.options.routes[i];
                    if(route.hasOwnProperty('title')) {
                        routes.push(route);
                    }
                }
                return routes;
            }
        }
    }
</script>
