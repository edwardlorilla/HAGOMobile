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
        <div class="mainbox">
            <div class="insidebox">


                <div ref="imagePickerArea">
                    <img ref="imag" :src="image"/>
                    <input type="text" v-model="hexColor"/>
                    <div v-if="!image">
                        <h2>Select an image</h2>
                        <input type="file" @change="onFileChange">

                    </div>
                    <div v-else>

                        <button @click="removeImage">Remove image</button>
                    </div>
                </div>

                <button @click="addBaseColor">add</button>

                <div id="pallete">
                    <div v-for="pallete in palletes" class="base_color"
                         :style="{'background-color': 'rgb(' + pallete.join( ', ') + ')' }">
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
button {

}

.nearColor{
  display: flex;
}










</style>
<script>
    import {currentPage, capturePhoto, cnvrtRGBClrToHex, hexColorDelta, cameraInfo} from './../Ajax/getData'
    export default{
        data(){
            return {
                selectedPlant: null,
                currentPage: currentPage,
                hexColor: [] ,
                image: '',
                palletes: null,
                baseColor:  [
                  {
                    "name" : "burgundy" ,
                    'id': '17A',
                    'photos': [],
                    "hexvalue" : [ '564D42','E7EAEF','898885','A6B0BD','979DAC','171619','797E7D','717276','B4A49C']},
                  {
                    "name" : "blue" ,
                    'id': '18B',
                    'photos': [],
                    "hexvalue" : [ "cc3333","ea4c88","993399"]},
                  {
                    "name" : "orange" ,
                    'id': '19C',
                    'photos': [],
                    "hexvalue" : [ "663399","333399","0066cc"]
                  }
                ],
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
          var image = new Image();
          var reader = new FileReader();
          var vm = this;

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
          var rgb = colorThief.getPalette(img, 10);
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
              vm.hexColor = []
          vm.baseColor.push({name: 'vm.image', number: '', hexvalue: hexArray})
        }
        },
        mounted(){

            var vm = this
            if(capturePhoto){
                vm.onFileChange(capturePhoto)
            }


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
                  nearestColor= _.map(vm.baseColor, function(o) {
                    for (var j = 0; j < hexValue.length; j++) {
                      for (var i = 0; i < o.hexvalue.length; i++) {
                        hexColor = vm.hexColorDelta(hexValue[j], o.hexvalue[i]);
                        if( hexColor > 0.9){
                          hexArray.push({photo: !_.isEmpty(o.photos) ? o.photos[0] : null , id: o.id, hexColor: '#'+o.hexvalue[i], resultPercentage: hexColor, hexCompareTo: hexValue[j], hexValue: o.name })
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
                        console.log(currentData)
                      currentData.push(currentData[1].length)
                      currentData.push(currentData[1][0].id)
                      currentData.push(currentData[1][0].photo)
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