<template>
    <div class="w3-container w3-row">
        <div class="w3-col s4">
            <img :src="photo" class="w3-circle w3-margin-right" style="width:46px">
        </div>
        <div class="w3-col s8 w3-bar">
            <span>Welcome, <strong>{{user}}</strong></span><br>
            <a href="#" class="w3-bar-item w3-button"><i class="fa fa-envelope"></i></a>
            <a href="#" class="w3-bar-item w3-button"><i class="fa fa-user"></i></a>
            <a href="#" class="w3-bar-item w3-button"><i class="fa fa-cog"></i></a>
        </div>
    </div>
</template>
<style>

</style>
<script>
    export default{
        props:['photo', 'user'],
        data(){
            return{

            }
        }
    }
</script>
