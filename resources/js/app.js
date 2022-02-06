

require('./bootstrap');

window.Vue = require('vue');

//for auto scroll
import VueChatScroll from 'vue-chat-scroll';
Vue.use(VueChatScroll);

//for notification
import Toaster from 'v-toaster';
import 'v-toaster/dist/v-toaster.css';


import Vue from 'vue';
import storeVueX from './store/index';
//import vuex
import Vuex from 'vuex';
Vue.use(Vuex);

Vue.use(Toaster, {timeout: 5000});

Vue.use(require('vue-moment'));
Vue.config.devtools = true;

const store = new Vuex.Store(storeVueX);

Vue.component('message', require('./components/message.vue').default);
Vue.component('chat-app', require('./components/ChatApp.vue').default);
Vue.component('main-app', require('./components/MainApp.vue').default);

const app = new Vue({
    el: '#app',
    store,
    data:{
        message:'',
        chat:{
            message:[],
            userData:[],
            color:[],
            time:[],
        },
        typing:'',
        numOfUsers:0,
    },
    watch:{

        message()
        {
            Echo.private('chat')
            .whisper('typing', {
                name: this.message
            });
        }
    },
    methods:{
        send(){
            if(this.message.length != 0)
            {
                this.chat.message.push(this.message);
                this.chat.userData.push('you');
                this.chat.color.push("success");
                this.chat.time.push(this.getCurrentTime());

                axios.post('/djvHR/HR_Portal/public/send', {

                    message : this.message,
                    chat : this.chat,

                  })
                  .then(response => {
                    // console.log(response);
                    this.message = '';

                  })
                  .catch(error => {
                    console.log(error);
                  });

            }
        },
        getOldMessages(){

                axios.post('/getOldMessages')
                  .then(response => {
                      if(response.data != '')
                      {
                          this.chat = response.data;
                      }
                    console.log(response.data);

                  })
                  .catch(error => {
                    console.log(error);
                  });  
        },
        deleteSession: function()
        {  
            axios.post('/deleteSession')

            // .then(response =>this.$toaster.warning('chat history was deleted'));
            this.$toaster.warning('chat history was deleted')

        },
        getCurrentTime()
        {
            let Time = new Date;
            return Time.getHours()+':'+Time.getMinutes();
        }
    },
    mounted()
    {
        this.getOldMessages();
        
        Echo.private('chat')
            .listen('ChatEvent', (e) => {
                this.chat.message.push(e.message);
                this.chat.userData.push(e.user);
                this.chat.color.push("warning");
                this.chat.time.push(this.getCurrentTime());

                axios.post('saveToSession',{
                    chat : this.chat
                })
                .then(response => {
                })
                .catch(error => {
                  console.log(error);
                });
             })

             .listenForWhisper('typing', (e) => {
                 if(e.name != '')
                 {
                    this.typing ="typing...";

                 }
                 else{
                    this.typing ="";
                 }
            })

            Echo.join(`chat`)
                .here((users) => {
                    this.numOfUsers = users.length;
                    // console.log(users);
                })
                .joining((user) => {
                    this.numOfUsers +=1;
                    this.$toaster.success(user.name +' is joined to the chat room');

                })
                .leaving((user) => {
                    this.numOfUsers -=1;
                    this.$toaster.warning(user.name +' is left the chat room');
                });
    }
});
