<template>
	<div class="sidebar" v-bind:style="{background: activeColor}">
		<div class="head">
			<h1 style="font-weight:bold; font-style:italic;">Question<span>Bank</span></h1>
		</div>
		<div class="sidebarnav">
			<div class="user">
				<div class=" user-image is-pulled-left" v-show="loading">
					<img v-if="adminimage == null" src="http://localhost:8000/img/profile-default.jpg" >
					<img v-if="adminimage != null" :src="adminimage" >				
				</div>
				<div class="user-info">			
					<h2 class="user-name">
						{{ admins.name }}
					</h2>
					<h2 class="user-rule">
						{{ admins.role }}
					</h2>
				</div>
			</div>
			<ul id="nav" v-show="loading">
				<li><router-link to="/admin/dashboard" ><i class="fa fa-tachometer"></i>   Dashboard </router-link></li>
				<li><router-link :to="{name :'mail'}"><i class="fa fa-envelope" ></i>   Mailbox </router-link></li>
				<li><router-link :to="{name :'taskcalendar'}"><i class="fa fa-calendar-check-o"></i>  Event </router-link></li>
				<li v-on:click="question"><a><i class="fa fa-question-circle" ></i>   Question <i class="fa fa-angle-right pull-right" id="fa_question"></i></a>
					<ul id="question" v-show="qmenu">
						<li><router-link :to="{name :'question'}" ><i class="fa fa-angle-right"></i>   Normal Question </router-link></li>
						<li><router-link :to="{name :'boardquestion'}"><i class="fa fa-angle-right"></i>   Board Question </router-link></li>
						<li><router-link :to="{name :'testquestion'}" ><i class="fa fa-angle-right"></i>   University Question </router-link></li>
						<li><router-link :to="{name :'bcsquestion'}" ><i class="fa fa-angle-right"></i>   BCS Question </router-link></li>
						<li><router-link :to="{name :'otherquestion'}" ><i class="fa fa-angle-right"></i>   Recruitment Question </router-link></li>
						<li><router-link :to="{name :'archivequestion'}" ><i class="fa fa-angle-right"></i>   Question Archive </router-link></li>
					</ul>
				</li>
				<!-- <li v-on:click="exam" ><a><i class="fa fa-check-square"></i>   Exam <i class="fa fa-angle-right pull-right" id="fa_exam"></i></a>
					<ul id="exam" v-show="emenu">
						<li><router-link :to="{name :'schoolexam'}" ><i class="fa fa-check"></i>   Normal Exam </router-link></li>
						<li><router-link :to="{name :'boardexam'}"><i class="fa fa-check"></i>   Board Exam </router-link></li>
						<li><router-link :to="{name :'bcsexam'}" ><i class="fa fa-check"></i>   BCS Exam </router-link></li>
						<li><router-link :to="{name :'otherexam'}" ><i class="fa fa-check"></i>   Others Exam </router-link></li>
					</ul>
				</li> -->
				<li><router-link :to="{name:'custom'}"><i class="fa fa-thermometer"></i> Custom</router-link></li>
				<li><router-link :to="{name:'user'}"><i class="fa fa-users"></i> Users</router-link></li>
				<li v-if="admins.role == 'Super Admin'"><router-link :to="{name:'admin'}"><i class="fa fa-user-circle"></i> Admins</router-link></li>
				<li><router-link :to="{name:'forum'}"><i class="fa fa-users"></i> Forum</router-link></li>
				<li><router-link :to="{name:'blog'}"><i class="fa fa-rss-square"></i> Blog</router-link></li>
				<li v-if="admins.role == 'Super Admin'"><router-link :to="{name:'sitetitle'}"><i class="fa fa-cog"></i> Site Option</router-link></li>
				<li><a href="/admin/logout"><i class="fa fa-sign-out"></i>   Logout</a></li>
			</ul>
		</div>
	</div>
</template>

