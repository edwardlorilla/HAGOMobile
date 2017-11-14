<template>
    <v-ons-page>
        <div style="height: 100%;" class="mainbox">
            <div class="insidebox">
                <v-ons-toolbar  modifier="transparent cover-content">
                    <div class="left">
                        <v-ons-back-button></v-ons-back-button>
                    </div>
                </v-ons-toolbar>


                <div class="mainimagecapture">
                    <video id="player" ref="videoPlayer" autoplay :style="imageStyle"></video>
                    <canvas ref="canvasElement" id="canvas" :style="imageStyle"></canvas>
                    <a href="#" title="Change camera">
                        <div class="changecameraholder">
                            <div class="curvedarrowlinetop"></div>
                            <div class="curvedarrowtop"></div>
                            <div class="curvedarrowlinebottom"></div>
                            <div class="curvedarrowbottom"></div>
                        </div>
                    </a>

                    <a href="#" title="Take capture">
                        <div class="homecircle"></div>
                    </a>

                    <div class="flashholder">
                        <a href="#" title="Turn ON/OFF/AUTO flash">
                            <div class="flashbottomright"></div>
                            <div class="flashtopleft"></div>
                        </a>
                    </div>

                    <a href="#" title="More options">
                        <div class="moreoptions"></div>
                    </a>

                    <a href="#" title="Focus">
                        <div class="focusholder">
                            <div class="focustoplefthori"></div>
                            <div class="focustopleftverti"></div>
                            <div class="focustoprighthori"></div>
                            <div class="focustoprightverti"></div>
                            <div class="focusbottomlefthori"></div>
                            <div class="focusbottomleftverti"></div>
                            <div class="focusbottomrighthori"></div>
                            <div class="focusbottomrightverti"></div>
                        </div>
                    </a>

                    <!--<img src="https://source.unsplash.com/category/nature">-->

                </div> <!-- Close .mainimagecapture -->
            </div> <!-- Close .insidebox -->


        </div>
    </v-ons-page>
</template>
<style scoped>

    .mainbox {
        background-color: #000;
        -webkit-box-shadow: 0px 0px 71px -10px rgba(0, 0, 0, 0.3);
        -moz-box-shadow: 0px 0px 71px -10px rgba(0, 0, 0, 0.3);
        box-shadow: 0px 0px 71px -10px rgba(0, 0, 0, 0.3);
    }

    .homecircle {
        position: absolute;
        width: 75px;
        height: 75px;
        background: #FDAEAA;
        -moz-border-radius: 50px;
        -webkit-border-radius: 50px;
        border-radius: 50px;
        bottom: 4%;
        left: 50%;
        transform: translate(-50%);

        -webkit-box-shadow: 0px 0px 71px -10px rgba(0, 0, 0, 0.3);
        -moz-box-shadow: 0px 0px 71px -10px rgba(0, 0, 0, 0.3);
        box-shadow: 0px 0px 71px -10px rgba(0, 0, 0, 0.3);
    }

    a .homecircle:hover {
        opacity: 0.9;
        background: #FDAEAA;
    }

    .flashholder {
        position: absolute;
        bottom: 30px;
        right: 70px;
        /*mix-blend-mode: difference;*/
    }

    .flashbottomright {
        width: 0;
        height: 0;
        border-bottom: 16px solid #FFF;
        border-left: 11px solid transparent;
    }

    .flashtopleft {
        width: 0;
        height: 0;
        border-top: 16px solid #FFF;
        border-right: 11px solid transparent;
        margin-left: 6px;
        margin-top: -3px
    }

    .moreoptions {
        width: 6px;
        height: 6px;
        background-color: #FFF;
        -moz-border-radius: 50px;
        -webkit-border-radius: 50px;
        border-radius: 50px;
        position: absolute;
        display: block;
        content: '';
        right: 35px;
        bottom: 38px;
    }

    .moreoptions:after {
        width: 6px;
        height: 6px;
        background-color: #FFF;
        -moz-border-radius: 50px;
        -webkit-border-radius: 50px;
        border-radius: 50px;
        position: absolute;
        display: block;
        content: '';
        right: 0;
        bottom: 11px;
    }

    .focusholder {
        position: absolute;
        width: 120px;
        height: 120px;
        background-color: transparent;
        top: 50%;
        left: 50%;
        margin: -120px 0 0 -60px;
    }

    .focustoplefthori {
        width: 20px;
        height: 2px;
        position: absolute;
        background-color: #FFF;
        top: 0;
        left: 0;
    }

    .focustopleftverti {
        width: 2px;
        height: 20px;
        position: absolute;
        background-color: #FFF;
        top: 0;
        left: 0;
    }

    .focustoprighthori {
        width: 20px;
        height: 2px;
        position: absolute;
        background-color: #FFF;
        top: 0;
        right: 0;
    }

    .focustoprightverti {
        width: 2px;
        height: 20px;
        position: absolute;
        background-color: #FFF;
        top: 0;
        right: 0;
    }

    .focusbottomlefthori {
        width: 20px;
        height: 2px;
        position: absolute;
        background-color: #FFF;
        bottom: 0;
        left: 0;
    }

    .focusbottomleftverti {
        width: 2px;
        height: 20px;
        position: absolute;
        background-color: #FFF;
        bottom: 0;
        left: 0;
    }

    .focusbottomrighthori {
        width: 20px;
        height: 2px;
        position: absolute;
        background-color: #FFF;
        bottom: 0;
        right: 0;
    }

    .focusbottomrightverti {
        width: 2px;
        height: 20px;
        position: absolute;
        background-color: #FFF;
        bottom: 0;
        right: 0;
    }

    .changecameraholder {
        position: absolute;
        bottom: 40px;
        left: 35px;
    }


