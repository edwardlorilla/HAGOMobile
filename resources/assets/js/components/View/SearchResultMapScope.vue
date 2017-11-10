<template>
    <div class="autocomplete-list popover popover--top " :class="{'popover--material':$ons.platform.isAndroidPhone()}">
        <div class="popover__arrow popover--top__arrow"
             :class="{'popover--material__arrow':$ons.platform.isAndroidPhone()}" style="margin-left: 110px;"></div>
        <div class="popover__content popover--top__content" :class="{'popover--material__content':$ons.platform.isAndroidPhone()}" >
            <slot>

            </slot>
        </div>
    </div>
</template>