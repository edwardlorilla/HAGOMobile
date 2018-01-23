<template>
    <v-ons-page id="main">
        <v-ons-toolbar>
            <div class="left">
                <v-ons-back-button></v-ons-back-button>
            </div>
            <div class="center">
                Add Flora
            </div>
        </v-ons-toolbar>
        <v-ons-progress-bar v-if="!location.latitude && !showNearest" indeterminate></v-ons-progress-bar>
        <div class="mainbox">
            <div class="insidebox">


                <div  ref="imagePickerArea">

                    <img ref="imag" :src="image" />
                    <div v-if="!image">
                        <section style="margin: 16px">
                            <h2>Select an image</h2>
                            <input type="file" ref="fileOnChange" @change="onFileChange"  accept="image/*" capture="camera" style="display:none;">
                            <v-ons-button @click="buttonFile" class="btn" modifier="large">Add Plant
                            </v-ons-button>
                        </section>
                    </div>
                    <div v-else>
                        <v-ons-list tappable >
                            <v-ons-list-item modifier="nodivider">
                                <div class="center">
                                    <v-ons-input placeholder="Title" float
                                                 v-model="repositoryInfo.title"
                                                 style="width: 100%"
                                    >
                                    </v-ons-input>
                                </div>

                            </v-ons-list-item>
                            <v-ons-list-item modifier="nodivider">
                                <div class="center">
                                    <v-ons-input placeholder="Description" float
                                                 v-model="repositoryInfo.description"
                                                 style="width: 100%"
                                    >
                                    </v-ons-input>
                                </div>
                            </v-ons-list-item>
                            <v-ons-list-item>
                                <div class="center" style="display: flex;justify-content: space-between;">
                                    <v-ons-button @click="addBaseColor" class="btn" style="width:48%;">Add
                                    </v-ons-button>
                                    <v-ons-button @click="removeImage" class="btn-stop" style="width:48%;">Remove
                                    </v-ons-button>
                                </div>
                            </v-ons-list-item>
                        </v-ons-list>
                        <v-ons-list-header>
                            Get nearest color
                        </v-ons-list-header>
                        <v-ons-list>
                            <virtual-list :size="78" :remain="20" >
                                <div v-for="(nearest,index, key) in getNearestColor" :key="index">
                                    <v-ons-list-item v-for="near in nearest" :key="index" tappable>
                                        <div class="left">
                                            <v-ons-radio
                                                    :input-id="'radio-' + index"
                                                    :value="near.id"
                                                    v-model="selectedPlant"
                                            >
                                            </v-ons-radio>

                                        </div>
                                        <div class="right">
                                            <clazy-load :src="getPhoto(near.photo)">
                                                <transition name="fade" slot="image">
                                                    <img class="thumbnail"
                                                         style="object-fit: cover;width: 60px; height:60px;"
                                                         :src="getPhoto(near.photo)">
                                                </transition>
                                                <transition name="fade" slot="placeholder">
                                                    <div class="center" slot="placeholder">
                                                        <v-ons-progress-circular indeterminate></v-ons-progress-circular>
                                                    </div>
                                                </transition>
                                            </clazy-load>
                                        </div>
                                        <div :for="'radio-' + index" class="center">
                                            <span class="list-item__title">{{near.hexValue}}</span><span class="list-item__subtitle">{{near.description}}</span>
                                        </div>
                                    </v-ons-list-item>

                                </div>
                            </virtual-list>
                        </v-ons-list>


                    </div>
                </div>





                <!-- <div v-for="(nearest,index, key) in sortList(getNearestColor)">
                     <div class="nearColor" v-for="near in nearest">
                         {{near.hexValue}}
                         <div v-for="property in near.property" class="base_color"
                              :style="{'background-color': property.hexColor}">
                         </div>
                     </div>
                     <hr>
                 </div>-->

            </div> <!-- Close .insidebox -->


        </div>
    </v-ons-page>
</template>
<style scoped>
    .fade-enter, .fade-leave-to {
        opacity: 0;
    }
    .base_color {
        width: 50px;
        height: 50px;
    }

    #pallete {
        display: flex;
    }

    img {
        width: 100%;
        margin: auto;
        display: block;
        margin-bottom: 10px;
    }

    .nearColor {
        display: flex;
    }


