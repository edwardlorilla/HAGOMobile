<template>
    <v-ons-navigator v-if="stack" swipeable
                     options.animation="slide"
                     :page-stack="stack.page"
    ></v-ons-navigator>
</template>
<style scoped>


    .pulse {
        position: fixed;
        top: 45%;
        left: 50%;
        margin-left: -36px;
        width: 72px;
        height: 72px;
        line-height: 72px;
        font-family: sans-serif;
        font-weight: 700;
        font-size: 34px;
        text-align: center;
        color: #5abdde;
    }

    .pulse span,
    .pulse:before,
    .pulse:after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        border: 0 solid #5abdde;
        border-radius: 100%;
        -webkit-animation: da-pulse 1.5s ease-in-out 0s infinite;
        animation: da-pulse 1.5s ease-in-out 0s infinite;
    }

    .pulse span {
        border-color: #5abdde;
        border-width: 4px;
        top: 6px;
        left: 6px;
        right: 6px;
        bottom: 6px;
    }

    .pulse:before {
        border-color: #1f7b9a;
        border-width: 2px;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
    }

    .pulse:after {
        border-color: #16596f;
        border-width: 1px;
        top: -5px;
        left: -5px;
        right: -5px;
        bottom: -5px;
    }

    @-webkit-keyframes da-pulse {
        0%,
        100% {
            -webkit-transform: scale(1.25);
            transform: scale(1.25);
            opacity: 0;
        }
        48%,
        52% {
            -webkit-transform: scale(1);
            transform: scale(1);
            opacity: 1;
        }
    }

    @keyframes da-pulse {
        0%,
        100% {
            -webkit-transform: scale(1.25);
            transform: scale(1.25);
            opacity: 0;
        }
        48%,
        52% {
            -webkit-transform: scale(1);
            transform: scale(1);
            opacity: 1;
        }
    }

</style>
<script>
    import {Stack} from './../Ajax/getData'
    export default{
        data(){
            return {
                stack: Stack
            }
        }
    }
</script>