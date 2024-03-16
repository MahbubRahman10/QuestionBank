<template>
	<div>
		<Sidebar ref="toggle"></Sidebar>
		<Header v-on:click-toggle="toggle"></Header>
		
		<div class="main-contents" v-if="loading">
			<div class="notifications" > 
				<span v-if="notify">{{msg}} Successfuly</span>
			</div>
			<div class="columns">
				<div class="column is-one-quarter">
					<nav class="panel" id="panel">
						<p class="panel-heading">
							Site Option 
						</p>
						<router-link to="" class="panel-block is-active">
							<span class="panel-icon">
								<i class="fa fa-book"></i>
							</span>
							Title
						</router-link>
					<!-- 	<router-link :to="{name : 'admintheme'}" class="panel-block">
							<span class="panel-icon">
								<i class="fa fa-book"></i>
							</span>
							Dashboard Theme
						</router-link> -->
						<router-link :to="{name : 'sitesocial'}" class="panel-block">
							<span class="panel-icon">
								<i class="fa fa-book"></i>
							</span>
							Social
						</router-link>
						<router-link :to="{name : 'sitefooter'}" class="panel-block">
							<span class="panel-icon">
								<i class="fa fa-book"></i>
							</span>
							Footer
						</router-link>
						<router-link :to="{name : 'sitebackup'}" class="panel-block">
							<span class="panel-icon">
								<i class="fa fa-book"></i>
							</span>
							Backup
						</router-link>
					</nav>
				</div>
				<div class="column"  id="content">
					<div class="content-body">
						<table>
							<tr>
								<td>
									<label>Site Name :  </label>
								</td>
								<td class="from-input">
									<div :class="{ 'has-error': errors.has('title') }">
										<input v-validate="'required'" type="text" v-model="title" name="title" class="input">
										<span v-show="errors.has('title')">{{ errors.first('title') }}</span>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<label>Site Title :  </label>
								</td>
								<td class="from-input">
										<input type="text" v-model="subtitle" name="subtitle" class="input">
								</td>
							</tr>
							<tr>
								<td>
									<label>Site Logo :  </label>
								</td>
								<br>
								<div :class="{ 'has-error': errors.has('logo') }">
										<input type="file" name="logo" class="input" @change="onFileChange" accept="file/*">
									<span v-show="errors.has('logo')">{{ errors.first('logo') }}</span>         
								</div>
							</tr>
						</table>
						<div class="field">
							<p class="control">
								<button class="button is-success" v-on:click="validateBeforeSubmit">
									Update
								</button>
							</p>
						</div>
					</div>
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
		'Sidebar' : Sidebar  ,
		vueTopprogress
	},

	data(){
		return{
			loading : false,
			sitedata : [],
			title : '',
			subtitle: '',

			notify : false,	 // notification after Update
			msg: '',		 // show messge in notification
		}
	},
	head: {
		title: {
			inner: 'Title'
		},
		meta: [

		],
	},
	methods:{
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
		 validateBeforeSubmit() {
		 	this.$validator.validateAll().then((result) => {
		 		if (result) {
		 			axios.post('/*/admin/site/title', { 
		 				title : this.title,
		 				subtitle : this.subtitle
		 			}).then( response => { 
		 				this.notify = true
		 				this.msg = 'updated'
		 				var sel = this
		 				setTimeout(function() { sel.notify = false }, 5000)
		 			})
		 			.catch( error  => {
		 				console.log(error);
		 			});
		 		}
		 	});
		},
		getdata:function() {
			axios.get('/*/admin/site/getdata')
			.then( response => {  
				var adminrole = response.data.adminrole
				if(adminrole !='Super Admin'){
					this.$router.push('/admin/dashboard')
				}
				this.sitedata = response.data.site
				this.title = this.sitedata.title
				this.subtitle = this.sitedata.subtitle
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
		onFileChange(e) {
			alert("ok")
		}
	},

	mounted(){
		this.$refs.topProgress.start()
		this.getdata()
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

/* Main Content */
.main-contents{
	margin-top: 0;
	margin-left: 240px;
}

/* Column : -  */
.columns{
	width:100% ;
	padding:10px 10px;
}

/* Panel */
#panel{
  background: white;
}

/* Content */
#content{
border-top-color: #dd4b39;
}
/* Content Body */
.content-body{	
  background: white;
  padding: 30px 20px;
  border-top: 3px solid red;
  border-top-color: #dd4b39;
  box-shadow: 0 1px 1px rgba(0,0,0,0.1);
}


/* Table */
td {
  padding-top:20px;
  padding-bottom:20px;
  padding-right:20px;   
}
.button.is-success {
    margin: 20px 120px;
}




/* validation */
.content-body span{
        padding: 3px 5px;
        color: #d9534f!important;
}
.has-error input{
        border-color: #d9534f!important;
}
.has-error textarea{
        border-color: #d9534f!important;
}

.modal-card-body span{
	margin-left: 10px;
}



/*  Mobile Version  */

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

</style>