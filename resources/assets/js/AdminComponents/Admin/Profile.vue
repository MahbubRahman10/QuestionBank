<template>
	<div>
		<Sidebar ref="toggle"></Sidebar>
		<Header v-on:click-toggle="toggle"></Header>
		
		<div class="main-contents" v-if="loading">
			<div class="notifications" > 
				<span v-if="notify"> {{ msg }} </span>
			</div>
			<div class="columns">
				<div class="column" >
					<div class="content" style="background:;border:1px solid #209cee;">
						<div class="content-heading">
							<div class="content-heading">
								<span class=" is-left"> Admin Basic Info </span>
							</div>
						</div>
						<div class="info">
							<div class="columns">
								<div class="column is-one-third">
									<div class="image">
										<img v-if="adminimage == null" src="http://localhost:8000/img/profile-default.jpg" alt="paris" id="uimg">
										<img v-if="adminimage != null" :src="adminimage" alt="paris" id="uimg">
										<div class="adminimage">
											<label class="custom-file-upload button is-success is-outlined">
												<input type="file" name="file" @change="onFileChange" accept="file/*" class="">
												<i class="fa fa-cloud-upload"></i> Upload Image
											</label>
										</div>
										<button v-if="changeimage" id="change" v-on:click="adminimagechange()">Change Image</button>
									</div>
								</div>
								<div class="column" id="details">
									<p v-if="adminname"><strong>Name : </strong> {{ name }} <a> <i v-on:click="nameinput()" class="fa fa-edit"></i> </a></p>
									<p v-if="changename"><strong>Name : </strong><input type="text" name="name" v-model="name"> <button type="button" v-on:click="adminnamechange">Submit</button> <button type="button" v-on:click="cancelname">Cancel</button> </p>
									<p><strong>Email : </strong>  {{ admin.email }} </p>
									<p><strong>Role : </strong> {{ admin.role }} </p>
									<br>
									<a v-on:click="passwordchange" class="button is-primary is-outlined">Change Password</a>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="modal" v-bind:class="activeaddmodal">
				<div class="modal-background"></div>
				<div class="modal-card">
					<header class="modal-card-head">
						<p class="modal-card-title">Password Change</p>
						<button class="delete" aria-label="close" v-on:click="deadd"></button>
					</header>
					<section class="modal-card-body">
						<!-- Content ... -->
						<form @submit.prevent="">
							<div :class="{ 'has-error': errors.has('oldpassword') }">
								<label class="control-label" for="option1">Old Password : </label><br>
								<input v-validate="'required'" v-model="oldpassword" type="password" name="oldpassword" class="input">
								<span v-show="errors.has('oldpassword')">{{ errors.first('oldpassword') }}</span>         
							</div>
							<br>
							<div :class="{ 'has-error': errors.has('password') }">
								<label class="control-label" for="option1">New Password : </label><br>
								<input v-validate="'required'" v-model="password" type="password" name="password" class="input">
								<span v-show="errors.has('password')">{{ errors.first('password') }}</span>         
							</div>
							<br>
							<div :class="{ 'has-error': errors.has('repassword') }">
								<label class="control-label" for="option1">Confirm Password : </label><br>
								<input v-validate="'required'" v-model="repassword" type="password" name="repassword" class="input">
								<span v-show="errors.has('repassword')">{{ errors.first('repassword') }}</span>         
							</div>
							<br>
						</form>
					</section>
					<footer class="modal-card-foot">					
						<button type="submit" class="button is-success" v-on:click="validateBeforeSubmit">Submit</button>
						<button class="button" v-on:click="deadd">Cancel</button>
					</footer>
				</div>
			</div>

		</div>
		<vue-topprogress ref="topProgress"></vue-topprogress>
	</div>
</template>

<script>

import Sidebar from './../Sidebar.vue'
import Header from './../Header.vue'
import { vueTopprogress } from 'vue-top-progress'

