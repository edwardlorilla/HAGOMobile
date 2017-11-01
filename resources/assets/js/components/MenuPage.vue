<template>
    <v-ons-list>
        <v-ons-list-item modifier="chevron" v-for="item in essentialLinks" @click="onClick(item.link)" :key="item.link">
            <div class="left"><v-ons-icon fixed-width :icon="item.icon"></v-ons-icon></div>
            <div class="center">{{ item.label }}</div>
        </v-ons-list-item>
    </v-ons-list>
</template>
<script>
    export default {
        data () {
            return {
                essentialLinks: [
                    { label: 'Repositories of Plants', link: 'view-plant', icon: 'fa-book' },
                ]
            }
        },
        methods: {
            onClick (link) {
                this.$parent.$parent.$parent.$parent.$data.currentPage = link
            }
        }
    }
</script>