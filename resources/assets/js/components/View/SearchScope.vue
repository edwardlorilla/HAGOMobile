<template>
    <div style="
            overflow: hidden;
            background-color: #f1f1f1;
            z-index: 100;
            position: fixed;
            top: 0;
            width: 100%;"
         :style="{'padding-top':$ons.platform.isAndroidPhone() ? 50 + 'px' : 45 + 'px'}"
         class="navigation-bar">
        <div class="navigation-bar__center">
            <div style="display: -webkit-flex;
                        display: flex;
                        justify-content:center;
                        padding: 14px 16px;">
                <slot>

                </slot>
            </div>
        </div>
    </div>
</template>