<template>
	<div>
		<header class="heads" >
			<nav> <!-- <nav v-on-clickaway="away"> -->
				<a class="sidebar-toogle is-pulled-left" v-on:click="toogle_menubar">
					<i class="fa fa-bars" aria-hidden="true"></i>
				</a>
				<!--<span class="sub-head">Mahbub Rahman</span> -->
				
				<ul class="sidebar-menus is-pulled-right"  id="nav">
					<li>
						<a class="dropdown is-right" v-on:click="msg" v-on-clickaway="msgaway" v-bind:class="activemsg">
							<i class="fa fa-envelope-o" aria-hidden="true" id="fa"></i>
							<span class="fa-msg" v-if="seen != '0'" v-show="messagecount">{{ seen }} </span>
							<div class="dropdown-menu" id="dropdown-menu-mn" role="menu">

								<div class="dropdown-content">
									<div id="dropdown-content-scroll">
									<h2>You Have {{ seen }} unread message(s)</h2>
										<div id="dropdown-content" v-for="(message, index) in getmessages" >
											<a v-on:click="viewmessage(index)" class="dropdown-item" v-if="message.status == 1 && message.category == 'normal'">
												{{ message.name }}
												<br>
												<span>{{ message.email }}</span>
											</a>
											<a  v-if="message.status == 1 && message.category == 'normal'" v-on:click="viewmessage(index)" class="dropdown-item"  style="background:#eee;">
												{{ message.name }}
												<br>
												<span>{{ message.email }}</span>
											</a>
											<a v-on:click="viewreport(index)" class="dropdown-item" v-if="message.status == 1 && message.category == 'report'">
												A new Report From Forum
												<br>
												<span> Reply Id :  {{ message.email }}</span>
											</a>
											<a v-on:click="viewreport(index)"  v-if="message.status == 0 && message.category == 'report'" class="dropdown-item"  style="background:#eee;">
												A new Report From Forum
												<br>
												<span>Reply Id :  {{ message.email }}</span>
											</a>
											<hr class="dropdown-divider">
										</div>
									</div>
									<h3><router-link :to="{name:'message'}" >view all message</router-link></h3>
								</div>
							</div>
						</a>
					</li>
					<!-- <li>
						<a class="dropdown is-right " v-on:click="notify" v-on-clickaway="notifyaway" v-bind:class="activenotify">
							<i class="fa fa-bell-o" aria-hidden="true" id="fa"></i>
							<span class="fa-notify">0</span>
							<div class="dropdown-menu" id="dropdown-menu-mn" role="menu">

								<div class="dropdown-content">
									<h2>You Have 4 new notification(s)</h2>
									<div id="dropdown-content">
										<a class="dropdown-item">
											This is testx
										</a>
										<hr class="dropdown-divider">
										<a class="dropdown-item">
											<p>You simply need to use a <code>&lt;div&gt;</code> instead.</p>
										</a>
										<hr class="dropdown-divider">
										<a href="#" class="dropdown-item">
											This is a link
										</a>
									</div>
									<h3><a href="" >view all notifications</a></h3>
								</div>
							</div>
						</a>
					</li> -->
					<!-- <li>
						<a class="dropdown is-right" v-on:click="chat" v-on-clickaway="chataway" v-bind:class="activechat">
							<i class="fa fa-comment" aria-hidden="true" id="fa"></i>
							<span class="fa-chat" v-show="onlineusers">{{online}}</span>
							<div class="dropdown-menu" id="dropdown-menu-mn" role="menu">
								<div class="dropdown-content">
									<div class="dropdown-content">
										<div v-for="admins in admin">
										<a class="dropdown-item control has-icons-left has-icons-right"  v-on:click="letschat(admins.id,admins.name)">
											<span class="">
												{{  admins.name }}
											</span>
											<span class="icon is-small is-right "  v-if="admins.status == 'online'">
												<i class="fa fa-check-circle" aria-hidden="true"></i>
											</span>
										</a>
										<hr class="dropdown-divider">
										</div>
									</div>
								</div>
							</div>
						</a>
					</li> -->
					<li class="imgclass">
						<a class="dropdown is-right " v-on:click="profile" v-on-clickaway="profileaway" v-bind:class="activeprofile">	
							<img v-show="loading" v-if="adminimage == null" src="http://localhost:8000/img/profile-default.jpg"  class="user-image">
							<img v-show="loading"  v-if="adminimage != null" :src="adminimage"  class="user-image">
							<span class="sidebar-menu-user is-right">
								
							</span>

							<div class="dropdown-menu" id="dropdown-menu-img" role="menu">
								<div class="dropdown-content">
									<router-link :to="{name :'adminprofile'}" class="dropdown-item">My Profile </router-link>
									<hr class="dropdown-divider">
									<a href="/admin/logout" class="dropdown-item">
										<p>Logout</p>
									</a>
								</div>
							</div>
						</a>
					</li>
				</ul>
			</nav>
		</header>

		<!-- Model for view Message -->
		<div class="modal" v-bind:class="activeviewmodal">
			<div class="modal-background"></div>
			<div class="modal-card">
				<header class="modal-card-head">
					<p class="modal-card-title">Message</p>
					<button class="delete" aria-label="close" v-on:click="deview"></button>
				</header>
				<section class="modal-card-body">
					
					<!-- Content ... -->
					<p> <strong>Name : </strong> {{name}} </p><br>
					<p> <strong>Email : </strong> {{email}} </p><br>
					<p> <strong>Message : </strong> {{message}} </p><br>
					<p> <strong>Date : </strong> {{ moment(date).format('LL') }} </p><br>
					<a v-on:click="sendmail" class="button is-primary is-outlined">Reply</a>
				</section>
				<footer class="modal-card-foot">
					<button class="button" v-on:click="deview">Close</button>
				</footer>
			</div>
		</div>

		<chat ref="chat" v-on:chat-online="chatonline">></chat>

	</div>