export default{


	components:{
		'Header' : Header,
		'Sidebar' : Sidebar,
		vueTopprogress 
	},
	

	data(){
		return{
			loading : false,
			activeaddmodal: '',

			oldpassword : '',
			password : '',
			repassword : '',

			changeimage : false,
			changename : false,

			adminname : true,

			image : '',
			adminimage : '',
			name : '',
			admin : [],

			notify : false,	 // notification after CRUD
			msg: '',		 // show messge in notification

		}
	},
	head: {
    	title: {
            inner: 'Admin Profile'
        },
        // Meta tags
        meta: [
               
        ],
    },
	methods:{
		onFileChange(e) {
			var fileReader = new FileReader()
			fileReader.readAsDataURL(e.target.files[0])
			var vm = this;
			fileReader.onload = (e) => {
				vm.image = e.target.result; 
				vm.changeimage = true
				vm.adminimage = e.target.result
			} 

		},
		toggle:function(){
			var child = this.$refs.toggle;
			var click = child.toggles();
			if(click  == 'open') {
				$('.main-contents').animate({ 'margin-left': '240px' }, '1500');
			}
			else {
				$('.main-contents').animate({ 'margin-left': '10px' }, '1500');
			}
		},
		getadmin:function() {
			axios.get('/*/admin/getadmin')
			.then( response => {  
				this.admin = response.data
				this.name = this.admin.name
				if (this.admin.image != null) {
					var link = "http://localhost:8000/upload/admins/"
					var data = this.admin.image
					this.adminimage = link+data
				}else{
					this.adminimage = null
				}
				var vm = this
				setTimeout(() => {
					vm.loading = true,
					vm.$refs.topProgress.done()
				}, 100)
			})
			.catch( error  => {
				console.log(error);
			});	
		},
		nameinput(){
			this.adminname = false
			this.changename = true
		},
		cancelname(){
			this.adminname = true
			this.changename = false
		},
		adminnamechange(){
			if (this.name != '') {
				axios.post('/*/admin/changename', { 
					name : this.name,
				}).then(response => {  
					this.name = response.data
					this.adminname = true
					this.changename = false
				})
				.catch( error  => {
					console.log(error);
				});
			}
		},
		passwordchange(){
			this.activeaddmodal = 'is-active'
		},
		deadd:function(){
			this.activeaddmodal = ''
		},
		validateBeforeSubmit() {
			var vm = this
			this.$validator.validateAll().then((result) => {
				if (result) {
					axios.post('/*/admin/changepassword', { 
						oldpassword : vm.oldpassword,
						password : vm.password,
						password_confirmation : vm.repassword
					}).then(response => {  
						if(response.data == 400){
							alert("Password must be of minimum 6 characters & should match the confirm password"),
							vm.oldpassword = '',
							vm.password = '',
							vm.repassword = ''
						}
						else if(response.data == 401){
							alert("Please enter the correct password"),
							vm.oldpassword = '',
							vm.password = '',
							vm.repassword = ''
						}
						else if(response.data == 200){
							vm.oldpassword = '',
							vm.password = '',
							vm.repassword = '',
							vm.activeaddmodal = '',
							vm.msg = "Password Changed Successfully",
							vm.notify = true
						}

						
					})
					.catch( error  => {
						console.log(error);
					});
				}
			});
		},
		adminimagechange(){			
			axios.post('/*/admin/changeimage', { 
				image : this.image 
			}).then(response => {  
				this.adminimage = response.data
				this.changeimage = false
			})
			.catch( error  => {
				console.log(error);
			});
		}
	},
	mounted(){
		this.$refs.topProgress.start(),
		this.getadmin()
	}
}

</script>

<style scoped>


/* notifications after CRUD */
.notifications{
	text-align: center;
	margin-top: 10px;
	margin-left:10%;
}
.notifications span{
	background: #5f5f5f;
	color: #ffffff;
	font-size: 17px;
    border: 1px solid #cccccc;
    font-family: Verdana,sans-serif;
	padding: 5px 14px 10px 10px;
	overflow: visible;
	border-radius: 6px;
}

/* Main content */
.main-contents{
	margin-top: 0;
	margin-left: 240px;
}

/* Columns  */
.columns{
	width:100% ;
	padding:10px 10px;
}

#panel{
	background: white;
}

.content-heading{
	background:#209cee;
	padding:5px 10px;
	color:white;
}


.info{
	padding:10px 10px;
	background: white;
}

#uimg{
	border: 1px solid #eee; 
	padding: 10px 10px;
    border-radius: 2px;
    height: 250px;
    width: 280px;
}
.adminimage{
	padding:20px 0px;
}
#change{
	color: #fff;
	background-color: #0275d8;
    border-color: #0275d8;
	font-weight: 400;
	font-size: 15px;
	margin-left: 10px;
	text-align: center;
	padding-top: 7px;
	padding-bottom:  6px;
	padding-right: 10px;
	padding-left: 10px;
	border-radius: .25rem
}

#details{
	padding: 20px 0px;
}
#details p{
	font-size: 20px;
}
i.fa.fa-edit{
	color: black;
	padding-left: 10px;
	padding-top:5px;
}

/*  Mobile Version  */

input[type="file"] {
    display: none;
}
.custom-file-upload {
    border: 1px solid #ccc;
    display: inline-block;
    padding: 6px 12px;
    cursor: pointer;
}

@media (max-width:720px){

	.main-contents{
		width: 100%;
		margin-left: 10px;
	}

	.columns{
		width:100% ;
		padding:30px 20px;
	}


}

form span{
        padding: 3px 5px;
        color: #d9534f!important;
}
.has-error input{
        border-color: #d9534f!important;
}
.has-error textarea{
        border-color: #d9534f!important;
}


</style>