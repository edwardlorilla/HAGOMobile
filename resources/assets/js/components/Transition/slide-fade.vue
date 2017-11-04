<template>
    <transition name="slide-fade">
        <slot></slot>
    </transition>
</template>
<style>

    .slide-fade-enter-active, .slide-fade-leave-active{
        transition: all .3s ease;
    }
    .slide-fade-enter, .slide-fade-leave-to {
        transform: translateY(-100%);
    }
</style>