<template >
    <div id="app">
        <offline-handler @detected-condition="handleConnectivityChange">
            <!--&lt;!&ndash; Only renders when the device is online &ndash;&gt;-->
            <!--<div slot="online">-->
                <!--<p>It looks like you're online! Here's all the things you can do...</p>-->
                <!--...-->
            <!--</div>-->
            <!--&lt;!&ndash; Only renders when the device is offline &ndash;&gt;-->
            <!--<div slot="offline">-->
                <!--<p>You appear to be offline, that's okay, we can still do things...</p>-->
                <!--...-->
            <!--</div>-->
        </offline-handler>
        <no-mode-translate-fade>
            <router-view></router-view>
        </no-mode-translate-fade>
    </div>

</template>
<style>
</style>
