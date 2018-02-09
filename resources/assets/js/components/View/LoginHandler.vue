<template>
   <div>

           <component v-bind:is="currentView"></component>

   </div>
</template>
<style>

</style>
<script>
    export default{
        data(){
            return{

            }
        },
        computed:{
            currentView(){
                var vm =  this
                return vm.$ons.platform.isAndroidPhone() || vm.$ons.platform.isIPhone() ? 'login-user' : 'login-browser'
            }
        }
    }
</script>
