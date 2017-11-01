<template>
    <v-ons-page>
        <custom-toolbar v-if="currentPage.name" :title="currentPage.name"></custom-toolbar>
        <div class="mainbox">
            <div class="insidebox">

                <div class="mainimagecapture">

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



    .backtogalleryholder {
        position: absolute;
        top: 30px;
        right: 15px;
        width: 20px;
        height: 20px;
    }

    .backtogallerytopleft {
        position: absolute;
        top: 0;
        left: 0;
        width: 8px;
        height: 8px;
        background-color: #FFF;
    }

    .backtogallerytopright {
        position: absolute;
        top: 0;
        right: 0;
        width: 8px;
        height: 8px;
        background-color: #FFF;
    }

    .backtogallerybottomleft {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 8px;
        height: 8px;
        background-color: #FFF;
    }

    .backtogallerybottomright {
        position: absolute;
        bottom: 0;
        right: 0;
        width: 8px;
        height: 8px;
        background-color: #FFF;
    }

    .insidebox {
        background: rgba(0, 145, 229, 1);
        background: -moz-linear-gradient(45deg, rgba(0, 145, 229, 1) 0%, rgba(0, 145, 229, 1) 66%, rgba(0, 162, 255, 1) 66%, rgba(0, 162, 255, 1) 100%);
        background: -webkit-gradient(left bottom, right top, color-stop(0%, rgba(0, 145, 229, 1)), color-stop(66%, rgba(0, 145, 229, 1)), color-stop(66%, rgba(0, 162, 255, 1)), color-stop(100%, rgba(0, 162, 255, 1)));
        background: -webkit-linear-gradient(45deg, rgba(0, 145, 229, 1) 0%, rgba(0, 145, 229, 1) 66%, rgba(0, 162, 255, 1) 66%, rgba(0, 162, 255, 1) 100%);
        background: -o-linear-gradient(45deg, rgba(0, 145, 229, 1) 0%, rgba(0, 145, 229, 1) 66%, rgba(0, 162, 255, 1) 66%, rgba(0, 162, 255, 1) 100%);
        background: -ms-linear-gradient(45deg, rgba(0, 145, 229, 1) 0%, rgba(0, 145, 229, 1) 66%, rgba(0, 162, 255, 1) 66%, rgba(0, 162, 255, 1) 100%);
        background: linear-gradient(45deg, rgba(0, 145, 229, 1) 0%, rgba(0, 145, 229, 1) 66%, rgba(0, 162, 255, 1) 66%, rgba(0, 162, 255, 1) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#0091e5', endColorstr='#00a2ff', GradientType=1);
        width: 100%;
        position: relative;
        overflow: hidden;
    }

    .mainimagecapture {
        width: 100%;
        height: 100vh;
        background-color: transparent;
        margin-left: auto;
        margin-right: auto;
        position: relative;
        padding: 0;
        z-index: 600;
        top: 0;
        -moz-border-radius: 0 0 50px 50px;
        -webkit-border-radius: 0 0 50px 50px;
        border-radius: 0 0 50px 50px;
        border: 0px solid #FFF;
        border-top: none;
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

    .curvedarrowlinetop {
        position: absolute;
        border: 0 solid transparent;
        border-top: 3px solid #FFF;
        border-radius: 0 20px 0 0;
        top: -12px;
        left: -2px;
        width: 14px;
        height: 20px;
        -webkit-transform: rotate(180deg);
        -moz-transform: rotate(0deg);
        -ms-transform: rotate(180deg);
        -o-transform: rotate(180deg);
    }

    .curvedarrowtop {
        position: absolute;
        width: 0;
        height: 0;
        border-top: 5px solid transparent;
        border-right: 10px solid #FFF;
        border-bottom: 5px solid transparent;
        right: 0px;
        top: -15px
    }

    .curvedarrowlinebottom {
        position: absolute;
        border: 0 solid transparent;
        border-top: 3px solid #FFF;
        border-radius: 0 20px 0 0;
        top: -12px;
        left: -9px;
        width: 14px;
        height: 20px;
        -webkit-transform: rotate(180deg);
        -moz-transform: rotate(180deg);
        -ms-transform: rotate(180deg);
        -o-transform: rotate(180deg);
    }

    .curvedarrowbottom {
        position: absolute;
        width: 0;
        height: 0;
        border-top: 5px solid transparent;
        border-left: 10px solid #FFF;
        border-bottom: 5px solid transparent;
        left: 2px;
        top: 1px
    }

    .outsidetoptext {
        font-family: Courier New, Courier, Lucida Sans Typewriter, Lucida Typewriter, monospace;
        text-align: center;
        margin: 4% 20% 2% 20%;
    }

    .outsidetoptext p:last-child {
        font-weight: bold;
    }

    .outsidebottomtext {
        font-family: Courier New, Courier, Lucida Sans Typewriter, Lucida Typewriter, monospace;
        text-align: center;
        margin: 0 0 4% 0;
    }

</style>
<script>
    import {currentPage} from './../Ajax/getData'
    export default{
        data(){
            return {
                currentPage: currentPage
            }
        }
    }
</script>