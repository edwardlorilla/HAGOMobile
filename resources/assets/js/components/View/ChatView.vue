<template>
    <v-ons-page>
        <v-ons-toolbar>
            <div class="left">
                <v-ons-back-button>Chat List</v-ons-back-button>
            </div>
            <div class="center">{{getChatInfo}}</div>
        </v-ons-toolbar>
        <virtual-list :size="50" :remain="10" class="list" :start="getStartIndex">
            <div :class="send.uid === chatInfo.detail.uid ? 'receiver-text'  : 'sender-text'"
                 v-for="(send, index) in messages"
                 :index="index"
                 :key="index">
                <p>{{send.message}}</p>
            </div>
            <!-- <div class="receiver-text">
                 <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod. Hey CodePen! Tempor
                     incididunt ut labore et dolore magna aliqua. a aliqua.
                 </p>
             </div>
             <div class="timestamp"><span><b>Today</b> 10:59 AM</span></div>
             <div class="sender-text">
                 <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                     et dolore magna aliqua. a aliqua.
                 </p>
             </div>
             <div class="receiver-text">
                 <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                     et dolore magna aliqua. a aliqua.
                 </p>
             </div>
             <div class="timestamp"><span><b>Today</b> 11:39 AM</span></div>
             <div class="sender-text">
                 <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                     et dolore magna aliqua. a aliqua.
                 </p>
             </div>
             <div class="receiver-text">
                 <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                     et dolore magna aliqua. a aliqua.
                 </p>
             </div>
             &lt;!&ndash;               <div id="old-delivered" class="delivered"><span>Delivered</span></div>&ndash;&gt;
             -->
        </virtual-list>
        <v-ons-bottom-toolbar>
            <div class="input-bar" style="text-align:center">
                <i class="fa fa-camera"></i>
                <v-ons-input id="input-text" v-model="newMessage" type="text"
                             placeholder="Type your question here..."></v-ons-input>
                <v-ons-button class="input-bar-button" id="send" @click="send" modifier="quiet">
                    <v-ons-icon icon="ion-android-send" size="20px"></v-ons-icon>
                </v-ons-button>
            </div>
        </v-ons-bottom-toolbar>


    </v-ons-page>
