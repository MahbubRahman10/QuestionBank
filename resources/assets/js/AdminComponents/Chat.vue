<template>
	<div >
		<div class="columns">
			<div class="column is-one-third" v-for="(chatWindow,index) in chatWindows" v-bind:sendid="index.senderid" v-bind:name="index.name">
				<div class="popup-box chat-popup" >
					<div class="popup-head">
						<div class="popup-head-left">{{chatWindow.name}}</div>
						<div class="popup-head-right"><a  v-on:click="closechat(chatWindow.senderid)">&#10005;</a></div>
						<div style="clear: both"></div>
					</div>
					<div class="popup-body" v-chat-scroll>
						<div v-for="date in arrayss">
                            <div class="msgdate"><span>{{ date }}</span></div>
                            <div v-for="value in allchats[chatWindow.senderid]" v-bind:message="value.message" v-if="value.date == date">
    						<p class="msg sender" v-bind:class="value.color" >  {{value.message}} <small id="time">{{  moment(value.time).format(' H:mm ') }}</small></p>
    						</div>
                        </div>
					</div>
					<input type="text" name="mahbub" class="input" :id="chatWindow.senderid" placeholder="Type Message" v-model="message[chatWindow.senderid]" @keyup.enter="send(chatWindow.senderid)">
				</div>
			</div>
		</div>
	</div>
</template>
<script>

    window.moment = require('moment');

    export default {
        components:{
            
        },
        data(){ 
            return{
                chatMessage : [],
                userId : null,
                userName : null,
                chats : [],
                chatWindows : [],
                chatStatus : 0,
                chatWindowStatus : [],
                chatCount : [],
                right : '',

                message : [],
                time : '',
                msg : '',
                allchats:[],
                arrayss: [],
                chatCount : [],
                users : '',
                destination : '',
                currentUser : '',

                typing: '',
                online : ''

            }
        },
        methods:{
    
            letschat:function(id,name){
                var width = document.documentElement.clientWidth;
                if(width < '620' && this.userId != null ){
                   
                    this.closechat(this.userId)
                }
                this.userId = id;
                this.userName = name;   
                this.getOldMessage(this.userId,this.userName);
            },

            createChatWindow(userid,username){
                if(!this.chatWindowStatus[userid]){  
                    this.chatWindowStatus[userid] = 1;
                    this.chatMessage[userid] = '';
                    this.$set(this.allchats, userid , {});
                    this.$set(this.chatCount, userid , 0);

                    var width = document.documentElement.clientWidth;

                    if(width > '620'){                       
                        this.right = $(".popup-box").css('right')
                        if (this.right != undefined ) {
                            $(".popup-box").css('right','+=300px');
                        }
                    }

                    this.chatWindows.push({"senderid" : userid , "name" : username});
                

                }    
            },

            closechat:function(id){
                this.chatWindowStatus[id] = 0;              
                this.chatMessage[id] = '';
                var width = document.documentElement.clientWidth;
                if(width > '620'){ 
                    $(".popup-box").css('right','-=300px');
                }
                this.chatWindows.pop({"senderid" : id});
                
            },

            send:function(id) {
                this.currentUser = id
                if (this.message[id].length !=0) {

                    this.msg = this.message[id];
                    this.message[id] = '';
                   
                    this.time = this.getTime()
                   
                    if (this.arrayss.includes(moment(this.time).format('MMMM Do YYYY')) == false) {
                        this.arrayss.push(moment(this.time).format('MMMM Do YYYY'));   
                    }

                    this.$set(this.allchats[this.currentUser], this.chatCount[this.currentUser] , {
                        "message": this.msg,
                        "color" : 'success',
                        "time": this.time,
                        "date": moment(this.time).format('MMMM Do YYYY')

                    });



                    
                    axios.post('/*/send', { 
                        message : this.msg,
                        destination_id : id
                    })
                    .then(response => {
                       this.msg = ''
                    })
                    .catch( error  => {
                        console.log(error);
                    });

                    this.chatCount[this.currentUser]++;
                }

            },
            getTime(){
                let time = new Date();
                return time
            },
            getOldMessage($id,$name){
                this.createChatWindow($id,$name);
                axios.get('/*/getOldMessage/'+$id)
                .then( response => {  
                    for (var i = 0; i < response.data.length; i++) {
                        if(response.data[i].destination_id == $id){
                            if (this.arrayss.includes(moment(response.data[i].created_at).format('MMMM Do YYYY')) == false) {
                                this.arrayss.push(moment(response.data[i].created_at).format('MMMM Do YYYY'));   
                            }
                            this.$set(this.allchats[$id], this.chatCount[$id] ,{
                                "message" : response.data[i].message,
                                "color" : "success",
                                "date": moment(response.data[i].created_at).format('MMMM Do YYYY'),
                                "time": response.data[i].created_at 
                            });
                        }
                        else{
                            this.$set(this.allchats[$id], this.chatCount[$id] ,{
                                "message" : response.data[i].message,
                                "color" : "warning",
                                "date": moment(response.data[i].created_at).format('MMMM Do YYYY'),
                                "time": response.data[i].created_at
                            });
                        }
                        this.chatCount[$id]++;
                    }
                })
                .catch( error  => {
                    console.log(error);
                });
            },


        },
        watch:{
            message(){
                // Echo.private('adminchat')
                // .whisper('typing', {
                //     name: this.message[this.userId]
                // });
            }
        },
        mounted() {
            var current = document.querySelector('#token').getAttribute('value');


            Echo.private('adminchat')
            .listen('AdminChatEvent', (e) => {

                this.time = this.getTime()
                this.currentUser = e.user_id;
                console.log(this.currentUser)
                if(this.allchats[this.currentUser]){      
                   if(e.destination == current){
                        this.$set(this.allchats[this.currentUser], this.chatCount[this.currentUser] , {
                            "message": e.message,
                            "color" : 'warning',
                            "time": this.getTime()

                        });
                        this.chatCount[this.currentUser]++;  
                    }              
               }else{
                
                    if(e.destination == current){
                        this.getOldMessage(e.user_id,e.user_name)
                        /*this.$set(this.allchats[this.currentUser], this.chatCount[this.currentUser] , {
                            "message": e.message,
                            "color" : 'warning',
                            "time": this.getTime()

                        });
                        this.chatCount[this.currentUser]++;   */
                    }  

               }  
            })
            .listenForWhisper('typing', (e) => {
                if(e.name != ''){
                    this.typing = "typing"
                }
                else{
                    this.typing = ""
                }
            });

            Echo.join(`adminchat`)
            .here((users) => {
                this.online = users.length;
                this.$emit('chat-online',this.online-1);
            })
            .joining((user) => {
                axios.post('/*/admin/online', { 
                    id : user.id
                });
                this.online += 1;
                this.$emit('chat-online',this.online-1);
            })
            .leaving((user) => {
                axios.post('/*/admin/offline', { 
                    id : user.id
                });
                this.online -= 1;
                this.$emit('chat-online',this.online-1);
            });
        }
    }
