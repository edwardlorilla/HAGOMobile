<template>
    <v-ons-page>
        <v-ons-toolbar>
            <div class="left">
                <v-ons-toolbar-button @click="changeView">
                    <v-ons-icon icon="ion-navicon, material:md-menu"></v-ons-icon>
                </v-ons-toolbar-button>
            </div>
            <div class="center">Recent Searches</div>
        </v-ons-toolbar>


    <v-ons-list>
        <v-ons-lazy-repeat
                v-if="timeline.get.length > 0"
                :render-item="renderItem"
                :length="timeline.get.length"
        >
        </v-ons-lazy-repeat>
    </v-ons-list>


    </v-ons-page>
</template>
<script>
    import {change_view, timeline, writeTimeline, timelineChanger} from './../Ajax/getData'
    export default{
        data(){
            return {
                timeline,
                renderItem(i)  {
                    return new Vue({
                        template: `
                            <v-ons-list-item v-if="timeline.get[index]"  :key="index">
                             <div class="left"  @click="timelineChanger()">
                              <img v-if="timeline.get[index].plantInfo != null" class="list-item__thumbnail" :src="timeline.get[index].plantInfo" >
                            <i v-else class="zmdi zmdi-hc-3x zmdi-run"></i>
                            </div>
                            <div class="center">
                              <span class="list-item__title"> <i v-if="timeline.get[index].duration_at" class='zmdi zmdi-timer'></i>  {{timeline.get[index].duration_at != null ? timeline.get[index].duration_at : 'tracking...' }}</span>
                              <span class="list-item__subtitle">Started at: {{timeline.get[index].started_at}}</span>
                            </div>
                            </v-ons-list-item>
                          `,
                        data() {
                            return {
                                index: i,
                                timeline
                            };
                        },
                        methods:{
                            timelineChanger(){
                                var vm = this
                                timelineChanger()
                            }
                        }
                    })
                }
            }
        },
        computed:{
        },
        mounted(){

        },
        methods: {
            changeView()
            {
                var vm = this
                change_view()
            }
        }
    }
</script>
