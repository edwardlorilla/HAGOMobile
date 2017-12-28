<template>
    <v-ons-page>
        <v-ons-toolbar>
            <div class="left">
                <v-ons-back-button></v-ons-back-button>
            </div>
            <div class="center">
                Add Flora
            </div>
        </v-ons-toolbar>
        <v-ons-progress-bar v-if="!location.latitude" indeterminate></v-ons-progress-bar>
        <div class="mainbox">
            <div class="insidebox">


                <div ref="imagePickerArea">
                    <img ref="imag" :src="image"/>
                    <div v-if="!image">
                        <h2>Select an image</h2>
                        <input type="file" @change="onFileChange">

                    </div>
                    <div v-else>
                        <div id="pallete">
                            <div v-for="pallete in palletes" class="base_color"
                                 :style="{'background-color': 'rgb(' + pallete.join( ', ') + ')' }">
                            </div>
                        </div>
                        <v-ons-list>
                            <v-ons-list-item>
                                <div class="center">
                                    <v-ons-input placeholder="Title" float
                                                 v-model="repositoryInfo.title"
                                                 style="width: 100%"
                                    >
                                    </v-ons-input>
                                </div>

                            </v-ons-list-item>
                            <v-ons-list-item>
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

                    </div>
                </div>


                <hr>
                <p>
                    Get nearest color
                </p>

                <div v-for="(nearest,index, key) in sortList(getNearestColor)" :key="index">
                    <v-ons-list-item v-for="near in nearest" :key="index" tappable>
                        <label class="left">
                            <v-ons-radio
                                    :input-id="'radio-' + index"
                                    :value="near.id"
                                    v-model="selectedPlant"
                            >
                            </v-ons-radio>
                        </label>
                        <label :for="'radio-' + index" class="center">
                            {{near.hexValue}}
                        </label>
                    </v-ons-list-item>
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
.base_color{
width: 50px;
height: 50px;
}
#pallete{
display: flex;
}
img {
width: 100%;
margin: auto;
display: block;
margin-bottom: 10px;
}

.nearColor{
display: flex;
}






</style>
<script>
import {plantPush, currentPage, capturePhoto, cnvrtRGBClrToHex, hexColorDelta, cameraInfo, FormDataPost,urltoFile, plantItem} from './../Ajax/getData'
export default{
    data(){
        return {

            selectedPlant: null,
            watchID: null,
            currentPage: currentPage,
            hexColor: [] ,
            image: '',
            palletes: null,
            location: {
                latitude: null,
                longitude: null,
                altitude: null
            },
            repositoryInfo:{
                title: '',
                description: ''
            },
            urlFile: null,
            baseColor:  plantItem
        }
    },
    methods:{
    sortList(objectValue){
      return _.sortBy(objectValue, function(o, value) {
        return o[0] ? o[0].countHex : null
      }).reverse();
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
      reader.onload = (e) => {

        vm.image = e.target.result;

      };
      reader.readAsDataURL(file);
      var img = this.$refs.imag
      if (img.naturalWidth) {
        vm.onImageLoad(img);
      } else {
        img.onload = function() {
          vm.onImageLoad(img);
        };
      }
    },
    removeImage: function (e) {
      this.image = '';
    },
    onImageLoad(img){
      var vm = this
      var colorThief = new ColorThief();
      var rgb = colorThief.getPalette(img);
      vm.palletes =  rgb
      for (var j = 0; j < rgb.length; j++) {
        vm.hexColor.push(vm.cnvrtRGBClrToHex(rgb[j].join( ', ')))
      }

    },
    cnvrtRGBClrToHex(rgbClr){
      return cnvrtRGBClrToHex(rgbClr)
    },
    palletesConvertHex(){
      var vm = this
      return _.map(vm.palletes, function(obj){
        return vm.cnvrtRGBClrToHex( obj.toString())
      });
    },
    addBaseColor(){
      var vm = this,
          hexArray = vm.palletesConvertHex()

    FormDataPost( vm.image,  hexArray,vm.location.latitude, vm.location.longitude, vm.location.altitude, vm.repositoryInfo.title, vm.repositoryInfo.description, vm.selectedPlant )

    },
     showPosition(position) {
     var vm = this
            vm.location.latitude =  position.coords.latitude
            vm.location.longitude =  position.coords.longitude
            vm.location.altitude =  position.coords.altitude
            navigator.geolocation.clearWatch(this.watchID);
        },
    },

    mounted(){
        var vm = this
        if(capturePhoto){
            vm.onFileChange(capturePhoto)
        }
        if ("geolocation" in navigator) {
          /* geolocation is available */
          vm.watchID = navigator.geolocation.watchPosition(function(position) {
          vm.showPosition(position)
        },function (error) {
         switch(error.code)
        {
            case error.PERMISSION_DENIED: alert("user did not share geolocation data");
            break;

            case error.POSITION_UNAVAILABLE: alert("could not detect current position");
            break;

            case error.TIMEOUT: alert("retrieving position timed out");
            break;

            default: alert("unknown error");
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
     computed:{
        getNearestColor(){
          var vm = this,
              objectValue = [],
              hexValue = vm.hexColor,
              hexColor = [],
              hexColorArray= [],
              hexArray = [],
              hexColorItem=[],
              nearestColor= _.map(vm.baseColor.all, function(o) {
                for (var j = 0; j < hexValue.length; j++) {
                  for (var i = 0; i < o.color.colors.split(',').length; i++) {
                    hexColor = vm.hexColorDelta(hexValue[j], o.color.colors.split(',')[i]);
                    if( hexColor > 0.9){
                      hexArray.push({photo: !_.isEmpty(o.photos) ? o.photos[0] : null , id: o.id, hexColor: '#'+o.color.colors.split(',')[i], resultPercentage: hexColor, hexCompareTo: hexValue[j], hexValue: o.title })
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
                .map(function(currentData){
                  currentData.push(currentData[1].length)
                  currentData.push(currentData[1][0].id)
                  currentData.push(currentData[1][0].photo)
                  currentData.push(currentData[1][0].description)
                  return _.zipObject(["hexValue", "property", "countHex", 'id', 'photo'], currentData);
                })
                .value();
                objectValue.push(hexArrays)
                hexArray = []
              });
          // return  objectValue
          return objectValue
        }
      },
}















</script>