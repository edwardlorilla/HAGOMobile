<template>
    <v-ons-page>
        <v-ons-toolbar>
            <div class="center">{{ title }}</div>
        </v-ons-toolbar>

        <v-ons-tabbar swipeable position="auto"
                      :tabs="tabs"
                      :visible="true"
                      :index.sync="activeIndex"
        >
        </v-ons-tabbar>
    </v-ons-page>
</template>

<script>
    import repository from './Repository/index.vue'
    import settingsPage from './Setting.vue'
    import bookOfFlora from './Repository/bookOfFlora.vue'
    export default {
        data(){
            return {
                activeIndex: 0,
                tabs: [
                    {
                        icon: this.md() ? null : 'ion-home',
                        label: 'Maps',
                        page: repository ,
                        key: "homePage"
                    },
                    {
                        icon: this.md() ? null : 'ion-ios-settings',
                        label: 'Repositories',
                        page: bookOfFlora,
                        key: "repositoryPage"
                    },
                    {
                        icon: this.md() ? null : 'ion-ios-settings',
                        label: 'Settings',
                        page: settingsPage,
                        key: "settingsPage"
                    }

                ]
            }
        },
        methods: {
            md() {
                return this.$ons.platform.isAndroid();
            }
        },
        computed: {
            title() {
                return this.tabs[this.activeIndex].label;
            }
        }

    }
</script>
