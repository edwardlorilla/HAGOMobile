<template>
    <div>
        <div class="w3-container" :class="{'w3-half': w3Half }">
            <header style="padding-top:22px">
                <h5><b><i class="fa fa-dashboard"></i> Users</b></h5>
                <h5>
                    <div class="w3-row-padding">
                        <div class="w3-bar">
                            <button @click="currentView = 'create'" class="w3-left w3-bar-item w3-button w3-green "><i
                                    class="zmdi zmdi-account-add"></i> Add User
                            </button>
                            <!--<button class="w3-left w3-bar-item w3-button w3-blue" >Messages-->
                            </button>
                            <input type="text" class="w3-input w3-border w3-right w3-bar-item" v-model="search"
                                   placeholder="Search..."
                                   style="width:30%; margin-bottom: 2px;">
                        </div>


                    </div>
                </h5>
            </header>

            <edit v-if="currentView  && currentView != 'create'"
                  @close="currentView = ''; userInfo = null; updateUser($event)" :user="userInfo"></edit>

            <delete v-else-if="currentView  && currentView != 'create'"
                    @close="currentView = ''; userInfo = null;" :user="userInfo"></delete>

            <create v-else-if="currentView && currentView === 'create'" @close="currentView = ''"></create>

            <table class="w3-table w3-bordered w3-striped w3-border test w3-hoverable">
                <tr class="w3-green">
                    <th>Name</th>
                    <th>Email</th>
                    <th v-if="!w3Half">Actions</th>
                </tr>
                <tbody>
                <user v-if="usersLimit"
                      :half="!w3Half"
                      @edit="actions('edit', $event)"
                      @chat="chat($event)"
                      @delete="actions('delete', $event)"
                      v-for="(user, index) in usersLimit"
                      :key="index"
                      :user="user"></user>
                </tbody>
            </table>
            <pagination :current-page="pageOne.currentPage"
                        :items-per-page="pageOne.itemsPerPage"
                        :total-items="totalSearch"
                        @page-changed="pageOneChanged">
            </pagination>
        </div>
        <div class="w3-container w3-half" v-if="w3Half">
            <user-chat :user="userInfo" v-if="w3Half" @close="w3Half = !w3Half"></user-chat>
        </div>
    </div>
</template>

<script>
    import {list, removeUser} from './../Ajax/getData'
    import User from './../User/User.vue'
    import Edit from './../User/edit.vue'
    import Delete from './../User/delete.vue'
    import Create from './../User/create.vue'
    import UserChat from './../User/UserChat.vue'
    export default{
        components: {
            User,
            Create,
            Edit,
            Delete,
            UserChat
        },
        data(){
            return {
                w3Half: false,
                list,
                pageOne: {
                    currentPage: 1,
                    totalPages: null,
                    itemsPerPage: 10
                },
                search: '',
                currentView: null,
                userInfo: null,
                fuse: null,
                options: {
                    shouldSort: true,
                    threshold: 0.6,
                    location: 0,
                    distance: 100,
                    maxPatternLength: 32,
                    minMatchCharLength: 1,
                    keys: [
                        "name",
                        "email"
                    ]
                }
            }
        },
        computed: {
            usersLimit() {
                var vm = this
                var index = vm.pageOne.currentPage * vm.pageOne.itemsPerPage - vm.pageOne.itemsPerPage
                return (vm.search.trim() === '') ? vm.list.users.slice(index, index + vm.pageOne.itemsPerPage) : vm.fuse.search(vm.search.trim()).slice(index, index + vm.pageOne.itemsPerPage)
            },
            totalSearch(){
                var vm = this
                var index = vm.pageOne.currentPage * vm.pageOne.itemsPerPage - vm.pageOne.itemsPerPage
                return (vm.search.trim() === '') ? vm.list.users.length : vm.fuse.search(vm.search.trim()).length
            }
        },
        methods: {
            chat(user){
                var vm = this
                vm.w3Half = false
                setTimeout(function(){
                    vm.w3Half = true
                    vm.userInfo = user
                }, 100);

            },
            updateUser(user){
                var vm = this
                if (user) {
                    var userIndex = _.findIndex(vm.list.users, ['id', user.id]);
                    vm.$set(vm.list.users, userIndex, user)
                }
            },
            actions(action, user){
                var vm = this
                console.log(action, user)
                if (action === 'delete') {
                    removeUser(user)
                    vm.currentView = 'delete'
                }
                else {
                    vm.currentView = 'edit'
                }
                if (user) {
                    //need to clone to prevent the reativity of one updating
                    var clone = _.clone(user)
                    vm.userInfo = clone
                }
            },
            pageOneChanged (pageNum) {
                this.pageOne.currentPage = pageNum
            },

            stateModal(){
                var vm = this
                vm.showModal == 'none' ? vm.showModal = 'block' : vm.showModal = 'none'
            }
        },
        mounted(){
            var vm = this;

            vm.fuse = new window.Fuse(vm.list.users, vm.options);
            vm.pageOne.totalPages = this.list.users.length
        },
    }
</script>