</style>
<script>
    import {
        plantPush,
        currentPage,
        capturePhoto,
        cnvrtRGBClrToHex,
        hexColorDelta,
        cameraInfo,
        FormDataPost,
        urltoFile,
        plantItem,
        getSimilar,
        setSimilar
    } from './../Ajax/getData'
    import virtualList from 'vue-virtual-scroll-list'
    export default{
        data(){
            return {
                showNearest: false,
                plantLimit: 10,
                selectedPlant: null,
                watchID: null,
                currentPage: currentPage,
                hexColor: [],
                image: '',
                palletes: null,
                location: {
                    latitude: null,
                    longitude: null,
                    altitude: null
                },
                repositoryInfo: {
                    title: '',
                    description: ''
                },
                urlFile: null,
                baseColor: plantItem
            }
        },
        components: {'virtual-list': virtualList },
        methods: {
            buttonFile(){
                var vm = this
                vm.$refs.fileOnChange.click()
            },
            sortList(value){
                return value.splice(0, 5)
            },
            getPhoto(photo){
                return !_.isEmpty(photo.file) ? 'images/thumb_' + photo.file : photo
            },
            hexColorDelta(hex1, hex2) {
                return hexColorDelta(hex1, hex2)
            },
            onFileChange(e) {
                this.hexColor = []
                var files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file) {

                //urltoFile(url, file.name, mimeType)
                var image = new Image();
                var reader = new FileReader();
                var vm = this;
                vm.urlFile = file

                reader.onload = function (event) {
                    // The file's text will be printed here
                    vm.image = event.target.result
                };

                reader.readAsDataURL(file);
                var img = this.$refs.imag
                if (img.naturalWidth) {
                    vm.onImageLoad(img);
                } else {
                    img.onload = function () {
                        vm.onImageLoad(img);
                    };
                }
            },
            removeImage: function (e) {
                var vm = this
                vm.image = '';
                vm.hexColor = [],
                vm.palletes = null
                vm.repositoryInfo.title =  ''
                vm.repositoryInfo.description = ''
            },
            onImageLoad(img){
                var vm = this
                var colorThief = new ColorThief();
                var rgb = colorThief.getPalette(img);
                vm.palletes = rgb
                for (var j = 0; j < rgb.length; j++) {
                    vm.hexColor.push(vm.cnvrtRGBClrToHex(rgb[j].join(', ')))
                }

            },
            cnvrtRGBClrToHex(rgbClr){
                return cnvrtRGBClrToHex(rgbClr)
            },
            palletesConvertHex(){
                var vm = this
                return _.map(vm.palletes, function (obj) {
                    return vm.cnvrtRGBClrToHex(obj.toString())
                });
            },
            addBaseColor(){
                var vm = this,
                    hexArray = vm.palletesConvertHex();

                FormDataPost(vm.image, hexArray, vm.location.latitude, vm.location.longitude, vm.location.altitude, vm.repositoryInfo.title, vm.repositoryInfo.description, vm.selectedPlant)

            },
            showPosition(position) {
                var vm = this
                vm.location.latitude = position.coords.latitude
                vm.location.longitude = position.coords.longitude
                vm.location.altitude = position.coords.altitude
                navigator.geolocation.clearWatch(this.watchID);
            }
        },
        mounted(){
            var vm = this
            if (capturePhoto) {
                vm.onFileChange(capturePhoto)
            }
            if ("geolocation" in navigator) {
                /* geolocation is available */
                vm.watchID = navigator.geolocation.watchPosition(function (position) {
                        vm.showPosition(position)
                    }, function (error) {
                        switch (error.code) {
                            case error.PERMISSION_DENIED:
                                alert("user did not share geolocation data");
                                break;

                            case error.POSITION_UNAVAILABLE:
                                alert("could not detect current position");
                                break;

                            case error.TIMEOUT:
                                alert("retrieving position timed out");
                                break;

                            default:
                                alert("unknown error");
                                break;
                        }
                    },
                    {enableHighAccuracy: true});
            }

        },
        beforeMount(){
            console.log(1)
        },
        beforeDestroy(){
            navigator.geolocation.clearWatch(this.watchID);
        },
        computed: {
            splicePlant(){
                var vm = this
                return _.isEmpty(vm.getNearestColor) ? [] : vm.getNearestColor.splice(0,5)
            },
            getNearestColor(){
                var vm = this,
                    objectValue = [],
                    hexValue = vm.hexColor,
                    hexColor = [],
                    hexColorArray = [],
                    hexArray = [],
                    hexColorItem = [],
                    nearestColor = _.map(vm.baseColor.all, function (o) {
                        for (var j = 0; j < hexValue.length; j++) {
                            for (var i = 0; i < o.color.colors.split(',').length; i++) {
                                hexColor = vm.hexColorDelta(hexValue[j], o.color.colors.split(',')[i]);
                                if (hexColor > 0.90) {
                                    hexArray.push({
                                        photo: !_.isEmpty(o.photos) ? (_.isArray(o.photos) ? o.photos[0] : o.photos) : null,
                                        id: o.id,
                                        description: o.description,
                                        hexColor: '#' + o.color.colors.split(',')[i],
                                        resultPercentage: hexColor,
                                        hexCompareTo: hexValue[j],
                                        hexValue: o.title
                                    })
                                    hexColorItem.push(hexValue[j], hexColor)
                                }
                            }
                        }

                        var hexArrays = _.chain(hexArray)
                            .uniqBy('hexColor')
                            .sortBy('resultPercentage')
                            .reverse()
                            .groupBy('hexValue')
                            .toPairs()
                            .map(function (currentData) {
                                currentData.push(currentData[1].length)
                                currentData.push(currentData[1][0].id)
                                currentData.push(currentData[1][0].photo)
                                currentData.push(currentData[1][0].description)
                                return _.zipObject(["hexValue", "property", "countHex", 'id', 'photo', 'description'], currentData);
                            })
                            .value();
                        objectValue.push(hexArrays)
                        hexArray = []
                    });
                ;
                // return  objectValuevar
                return _.sortBy(objectValue, function (o, value) {
                    return o[0] ? o[0].countHex : null
                }).reverse()
            }
        },
    }


</script>