</template>
<style scoped>

    .input-bar-button {
        /*    margin-top: 5px;*/
        padding: 0;
        height: auto;
        margin-bottom: 5px;
        vertical-align: middle;
    }

    .content-blurred {
        margin-top: 44px;
        padding: 0 1rem;
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        -webkit-filter: blur(10px);
        filter: url(#blur-effect);
        opacity: .35;
        z-index: 1;
    }

    .message-screen {
        height: 100%;
        overflow: auto;

        width: 100%;
        display: block;
        border-bottom: solid 2px #E8E8E8;
    }

    .timestamp {
        width: 100%;
        height: 20px;
        display: inline-block;
        text-align: center;
        vertical-align: middle;

        color: #B4B4B4;
    }

    .timestamp span {
        display: inline-block;
        margin-top: 4px;
        font-weight: 300;
        font-size: 11px;
    }

    .delivered {
        width: 100%;
        height: 20px;
        display: inline-block;
        text-align: right;
        vertical-align: middle;
        color: #B4B4B4;
        margin-top: -5px;
        margin-bottom: 5px;

    }

    .delivered span {
        display: inline-block;

        font-weight: 700;
        font-size: 11px;
        padding-right: 10px;
    }

    .delivered.old {
        display: none;
    }

    .sender-text {
        width: 70%;
        padding: 0;
        border-radius: 15px;
        margin-right: 13px;
        margin-top: 7px;

        margin-bottom: 7px;
        float: right;
        height: auto;
        background-color: #44B5FB;
        color: #eafafc;
        font-weight: 300;
        font-size: 16px;

    }

    .receiver-text {
        width: 70%;
        padding: 0;
        border-radius: 15px;
        margin-left: 13px;
        margin-top: 7px;
        margin-bottom: 7px;
        float: left;
        height: auto;
        background-color: #e5e4ea;
        color: black;
        font-weight: 300;
        font-size: 16px;

    }

    /*
    .sender-text::after
    {
        position:static;
        float: right;
        display: block;
        margin-bottom: -8px;
        margin-right: 2px;
        height: 10px;
        width: 10px;
        background-color: white;
        content: '';
        transform: rotate(45deg)
    }
    .sender-text::before
    {
       position:static;
        float: right;
        display: block;
        margin-top: 155px;
        margin-right:-3px;
        border-radius: 15px 50px;
        height: 11px;
        width: 4px;
        background-color: #44B5FB;
        content: '';
        transform: rotate(320deg);
    }
    */
    .sender-text p, .receiver-text p {
        padding-left: 10px;
        padding-right: 10px;
        line-height: 20px;
        margin-top: 8px;
        margin-bottom: 8px;
        height: 100%;
        /*    width: 90%;*/
    }

    .input-bar {
        width: 100%;
        height: 35px;
        background-color: #F7F7F7;
        z-index: 3;
        text-align: center;
    }

    .input-bar input {
        width: 180px;
        height: 20px;
        border-radius: 4px;
        margin-left: 15px;
        margin-right: 15px;
        vertical-align: middle;
        font-family: inherit;
        margin-top: -8px;
        font-size: 14px;
        display: inline-block;
        border: 1px solid #E8E8E8;
    }

    .input-bar input:focus {
        outline: none;
    }

    ::-webkit-input-placeholder {
        color: #bbb;
        padding-left: 3px;
        letter-spacing: 0.5px;
    }

    .input-bar i {
        color: #89909a;
        font-size: 20px;
        margin-top: 8px;
        /*    padding-left: 0px;*/
        -webkit-transition: all 0.3s ease-in-out;
        -moz-transition: all 0.3s ease-in-out;
        -o-transition: all 0.3s ease-in-out;
        -ms-transition: all 0.3s ease-in-out;
    }

    .input-bar i:hover {
        opacity: 0.3;
        cursor: pointer;
    }

    ::-webkit-scrollbar {

        display: none;
    }
</style>
<script>
    import {chatInfo} from  './../Ajax/getData'

    export default{
        computed: {
            getChatInfo(){
                var vm = this
                return !_.isEmpty(vm.chatInfo.detail) ? (vm.chatInfo.detail.display ? vm.chatInfo.detail.display : vm.chatInfo.detail.name) : null
            },
            getStartIndex(){
                var vm = this
                return vm.messages.length
            }
        },
        data(){
            return {
                chatInfo,
                chatRef: null,
                currentUser: null,
                userId: null,
                messages: [],
                newMessage: '',
                retryCount: 0
            }
        },
        mounted(){
            var vm = this

            vm.userId = vm.chatInfo.detail.uid
            vm.currentUser = firebase.auth().currentUser

            vm.chatRef = firebase.database().ref().child(`chats/${vm.userId}`)
            vm.chatRef.on('child_added', function (snapshot) {
                if (snapshot.val().id === vm.userId || snapshot.val().id === vm.currentUser.uid) {
                    vm.messages.push(snapshot.val())
                }
            })
/*
            var scroll = this.$refs.messagescreen,
                scrollInterval = setInterval(function () {
                    vm.scroll()
                console.log((scroll.scrollTop + (scroll.scrollHeight - scroll.scrollTop)),  scroll.scrollHeight)
                if ((scroll.scrollTop + (scroll.scrollHeight - scroll.scrollTop)) === scroll.scrollHeight ) {
                    console.log('retry finish')
                    clearInterval(scrollInterval)
                }else{
                    console.log('retry')
                }
            }, 1000);*/


        },
        methods: {
            send(){
                var vm = this;
                let data = {
                    id: vm.currentUser.uid,
                    message: vm.newMessage
                };

                vm.chatRef.push(data, function (snapshot) {
                    vm.newMessage = ''
                })

            }
        }
    }
</script>
