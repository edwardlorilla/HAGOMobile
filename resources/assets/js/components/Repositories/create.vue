<template>
    <div>
        <div class="w3-panel w3-bottombar w3-margin">
            <h2>Add Repository</h2>
        </div>
        <div class="w3-row">
            <div class="w3-container w3-half">

                <img ref="imag" style="width: 90%;" :src="image"/>
                <div v-if="!image">
                    <section >
                        <h2>Select an image</h2>
                        <input type="file" ref="fileOnChange" @change="onFileChange" accept="image/*" capture="camera"
                               style="display:none;">
                        <v-ons-button @click="buttonFile" class="btn" modifier="large">Add Plant
                        </v-ons-button>

                    </section>
                </div>
                <div id="pallete">
                    <div v-for="pallete in palletes" class="base_color"
                         :style="{'background-color': 'rgb(' + pallete.join( ', ') + ')' }"></div>
                </div>

                <div>
                    <label>Name</label>
                    <input v-model="repositoryInfo.title" class="w3-input w3-border" type="text"
                           placeholder="Name">
                </div>
                <div >
                    <label>Economic Importance</label>
                    <textarea name="economicImportance" v-model="repositoryInfo.economicImportance" class="w3-input w3-border" ></textarea>

                </div>
                <div >
                    <label>Description</label>
                    <textarea name="description" v-model="repositoryInfo.description" class="w3-input w3-border" ></textarea>

                </div>

            </div>
            <div class="w3-container w3-half">
                <div class="w3-row-padding">

                    <div class="w3-third">
                        <label>Species</label>
                        <input v-model="repositoryInfo.species" class="w3-input w3-border" type="text"
                               placeholder="Species">
                    </div>
                    <div class="w3-third">
                        <label>Common Name</label>
                        <input v-model="repositoryInfo.commonName" class="w3-input w3-border" type="text"
                               placeholder="Common Name">
                    </div>
                    <div class="w3-third">
                        <label>Scientific Name</label>
                        <input v-model="repositoryInfo.scientificName" class="w3-input w3-border" type="text"
                               placeholder="Scientific Name">
                    </div>
                </div>

                <p></p>

                <div class="w3-row-padding">
                    <div class="w3-third">
                        <label>Latitude</label>
                        <input v-model.number="location.latitude" class="w3-input w3-border" type="number"
                               placeholder="Latitude">
                    </div>
                    <div class="w3-third">
                        <label>Longitude</label>
                        <input v-model.number="location.longitude" class="w3-input w3-border" type="number"
                               placeholder="Longitude">
                    </div>
                    <div class="w3-third">
                        <label>Altitude</label>
                        <input v-model.number="location.altitude" class="w3-input w3-border" type="number"
                               placeholder="Altitude">
                    </div>
                </div>

                <p></p>

                <div class="w3-row-padding">

                    <div class="w3-third">
                        <label>Plant Families</label>
                        <select class="w3-select w3-border" v-model="selected.family"  name="option">
                            <option value="" disabled selected>Select Plant Family</option>
                            <option v-for="family in allId.families" :value="family.id">{{family.name}}</option>
                        </select>
                    </div>
                    <div class="w3-third">
                        <label>Classification</label>
                        <select class="w3-select w3-border" v-model="selected.category"  name="option">
                            <option value="" disabled selected>Select Classification</option>
                            <option v-for="category in allId.categories" :value="category.id">{{category.name}}</option>
                        </select>
                    </div>
                    <div class="w3-third">
                        <label>Distribution</label>
                        <select class="w3-select w3-border" v-model="selected.distribution" name="option">
                            <option value="" disabled selected>Select Distribution</option>
                            <option v-for="distribution in allId.distributions" :value="distribution.id">{{distribution.name}}</option>
                        </select>
                    </div>

                    <p></p>

                    <div class="w3-row-padding">
                        <div class="w3-half">
                            <label>Vegetation Type</label>
                            <select class="w3-select w3-border" v-model="selected.vegetation"  name="option">
                                <option value="" disabled selected></option>
                                <option v-for="vegetation in allId.vegetations" :value="vegetation.id">{{vegetation.name}}</option>
                            </select>
                        </div>
                        <div class="w3-half">
                            <label>Estimated Density</label>
                            <select class="w3-select w3-border" v-model="selected.density"  name="option">
                                <option value="" disabled selected>Select Classification</option>
                                <option v-for="density in estimatedDensity" :value="density.id">{{density.name}}</option>
                            </select>
                        </div>
                    </div>

                    <div class="w3-container w3-center w3-margin-top">
                        <button class="w3-btn w3-ripple w3-large w3-green" @click="addBaseColor">Add</button>
                        <button class="w3-btn w3-ripple w3-large w3-red">Cancel</button>
                    </div>

                </div>

            </div>


        </div>
    </div>
</template>
<style>
    .base_color {
        width: 50px;
        height: 50px;
    }

    #pallete {
        display: flex;
    }

    .nearColor {
        display: flex;
    }
</style>
<script>
    import {
        plantPush,
        addRepository,
        currentPage,
        capturePhoto,
        cnvrtRGBClrToHex,
        hexColorDelta,
        cameraInfo,
        urltoFile,
        allId,
        getSimilar,
        setSimilar
    } from './../Ajax/getData'
    export default{
        data(){
            return {
                allId,
                selected: {
                    category: null,
                    distribution: null,
                    family: null,
                    vegetation: [],
                    density: null
                },
                estimatedDensity:[
                    {id: 1 , name: 'High'},
                    {id: 2 , name: 'Medium'},
                    {id: 3 , name: 'Low'}
                ],
                showNearest: false,
                plantLimit: 10,
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
                    description: '',
                    scientificName: '',
                    species: '',
                    commonName: '',
                    economicImportance:'',
                    estimatedDensity: null
                },
                urlFile: null,
                disabledButton: false
            }
        },
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
                vm.repositoryInfo.title = ''
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
                vm.disabledButton = true
                //post image, pallete, repository infomation to the database, if the netword is not exist, then gonna go local storage
                addRepository(vm.image, hexArray, vm.location, vm.repositoryInfo, vm.selected)
                    .then(function () {
                        vm.disabledButton = false
                    }).catch(function () {
                    vm.disabledButton = false
                })

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
    }
</script>
