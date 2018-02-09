    <template>
        <v-ons-navigator swipeable
                         :page-stack="navigation.page"
        ></v-ons-navigator>
    </template>
<script>
    import {navigation} from './../Ajax/getData'
    export default{
        name: 'view-timeline',
        data() {
            return {
                navigation
            };
        }
    }
</script>
