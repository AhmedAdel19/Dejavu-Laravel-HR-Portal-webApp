<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<template>

  <div class="container-fluid h-100">
			<div class="row justify-content-center h-100">
				<div class="col-md-4 col-xl-3 chat"><div class="card mb-sm-3 mb-md-0 contacts_card">
					<div class="card-header">
						<div class="input-group">
							<input v-model="username" @keyup.enter="userListSearch()" type="text" placeholder="Search..." name="" class="form-control search">
							<div class="input-group-prepend">
								<span @keyup.enter="userListSearch()" class="input-group-text search_btn"><i class="fas fa-search"></i></span>
							</div>

                         <div>
                             <select class="browser-default custom-select" v-model='group_name' @change='get_group_users_list()'>
                             <option selected="selected" style="margin-left: 35px;">Choose Group</option> 
                             <option  v-for="group in groupsList" :key="group.id" :value='group.group_name' style="margin-left: 35px;">{{group.group_name}}</option>
                             </select>
         
                        </div>

                        
  
						</div>

					</div>
                    <!-- <h1>{{userListSearcharr.length}}</h1> -->
                    <div v-if="userListSearcharr.length != 0" class="card-body contacts_body">
						<ul class="contacts">
						<li @click.prevent="selectUser(user.id)" class="active" v-for="user in userListSearcharr" :key="user.id">
							<div class="d-flex bd-highlight">
								<div class="img_cont">
                                    <img v-bind:src="'/storage/EmployeeProfileImages/' + user.user_pp" class="rounded-circle user_img">
                                    <div v-if="onlineUser(user.id) || online.id == user.id">
                                        <span  class="online_icon"></span>
                                    </div>
                                    <div v-else>
                                        <span  class="offline_icon"></span>
                                    </div>
                                    
								</div>
								<div v-if="onlineUser(user.id)" class="user_info">
									<span>{{user.name}}</span>
									<p>{{user.name}} is online</p>
								</div>
                                <div v-else class="user_info">
									<span>{{user.name}}</span>
									<p>{{user.name}} is offline</p>
								</div>
							</div>
						</li>
						</ul>
					</div>
                    <div v-else-if="groupUsersList.length != 0" class="card-body contacts_body">
                    <ul class="contacts">
						<li @click.prevent="selectUser(user.id)" class="active" v-for="user in groupUsersList" :key="user.id">
							<div class="d-flex bd-highlight">
								<div class="img_cont">
                                    <img v-bind:src="'/storage/EmployeeProfileImages/' + user.user_pp" class="rounded-circle user_img">
                                    <div v-if="onlineUser(user.id)">
                                        <span  class="online_icon"></span>
                                    </div>
                                    <div v-else>
                                        <span  class="offline_icon"></span>
                                    </div>
                                    
								</div>
                 
								<div v-if="onlineUser(user.id)" class="user_info" >
									<span>{{user.name}}</span>
									<p>{{user.name}} is online</p>
								</div>
                                <div v-else class="user_info">
									<span>{{user.name}}</span>
									<p>{{user.name}} is offline</p>
								</div>
							</div>
						</li>
						</ul>
                    </div>
					<div v-else class="card-body contacts_body">
						<ul class="contacts">
						<li @click.prevent="selectUser(user.id)" class="active" v-for="user in userList" :key="user.id">
							<div class="d-flex bd-highlight">
								<div class="img_cont">
                                    <img v-bind:src="'/storage/EmployeeProfileImages/' + user.user_pp" class="rounded-circle user_img">
                                    <div v-if="onlineUser(user.id)">
                                        <span  class="online_icon"></span>
                                    </div>
                                    <div v-else>
                                        <span  class="offline_icon"></span>
                                    </div>
                                    
								</div>
                 
								<div v-if="onlineUser(user.id)" class="user_info" >
									<span>{{user.name}}</span>
									<p>{{user.name}} is online</p>
								</div>
                                <div v-else class="user_info">
									<span>{{user.name}}</span>
									<p>{{user.name}} is offline</p>
								</div>
							</div>
						</li>
						</ul>
					</div>
					<div class="card-footer"></div>
				</div></div>
				<div class="col-md-8 col-xl-6 chat">
					<div class="card">
						<div class="card-header msg_head">
							<div v-if="userMessages.user" class="d-flex bd-highlight">
								<div class="img_cont">
									<img v-bind:src="'/storage/EmployeeProfileImages/' + userMessages.user.user_pp" class="rounded-circle user_img">
									<div v-if="onlineUser(userMessages.user.id)">
                                        <span  class="online_icon"></span>
                                    </div>
                                    <div v-else>
                                        <span  class="offline_icon"></span>
                                    </div>
								</div>
								<div class="user_info">
									<span>{{userMessages.user.name}}</span>
                                    
									<p style="font-size:13px;">{{userMessages.messagesCount}} messages</p>
								</div>
								<div class="video_cam">
									<span><i class="fas fa-video"></i></span>
									<span><i class="fas fa-phone"></i></span>
								</div>
							</div>
							<span v-if="userMessages.user" id="action_menu_btn"><i class="fas fa-ellipsis-v"></i></span>
                            <span v-else style="display:none;" id="action_menu_btn"><i class="fas fa-ellipsis-v"></i></span>
                            <div class="action_menu">
								<ul>
									<li><i class="fas fa-user-circle"></i> View profile</li>
									<li @click.prevent="deleteAllMessages()"><i class="fas fa-trash-alt"></i> Delete Chat</li>
									<!-- <li><i class="fas fa-plus"></i> Add to group</li>
									<li><i class="fas fa-ban"></i> Block</li> -->
								</ul>
							</div>
                            
						</div>
                        
						<div class="card-body msg_card_body" v-chat-scroll>
							<div v-for="message in userMessages.messages" :key="message.id">
                                <template v-if="message.user.id == userMessages.user.id">
                                    <div class="d-flex justify-content-start mb-4">
                                        <ul class="nav nav-tabs">
                                            <li class="nav item-drop-down">
                                                <span style="cursor: pointer;color:#fff;padding: 9px;" class="nav-linl" data-toggle="dropdown"  aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></span>
                                                <div style="position: relative;;color: rgb(255, 255, 255);background-color: rgb(129, 203, 220);border-radius: 28px;" class="dropdown-menu">
                                                    <a @click.prevent="deleteSingleMessage(message.id)" style="color:#000;background-color: rgb(129, 203, 220); cursor: pointer;border-radius: 15px;" class="dropdown-item" type="button"><i class="fas fa-trash-alt"></i>Delete Message</a>
                                                </div>
                                            </li>
                                        </ul>


                                        
                                        <div class="img_cont_msg">
                                            
                                            <img v-bind:src="'/storage/EmployeeProfileImages/' + message.user.user_pp" class="rounded-circle user_img_msg">
                                        </div>
                                        <div class="msg_cotainer">
                                            
                                            {{message.message}}
                                        </div>
                                        <div class="msg_time">
                                        <span>{{message.created_at | moment("calendar")}}</span>
                                        </div>
                                        
                                    </div>

                                </template>
                                
                                <template v-else>
                                    <div class="d-flex justify-content-end mb-4">
                                        <div class="msg_time_send">
                                            
                                            <span>{{message.created_at | moment("calendar")}}</span>
                                        </div>
                                        <div class="msg_cotainer_send">
                                            {{message.message}}
                                        </div>

                                        <div class="img_cont_msg">
                                            <img v-bind:src="'/storage/EmployeeProfileImages/' + message.user.user_pp" class="rounded-circle user_img_msg">
                                        </div>
                                        <ul class="nav nav-tabs">
                                            <li class="nav item-drop-down">
                                                <span style="cursor: pointer;color:#fff;padding: 9px;" class="nav-linl" data-toggle="dropdown"  aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></span>
                                                <div style="position: relative;;color: rgb(255, 255, 255);background-color: rgb(129, 203, 220);border-radius: 28px;" class="dropdown-menu">
                                                    <a @click.prevent="deleteSingleMessage(message.id)" style="color:#000;background-color: rgb(129, 203, 220); cursor: pointer;border-radius: 15px;" class="dropdown-item" type="button"><i class="fas fa-trash-alt"></i>Delete Message</a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>

                                </template>

							</div>
						</div>
                        <!-- <div v-if="typing" class="badge badge-pill badge-primary">{{ typing }} typing....</div> -->
                        <div class="badge badge-pill badge-primary">{{ typing }}</div>
                        <!-- <div v-else style="display:none;" class="badge badge-pill badge-primary">{{ typing }}</div> -->
                        <div class="card-footer">
							<div class="input-group">
								<div class="input-group-append">
									<span class="input-group-text attach_btn"><i class="fas fa-paperclip"></i></span>
								</div>
								<input v-if="userMessages.user" @keydown="typingEvent(userMessages.user.id)" @keyup.enter="sendMessage" v-model="message" name="" class="form-control type_msg" placeholder="Type your message..."/>
                                <input v-else disabled @keyup.enter="sendMessage" v-model="message" name="" class="form-control type_msg" placeholder="Type your message..."/>
                                <div class="input-group-append">
									<span v-if="userMessages.user" @click.prevent="sendMessage" class="input-group-text send_btn"><i class="fas fa-location-arrow"></i></span>
                                    <span v-else disabled @click.prevent="sendMessage" class="input-group-text send_btn"><i class="fas fa-location-arrow"></i></span>
                                </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