</template>

<script>
	
	import { mixin as clickaway } from 'vue-clickaway';
	import Chat from './Chat.vue';
    export default {

    	mixins: [ clickaway ],

    	components:{
            'chat' : Chat
        },
    	data(){	
    		return{
    			messagecount: false,
    			loading:false,
    			heads : 'on',
    			activenotify: '',
    			activemsg: '',
    			activechat: '',
    			activeprofile: '',
    			show:false,

    			admin : [],
    			onlineusers : false,
    			online : '',

    			admins : [],
    			adminimage : '',

    			getmessages : [],
    			seen : '',

    			activeviewmodal: '',
    			name : '',
    			email : '',
    			message : '',
    			date : ''
     		}
    	},
    	methods:{
    		getadmin:function() {
    			axios.get('/*/admin/getadmin')
    			.then( response => {  
    				this.admins = response.data
    				if (this.admins.image != null) {
    					var link = "http://localhost:8000/upload/admins/"
    					var data = this.admins.image
    					this.adminimage = link+data
    				}else{
    					this.adminimage = null
    				}
    				this.loading = true
    			})
    			.catch( error  => {
    				console.log(error);
    			});	
    		},
    		getmessage:function() {
    			axios.get('/*/admin/contact-us/getmessage')
    			.then( response => {  
    				this.getmessages = response.data.contact
    				this.seen = response.data.seen
    				if (this.seen != '0') {
    					this.messagecount = true
    				}
    				this.getmessage()
    			})
    			.catch( error  => {
    				console.log(error);
    			});	
    		},
    		viewmessage:function(index){
    			this.activeviewmodal = 'is-active'
    			this.name = this.getmessages[index].name
    			this.email = this.getmessages[index].email
    			this.message = this.getmessages[index].message
    			this.date = this.getmessages[index].created_at

    			axios.post('/*/admin/contact-us/seenmessage', { 
    				id : this.getmessages[index].id
    			}).then(response => {
					this.seen = response.data
				})
    			.catch( error  => {
    				console.log(error);
    			});
    		},
    		viewreport:function(index){
    			axios.post('/*/admin/contact-us/seenmessage', { 
    				id : this.getmessages[index].id
    			}).then(response => {
    				this.seen = response.data
    				this.$router.push({name : 'forumreply'})
    			})
    			.catch( error  => {
    				console.log(error);
    			});
    		},
			sendmail(){
				localStorage.setItem('email',this.email);
				this.$router.push({name : 'mailcompose'})
			},
    		deview:function(){
				this.activeviewmodal = ''
			},
    		msg:function(){
    			if(this.activemsg == ''){
    				this.activemsg = "is-active"
    			}
    			else{
    				this.activemsg = ""
    			}
    		},
    		notify:function(){
    			if(this.activenotify == ''){
    				this.activenotify = "is-active"
    			}
    			else{
    				this.activenotify = ""
    			}
    		},
    		chat:function(){
    			if(this.activechat == ''){
    				this.activechat = "is-active"
    			}
    			else{
    				this.activechat = ""
    			}
    		},
    		profile:function(){
    			if(this.activeprofile == ''){
    				this.activeprofile = "is-active"
    			}
    			else{
    				this.activeprofile = ""
    			}
    		},
    		msgaway: function() {
      			if(this.activemsg == 'is-active'){
      				this.activemsg = ''
      			}
      			
    		},
    		notifyaway: function() {
      			if(this.activenotify == 'is-active'){
      				this.activenotify = ''
      			}
      			
    		},
    		chataway: function() {
      			if(this.activechat == 'is-active'){
      				this.activechat = ''
      			}
      			
    		},
    		profileaway: function() {
      			if(this.activeprofile == 'is-active'){
      				this.activeprofile = ''
      			}
      			
    		},



    		letschat:function(id,name){
    			 var child = this.$refs.chat;
    			 child.letschat(id,name);
    		},
    		chatonline:function(value) {
    			this.online = value;
    			this.onlineusers = true
    		},
    		
    		toogle_menubar:function(){

    			this.$emit('click-toggle','click');
    			/*
    			if($( document ).width() > 720){
	    			if( $('.head').is(':visible') ) {
	    				$('.head').animate({ 'width': '0px' }, '1200', function(){
	    					$('.head').hide();
	    				});

	    				$('.sub-head').css('display', 'inline-block');
	    			}
	    			else {
	    				$('.head').show();
	    				$('.head').animate({ 'width': '230px' }, '1200');
	    				$('.sub-head').css('display', 'none');
	    			}
    			}
    			*/
    			if($('.head').css('display') == 'block'){
	    			if(this.heads == 'on') {
	    				this.heads = 'off'
	    				$('.heads').animate({ 'margin-left': '0px' }, '1200', function(){
	    				});
	    			}
	    			else {	    				
	    				this.heads = 'on'
	    				$('.heads').animate({ 'margin-left': '230px' }, '1200');
	    			}
    			}
    		}
    	},
        mounted() {

        	this.getadmin()
        	this.getmessage()
        	axios.get('/*/getalladmin')
        	.then(function (response) {
        		this.admin = response.data
        	}.bind(this))
        	.catch(function (error) {
        		console.log(error);
        	});
        
        }
    }
