<template>
    <div class="chat">
        <div class="chat-header clearfix">

            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_01_green.jpg"
                 alt="avatar"/>

            <div class="chat-about">
                <div class="chat-with">Chat with {{getChatInfo.name}}</div>
                <div class="chat-num-messages">already {{getStartIndex}} messages</div>
            </div>
            <i class="fa fa-star" @click="scrollToEnd"></i>
            <i @click="$emit('close')" class="fa fa-arrow-left" aria-hidden="true"></i>
        </div> <!-- end chat-header -->
        <div class="chat-history">
            <virtual-list :size="30" :remain="10" class="container" wclass="w3-ul" wtag="ul">
                <li v-for="(send, index) in getChat"
                    :index="index"
                    :key="index"
                    :class="send.from !== userId ? 'clearfix'  : ''">
                    <div class="message-data" :class="send.from !== userId ? 'align-right'  : ''">
                        <span class="message-data-time">5:15 PM, Today</span> &nbsp; &nbsp;
                        <span class="message-data-name">Olia</span> <i class="fa fa-circle me"></i>
                    </div>
                    <div class="message" :class="send.from !== userId ? 'other-message float-right'  : 'my-message'">
                        {{send.message }}
                    </div>
                </li>
            </virtual-list>
        </div> <!-- end chat-history -->

        <div class="footer chat-message clearfix">
                    <textarea name="message-to-send"
                              v-model="newMessage"
                              id="message-to-send" placeholder="Type your message"
                              rows="3"></textarea>

            <i class="fa fa-file-o"></i> &nbsp;&nbsp;&nbsp;
            <i class="fa fa-file-image-o"></i>

            <button @click="send">Send</button>

        </div>
    </div>
</template>
<style>
    .chat .chat-header {
        padding: 20px;
        border-bottom: 2px solid white;
    }

    .chat .chat-header img {
        float: left;
    }

    .chat .chat-header .chat-about {
        float: left;
        padding-left: 10px;
        margin-top: 6px;
    }

    .chat .chat-header .chat-with {
        font-weight: bold;
        font-size: 16px;
    }

    .chat .chat-header .chat-num-messages {
        color: #92959E;
    }

    .chat .chat-header .fa-star {
        float: right;
        color: #D8DADF;
        font-size: 20px;
        margin-top: 12px;
    }

    /*  .chat .chat-history {
          padding: 30px 30px 20px;
          border-bottom: 2px solid white;
          overflow-y: scroll;
          height: 350px;
      }
  */
    .chat .chat-history .message-data {
        margin-bottom: 15px;
    }

    .chat .chat-history .message-data-time {
        color: #a8aab1;
        padding-left: 6px;
    }

    .chat .chat-history .message {
        color: white;
        padding: 18px 20px;
        line-height: 26px;
        font-size: 16px;
        border-radius: 7px;
        margin-bottom: 30px;
        width: 90%;
        position: relative;
    }

    .chat .chat-history .message:after {
        bottom: 100%;
        left: 7%;
        border: solid transparent;
        content: " ";
        height: 0;
        width: 0;
        position: absolute;
        pointer-events: none;
        border-bottom-color: #86BB71;
        border-width: 10px;
        margin-left: -10px;
    }

    .chat .chat-history .my-message {
        background: #86BB71;
    }

    .chat .chat-history .other-message {
        background: #94C2ED;
    }

    .chat .chat-history .other-message:after {
        border-bottom-color: #94C2ED;
        left: 93%;
    }

    .chat .chat-message {
        padding: 30px;
    }

    .chat .chat-message textarea {
        width: 100%;
        border: none;
        padding: 10px 20px;
        font: 14px/22px "Lato", Arial, sans-serif;
        margin-bottom: 10px;
        border-radius: 5px;
        resize: none;
    }

    .chat .chat-message .fa-file-o, .chat .chat-message .fa-file-image-o {
        font-size: 16px;
        color: gray;
        cursor: pointer;
    }

    .chat .chat-message button {
        float: right;
        color: #94C2ED;
        font-size: 16px;
        text-transform: uppercase;
        border: none;
        cursor: pointer;
        font-weight: bold;
        background: #F2F5F8;
    }

    .chat .chat-message button:hover {
        color: #75b1e8;
    }

    .online, .offline, .me {
        margin-right: 3px;
        font-size: 10px;
    }

    .online {
        color: #86BB71;
    }

    .offline {
        color: #E38968;
    }

    .me {
        color: #94C2ED;
    }

    .align-left {
        text-align: left;
    }

    .align-right {
        text-align: right;
    }

    .float-right {
        float: right;
    }

    .clearfix:after {
        visibility: hidden;
        display: block;
        font-size: 0;
        content: " ";
        clear: both;
        height: 0;
    }

    .footer {
        position: fixed;
    }
</style>
<script>
    export default{
        props: ['user'],
        computed: {
            getChatInfo(){
                var vm = this
                return !_.isEmpty(vm.user) ? vm.user : null
            },
            getChat(){
                var vm = this
                return !_.isEmpty(vm.messages) ? vm.messages : null
            },
            getStartIndex(){
                var vm = this
                return vm.messages.length
            }
        },
        mounted(){
            var vm = this

            vm.userId = vm.user.id.toString()


            vm.currentUser = firebase.auth().currentUser
            console.log(vm.userId, vm.currentUser)

            vm.chatRef = firebase.database().ref().child(`chats/admin`)
            vm.chatRef.on('child_added', function (snapshot) {
                if ((snapshot.val().to === vm.userId || snapshot.val().from === vm.userId) &&
                    (snapshot.val().to === vm.currentUser.displayName || snapshot.val().from === vm.currentUser.displayName)) {
                    vm.messages.push(snapshot.val())


                }
            })


        },
        methods: {
            scrollToEnd: function () {
                var container = this.$el.querySelector(".container");
                container.scrollTop = container.scrollHeight;
            },
            send(){
                var vm = this;
                let data = {
                    from: vm.currentUser.displayName,
                    to: vm.userId,
                    message: vm.newMessage
                };

                vm.chatRef.push(data, function (snapshot) {
                    vm.newMessage = ''
                    vm.scrollToEnd()
                })

            }
        },
        data(){
            return {
                chatRef: null,
                currentUser: null,
                userId: null,
                messages: [],
                newMessage: '',
                retryCount: 0
            }
        },
    }
</script>