</template>




<script>
import _ from 'lodash'

Vue.prototype.$userId = document.querySelector("meta[name='user-id']").getAttribute('content');
Vue.prototype.$authuserName = document.querySelector("meta[name='auth-user-name']").getAttribute('content');
Vue.prototype.$authuserChatFlag = document.querySelector("meta[name='auth-user-chatFlag']").getAttribute('content');


export default {
    computed:{
        userList(){
        return this.$store.getters.userList
        },
        userMessages(){
        return this.$store.getters.userMessages
        },
        userAuthChat(){
            if(this.$authuserChatFlag == "yes"){
                return true;
            }
            else{
                return false;
            }
        }
    },
    data()
    {
        return{
            message :'',
            username:'',
            typing :'',
            users:[],
            userListSearcharr:[],
            userListArr:[],
            online:'',
            groupsList :[],
            groupUsersList:[],
            group_name :'Choose Group'
           
        }
    },
    created()
    {
        

        
    Echo.join('onlineuser')
    .here((users) => {
        this.users = users;
    })
    .joining((user) => {
        this.online = user;
        this.$toaster.success(user.name +' is Online now');
        this.onlineUser(user.id);
        
    })
    .leaving((user) => {
        this.online = user;
        this.$toaster.warning(user.name +' is Offline now');
        this.id = this.userMessages.user.id;
        
    });



    },
    methods :{
    selectUser(userId){
        this.$store.dispatch('userMessages' , userId);
    },
    sendMessage(e)
    {
        e.preventDefault();
        if(this.message != '')
        {
            axios.post('sendMessage' , {
                message : this.message,
                user_id : this.userMessages.user.id
            })
            .then(response =>{
                this.selectUser(this.userMessages.user.id);
                // console.log(response.data);
                this.message= '';
            })
            this.message= '';
            this.typing='';

        }else{
            alert('the message content is empty !');
        }
    },
    deleteSingleMessage(messageId){
        axios.get(`deleteSingleMessage/${messageId}`)
        .then(response =>{
            this.selectUser(this.userMessages.user.id);
        })
    },
    deleteAllMessages(){
        axios.get(`deleteAllMessages/${this.userMessages.user.id}`)
        .then(response =>{
            this.selectUser(this.userMessages.user.id);
        })
    },
    typingEvent(userId){
        if(this.message != "")
        {
        Echo.private('typingevent')
        .whisper('typing', {
         'user' : this.$authuserName,
         'name' : this.message,
         'userId' : userId
        });   
        }
    },
    onlineUser(userId){
    
        return _.find(this.users , {'id' : userId});
        
    },
    userListSearch(){
        axios.post(`userListSearch`,{
            name : this.username
        })
        .then(response =>{
            this.userListSearcharr = response.data;
            if(this.userListSearcharr.length == 0){
            this.$toaster.error('Sorry , this username not found');
            }

        })
    },
    getAllUsres(){
        axios.get(`allUsres`,{
            name : this.username
        })
        .then(response =>{
            this.userListArr = response.data;
        })
    },
    getAllGroups(){
        axios.get('allGroups')
        .then(response =>{
            this.groupsList = response.data
            console.log(this.groupsList);
        })
    },
        get_group_users_list(){
        axios.post('groupUsers',{
            group_name : this.group_name
        })
        .then(response =>{
            this.groupUsersList = response.data;
            if(this.groupUsersList.length == 0){
                this.$toaster.error('No employee found in this group');
            }

        })
    },

    },
    mounted()
    {
        this.getAllGroups();
        this.getAllUsres();
       Echo.private(`chat.${this.$userId}`)
        .listen('ChatEvent', (e) => {
            this.selectUser(e.message.from);
            // console.log(e.message);
        });

        Echo.private('typingevent')
        .listenForWhisper('typing', (e) => {
            if(e.name != "")
                 {
                    this.typing = e.user +" typing...";

                 }
                 else{
                    this.typing ="";
                 }

            setTimeout(() => {
                this.typing =""
                 }, 2500);
            console.log(e.user);
            console.warn(e.name);
        });

        this.$store.dispatch('userList');

        $('#action_menu_btn').click(function(){
        $('.action_menu').toggle();
        });

    },

}
</script>
