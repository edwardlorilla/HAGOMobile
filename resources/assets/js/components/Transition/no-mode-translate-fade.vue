
<template>
    <transition name="no-mode-translate-fade" mode="in-out">
        <slot></slot>
    </transition>
</template>
<style>
    .no-mode-translate-demo-wrapper {
      position: relative;
      height: 18px;
    }
    .no-mode-translate-demo-wrapper button {
      position: absolute;
    }
    .no-mode-translate-fade-enter-active, .no-mode-translate-fade-leave-active {
      transition: all 0.5s;
    }
    .no-mode-translate-fade-enter, .no-mode-translate-fade-leave-active {
      opacity: 0;
    }
    .no-mode-translate-fade-enter {
      transform: translateY(100%);
    }
    .no-mode-translate-fade-leave-active {
      transform: translateY(100%);
    }

</style>