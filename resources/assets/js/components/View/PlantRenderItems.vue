<template>
    <v-ons-list-item v-for='(flora, index) in plantRepository' :key="index" @click="getMapInfo(flora)">

        <div class="left">
            <img class="list-item__thumbnail"
                 :src="flora.photos[0].file ? flora.photos[0].file : 'https://placekitten.com/g/40/40'">
        </div>
        <div class="center">
            <span class="list-item__title">{{flora.name}}</span><span class="list-item__subtitle">{{flora.description}}</span>
        </div>
    </v-ons-list-item>
</template>