</style>
<script>
    import {currentPage} from './../Ajax/getData'
    export default{
        data(){
            return {
                currentPage: currentPage,
                isSearch: false,
                position: {
                    latitude: null,
                    longitude: null
                },
                hexColor: [],
                image: '',
                palletes: null,
                baseColor: [
                    {
                        "name": "burgundy",
                        "number": "17A",
                        "hexvalue": ["660000", "990000", "cc0000"]
                    },
                    {
                        "name": "blue",
                        "number": "18B ",
                        "hexvalue": ["cc3333", "ea4c88", "993399"]
                    },
                    {
                        "name": "orange",
                        "number": "19C",
                        "hexvalue": ["663399", "333399", "0066cc"]
                    }
                ]
            }
        },
        methods: {
            showPosition(position){
                var vm = this
                vm.position.latitude = position.coords.latitude
                vm.position.longitude = position.coords.longitude
            },
            captureImage(){
                var vm = this
                vm.$refs.canvasElement.style.display = 'block';
                vm.$refs.videoPlayer.style.display = 'none';
                //vm.$refs.captureButton.style.display = 'none';
                var context = vm.$refs.canvasElement.getContext('2d');
                context.drawImage(vm.$refs.videoPlayer, 0, 0, canvas.width, vm.$refs.videoPlayer.videoHeight / (vm.$refs.videoPlayer.videoWidth / canvas.width));
                vm.$refs.videoPlayer.srcObject.getVideoTracks().forEach(function (track) {
                    track.stop();
                });
                var image = vm.$refs.canvasElement.toDataURL();
                vm.image = image
                var img = this.$refs.imag
                if (img.naturalWidth) {
                    vm.onImageLoad(img);
                } else {
                    img.onload = function () {
                        vm.onImageLoad(img);
                    };
                }
            },
            hexColorDelta(hex1, hex2) {
                var r1 = parseInt(hex1.substring(0, 2), 16);
                var g1 = parseInt(hex1.substring(2, 4), 16);
                var b1 = parseInt(hex1.substring(4, 6), 16);
                // get red/green/blue int values of hex2
                var r2 = parseInt(hex2.substring(0, 2), 16);
                var g2 = parseInt(hex2.substring(2, 4), 16);
                var b2 = parseInt(hex2.substring(4, 6), 16);
                // calculate differences between reds, greens and blues
                var r = 255 - Math.abs(r1 - r2);
                var g = 255 - Math.abs(g1 - g2);
                var b = 255 - Math.abs(b1 - b2);
                // limit differences between 0 and 1
                r /= 255;
                g /= 255;
                b /= 255;
                // 0 means opposit colors, 1 means same colors
                return (r + g + b) / 3;
            },
            onFileChange(e) {
                var files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file) {
                var image = new Image();
                var reader = new FileReader();
                var vm = this;

                reader.onload = function (e) {
                    vm.image = e.target.result;
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
                this.image = '';
            },
            onImageLoad(img){
                var vm = this
                var colorThief = new ColorThief();
                var rgb = colorThief.getPalette(img, 10);
                this.palletes = rgb
                for (var j = 0; j < rgb.length; j++) {
                    vm.hexColor.push(vm.cnvrtRGBClrToHex(rgb[j].join(', ')))
                }
            },
            cnvrtRGBClrToHex(rgbClr){
                var rgbClr = rgbClr.split(',');
                var r = rgbClr[0];
                var g = rgbClr[1];
                var b = rgbClr[2];
                return (r << 16 | g << 8 | b).toString(16).toUpperCase()
            }
        },
        mounted(){
            var vm = this
            if (!('mediaDevices' in navigator)) {
                navigator.mediaDevices = {};
            }
            if (!('getUserMedia' in navigator.mediaDevices)) {
                navigator.mediaDevices.getUserMedia = function (constraints) {
                    var getUserMedia = navigator.webkitGetUserMedia || navigator.mozGetUserMedia;

                    if (!getUserMedia) {
                        return Promise.reject(new Error('getUserMedia is not implemented!'));
                    }

                    return new Promise(function (resolve, reject) {
                        getUserMedia.call(navigator, constraints, resolve, reject);
                    });
                }
            }
            navigator.mediaDevices.getUserMedia({video: true})
                    .then(function (stream) {
                        vm.$refs.videoPlayer.srcObject = stream;
                        vm.$refs.style.display = 'block';
                    })
                    .catch(function (err) {
                        //vm.$refs.imagePickerArea.style.display = 'block';
                    });
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(vm.showPosition);
            }
        },
        computed: {
            imageStyle(){
                return {
                    'width': window.innerWidth + 'px',
                    'height': window.innerHeight + 'px',
                    'position': 'absolute'
                }
            },
            getNearestColor(){
                var vm = this,
                        objectValue = [],
                        hexValue = vm.hexColor,
                        hexColor = [],
                        hexColorArray = [],
                        hexArray = [],
                        hexColorItem = [],
                        nearestColor = _.map(vm.baseColor, function (o) {
                            for (var j = 0; j < hexValue.length; j++) {
                                for (var i = 0; i < o.hexvalue.length; i++) {
                                    hexColor = vm.hexColorDelta(hexValue[j], o.hexvalue[i]);
                                    if (hexColor > 0.8) {
                                        hexArray.push({
                                            hexColor: '#' + o.hexvalue[i],
                                            resultPercentage: hexColor,
                                            hexCompareTo: hexValue[j],
                                            hexValue: o.name
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
                                        currentData.push(currentData[1].length), currentData
                                        return _.zipObject(["hexValue", "property", "countHex"], currentData);
                                    })
                                    .value();
                            objectValue.push(hexArrays)
                            hexArray = []
                        });

                // return  objectValue
                return _.sortBy(objectValue, [function (o, value) {
                    return _.map(objectValue[value], function (o) {
                        return o.countHex
                    });
                }]).reverse();
            }
        }
    }
</script>