</script>


<style scoped>



	
body{
	font-family: 'Open Sans', sans-serif;

}


.popup-box.chat-popup{
    z-index: 1;
}

 .popup-box
            {
                display: block;
                position: fixed;
                 bottom: 0px;
                right: 20px;
                height: 350px;
                background-color: rgb(237, 239, 244);
                width: 265px;
                border: 1px solid rgba(29, 49, 91, .3);
            }
            
            .popup-box .popup-head
            {
                background-color: #00a65a;
                padding: 5px;
                color: white;
                font-weight: bold;
                font-size: 14px;
                clear: both;
            }
            

            .popup-box .popup-body
            {
                /*background: #e0e0de;*/
                background: white;
                overflow-y:auto;
                height: 280px;
            }

            .popup-box .popup-head .popup-head-left
            {
                float: left;
            }
            
            .popup-box .popup-head .popup-head-right
            {
                float: right;
                opacity: 0.5;
            }
            
            .popup-box .popup-head .popup-head-right a
            {
                text-decoration: none;
                color: inherit;
            }
            
            .popup-box .popup-messages
            {
                height: 100%;
                overflow-y: scroll;
            }
          
             .popup-box input{
             	border-radius: 0px;
             }


             h1.msg.sender.success{
             	margin-top: 10px;
             	font-size: 15px;
             	padding: 10px 10px;
             	background: white;
             	color: black;
             	display: block;
                line-height: 13px;
             }


             h1.msg.sender.success small{

             	float: right;
             	padding: 9px 0px;
             }	

             h1.msg.sender.warning{
             	margin-top: 10px;
             	font-size: 15px;
             	padding: 10px 10px;
             	background: whitesmoke;
             	color: black;
             	display: block;
                line-height: 13px;
             }


             h1.msg.sender.warning small{
             	
             	float: right;
             	padding: 9px 0px;
             }	

             small {
                font-size: 0.75em;
                float: right;
                margin-top: 14px;
                color: #4c4c4c;
            }

            .success {
                background: #EEEEEE;
                padding: 8px 5px;
                color: #4c4c4c;
                width: 76%;
                margin-left: 54px;
                border-radius: 3%;
                margin-top: 3%;
                font-size: 14px;
                margin-bottom: 10px;
                font-family: "Open Sans", sans-serif;
            }
            .warning {
                background: #EEEEEE;;
                padding: 8px 5px;
                width: 76%;
                margin-bottom: 10px;
                margin-left: 5px;
                border-radius: 3%;
                margin-top: 3%;
                font-size: 14px;
                color: #4c4c4c;
                font-family: "Open Sans", sans-serif;

            }

            .msgdate {
                margin-top: 5px;
                text-align: center;
                font-size: 10px;
                padding: 2px 0px;
            }
            .msgdate  span{
                background: darkgray;
                padding: 2px;
                color: white;
                font-weight: bold;
                border-radius: 2px;
            }

.columns:last-child {
    margin-bottom: 0rem;
}
.columns {
    margin-left: 0px;
    margin-right: 0px;
    margin-top: 0px;
}

.column {
    padding: 0px;
}




</style>