</script>



<style scoped>



	
body{
	font-family: 'Open Sans', sans-serif;

}

i{
	font-size: 20px;
	color: #fff;
}

.heads{
	background:  #363b3f; /*#00a65a;*/
	width: auto;
	margin-left: 230px;
	height: 53px;
	display: block;

	margin-bottom: 30px;
}


nav{
	width: 100%;
	height: 53px;
	display: block;

	background:  #363b3f; /*#00a65a;*/
	position: fixed;
	z-index: 1;
}

/* sidebar Toggle Button */

nav .sidebar-toogle{
	padding: 13px 24px;

}








#fa{
	margin-top: 8px;
}
nav .sidebar-menus{
	padding: 0px 260px;
}
nav .sidebar-menus li{
	display: inline-block;
	
}
nav .sidebar-menus li .dropdown{
	margin-top: -15px;
	padding: 16.4px 10px;
}
nav .sidebar-menus li:hover,click,focus{

}

nav .sidebar-menus .fa-notify{
	position: absolute;
	color: #fff;
	font-size: 13px;
	font-weight:bold;
	background: #f39c12 !important;
	padding: 1px 5px;
	line-height: 1.4;
	border-radius: 40%;
	top: 15px;
	left: 18px;
}

nav .sidebar-menus .fa-msg{
	position: absolute;
	color: #fff;
	font-size: 13px;
	font-weight:bold;
	background: #dd4b39 !important;
	padding: 1px 5px;
	line-height: 1.4;
	border-radius: 40%;
	top: 15px;
	left: 19px;
}

nav .sidebar-menus .fa-chat{
	position: absolute;
	color: #fff;
	font-size: 13px;
	font-weight:bold;
	background: #337ab7 !important;
	padding: 1px 5px;
	line-height: 1.4;
	border-radius: 40%;
	top: 15px;
	left: 19px;
}
i.fa.fa-check-circle {
    color: gainsboro;
}

.imgclass{
	padding: 7px;
}


nav .sidebar-menus a .user-image{
	height: 35px;
	width: 35px;
	border-radius: 50%;
	vertical-align: middle;
}


nav .sidebar-menu-user{
	
	font-weight: bold;
	font-size: 17px;
	color: #fff;
	margin-left: 5px;

}

.dropdown-content {

    padding-bottom: 0rem;
    padding-top: 0rem;
    
}


#dropdown-content-scroll{
	overflow-y: scroll;
	height: 200px;
}

div#dropdown-menu-mn{
	padding: 1px 7px; 

}

.dropdown-item{
	
}


.dropdown-content h2{
	border-bottom:1px solid #dbdbdb;
	font-size: 13px; 
	padding:10px 7px;
	color:#4a4a4a;
}
.dropdown-content h3{
	border-top:1px solid #dbdbdb;
	font-size: 13px; 
	padding:10px 7px;
	color:#4a4a4a;
	text-align: center;
}





div#dropdown-menu-img{
	padding: 0px 7px; 
	margin-top: -6px;
}











/*  Mobile Version  */


@media (max-width:720px){

	nav{
		width: 100%;
	}
	.heads{
		margin-left: 0px;
	}

	.head{
		display: none;
		width: 0px;
	}

	.sub-head{

		display: inline-block;
		font-family: 'Open Sans', sans-serif;
		font-size: 23px;
		color: white;
		text-align: center;
		padding: 7px 0px;

	}

	nav .sidebar-menus{
		padding: 9px 0px;
	}

	nav .sidebar-menus li a{
		margin-top: -10px;
		padding: 17.3px 10px;
	}


	.imgclass{
		padding: 2px;

	}

	.sidebar-menu-user{
		display: none;
	}


	div#dropdown-menu-mn{
		padding: 0px 0px;
		margin-top: -4px;
	}


	div#dropdown-menu-img{
		padding: 5px 7px; 
	}

}

@media (min-width:721px) and (max-width:1200px){

	nav{
		width: 100%;
	}

	nav .sidebar-menus{
		padding: 0px 220px;
	}

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


             .popup-body h1 {
             	margin-top: 10px;
             	font-size: 15px;
             	padding: 10px 10px;
             	background: red;
             	color: white;
             	display: block;
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