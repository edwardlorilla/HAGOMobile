<template>
        <v-ons-tabbar animation="none"
                      position="bottom"
                      :tabs="tabs"
                      :visible="true"
                      index.sync="activeIndex"
        >
            <v-ons-tab

            ></v-ons-tab>
            <v-ons-tab

            ></v-ons-tab>
        </v-ons-tabbar>
</template>

<script>
    export default{
        data(){
            return {
                activeIndex: 0,
                tabs: [
                    {
                        icon:  'fa-leaf',
                        label: 'Repositories',
                        page: 'view-map',
                        props: {
                            myProp: 'This is a page prop!'
                        },
                        key: "homePage"
                    }, {
                        icon:  'fa-eye',
                        label: 'Repositories',
                        page: 'view-map',
                        props: {
                            myProp: 'This is a page prop!'
                        },
                        key: "homePage"
                    },

                ]
            }
        }


    }
</script>
