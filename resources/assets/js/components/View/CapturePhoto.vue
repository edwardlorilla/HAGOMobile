<template>
    <v-ons-page>
        <custom-toolbar v-if="currentPage.name" :title="currentPage.name"></custom-toolbar>
        <div style="height: 100%;" class="mainbox">
            <div class="insidebox">

                <div class="mainimagecapture">
                    <video  id="player" ref="videoPlayer" autoplay :style="imageStyle"></video>
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
                currentPage: currentPage
            }
        },
        computed: {
            imageStyle(){
                return {
                    'width': window.innerWidth + 'px',
                    'height': window.innerHeight + 'px',
                    'position': 'absolute'
                }
            }
        }
    }
</script>