<script >
	
	export default{
		data(){
			return{
				activeColor:'',
				loading : false,
				qmenu:false,
				emenu:false,

				admins : [],
    			adminimage : ''
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
			question:function(){
				if ($('#fa_exam').hasClass('fa fa-angle-right pull-right fa-rotate-90') == true){
					this.exam();
				} 
				$("#question").slideToggle("slow");
				$('#question').click(function(e) {
		        	e.stopPropagation();
		    	});
				$('#fa_question').toggleClass('fa-rotate-90',"20"); 
			},
			exam:function(){
				if ($('#fa_question').hasClass('fa fa-angle-right pull-right fa-rotate-90') == true){
					this.question();
				} 
				$("#exam").slideToggle("slow");
				$('#exam').click(function(e) {
					e.stopPropagation();
				});
				$('#fa_exam').toggleClass('fa-rotate-90',"20"); 
			},
			fdropmenu:function(){
				this.qmenu = true,
				$('#fa_question').toggleClass('fa-rotate-90',"20");
			},
			edropmenu:function(){
				this.emenu = true,
				$('#fa_exam').toggleClass('fa-rotate-90',"20");
			},
			toggles:function(){
				if( $('.sidebar').is(':visible') ) {
					$('.sidebar').animate({ 'width': '0px' }, '1200', function(){
						$('.sidebar').hide();
					});
					return 'close';
				}
				else {
					$('.sidebar').show();
					$('.sidebar').animate({ 'width': '230px' }, '1200');
					return 'open';
				}
			},
			changetheme:function(color){

				if (theme == 'theme 1') {

				}
				else if(theme == 'theme 2'){

				}
				else{
					alert("ok")
				}

				// localStorage.setItem('color',color);
				// this.activeColor = color

			}

		},
		mounted(){
			this.getadmin()
			// var color = localStorage.getItem('color');
			// this.activeColor = color
		}
	}

</script>

<style scoped>



	
.sidebar{
	background: #222d32;
	width: 230px;
	height: 100%;
	float: left;
	position: fixed; 
}

.sidebarnav{
	overflow-y: auto;
	width: 230px;
	height: 95%;
}

/* Head Title */
.head{
	display: block;
	background: #1e282c; /* #098c4e; */
	width: 230px;
	height: 53px;
	float: left;
	/*margin-bottom: 10px*/;

}

.head h1{
	font-family: 'Open Sans', sans-serif;
	font-size: 23px;
	color: white;
	text-align: center;
	padding: 10px 0px;
}


/*Scroll*/
/* width */
::-webkit-scrollbar {
    width: 10px;
}

/* Track */
::-webkit-scrollbar-track {
	background: #222d32;
}
 
/* Handle */
::-webkit-scrollbar-thumb {
    background: #888; 
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
    background: #555; 
}

/*
.sub-head{
	display: none;
	font-family: 'Open Sans', sans-serif;
	font-size: 23px;
	color: white;
	text-align: center;
	padding: 7px 0px;

}
*/



/*  Admin information  */

.user{
	width: 230px;
	padding: 10px 15px;
}


.user-info {
	padding: 0px 50px;
}
.user-name {
	font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif;
	font-size: 12px;
	font-weight:600;
	color: #fff;

}

.user-rule{
	color: #b8c7ce;
	font-style: italic;
}

.user-image {
	
	padding: 4px 0px;
}
.user-image img{
	height: 35px;
	width: 35px;
	vertical-align: middle;
}






/* Side bar */

.sidebar ul{
	list-style: none;	
	display: block;
	width: 230px;
}

ul#nav li a{
	width: 230px;
	color: #ccc;
	display: block;
	font-size: 1.1em;
	-webkit-transition:0.2s;
	-moz-transition:0.2s;
	-o-transition:0.2s;
	transition:0.2s;		
	padding: 13px 13px;

}
ul#nav li a i{

	padding: 0px 7px;

}
ul#nav li a:hover{

	background-color: #1e282c;
	color: #fff;
	text-decoration: none;

}
.router-link-active{
	background-color: #1e282c;
	color: #fff;
	border-left: 5px solid #ffb000 /* #00a65a */;
}
#mailbox{
	display: none;
	background: #2c3b41;
}

#question{
	background: #2c3b41;
}

#exam{
	background: #2c3b41;
}





/*  Mobile Version  */


@media (max-width:720px){

	.sidebar{
		display: none;
		background: #222d32;
		width: 0px;
		margin-top: 52px;
		height: 100%;
		position: fixed;
	}
	.head{
		display: none;
	}

	.sidebarnav{
		overflow-y: auto;
		width: 230px;
		height: 100%;
	}


}




</style>