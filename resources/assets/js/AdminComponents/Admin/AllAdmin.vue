<template>
	<div>
		<Sidebar ref="toggle"></Sidebar>
		<Header v-on:click-toggle="toggle"></Header>
		<Modal ref="modal" v-on:add-admin="afteraddadmin" v-on:delete-admin="afterdeleteadmin"></Modal>
		
		<div class="main-contents" v-if="loading">
			<div class="notifications" > 
				<span v-if="notify">User {{msg}} Successfuly</span>
			</div>
			<div class="columns">
				<div class="column" >
					<div class="content" style="background:;border:1px solid #209cee;">
						<div class="content-heading">
							<span class=" is-left"> Admin </span>

							<span class="is-right" style="float:right;" v-on:click="add" v-if="role == 'Super Admin'">
								<router-link to="" class="create" ><i class="fa fa-plus" aria-hidden="true"></i>Add New Admin</router-link>
							</span>
						</div>
						<div class="info">
							<table>
								<thead>
									<th>S.N</th>
									<th>Name</th>
									<th>Email</th>
									<th>Role</th>
									<th v-if="role == 'Super Admin'">Actions</th>
								</thead>
								<tbody>
									<tr v-for="(admin,index) in alladmins">
										<td>{{index +1}}</td>
										<td>{{admin.name}}</td>
										<td>{{admin.email}}</td>
										<td>{{admin.role}}</td>
										<td v-if="role == 'Super Admin'">
											<a class="icon is-size-5 has-text-info" v-on:click="view(index)"><i class="fa fa-eye" aria-hidden="true"></i></a>
											<a class="icon is-size-5 has-text-danger" v-on:click="deletes(index)"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
										</td>
									</tr>
								</tbody>
							</table>
							<infinite-loading  @infinite="admins" ref="infiniteLoading">
								<span slot="no-more"></span>
							</infinite-loading>
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
import Modal from './Modal/Modal.vue'
import { vueTopprogress } from 'vue-top-progress'
import InfiniteLoading from 'vue-infinite-loading'


export default{


	components:{
		'Header' : Header,
		'Sidebar' : Sidebar ,
		'Modal' : Modal ,
		vueTopprogress,
		InfiniteLoading
	},
	head: {
    	title: {
            inner: 'All Admin'
        },
        // Meta tags
        meta: [
               
        ],
    },
	data(){
		return{
			nodata : false,
			loading : false,
			alladmins : [],
			role : '',

			notify : false,
			msg : ''
		}
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
		// Get all question
		admins:function($state){
			axios.get('/*/admin/getadmins',{				
				params: {
					page: this.alladmins.length / 20 + 1
				},
			})
			.then( response => {  
				if (response.data.admins.length != '') {
					this.role = response.data.role
					if(this.role !='Super Admin'){
						this.$router.push('/admin/dashboard')
					}
					this.alladmins = this.alladmins.concat(response.data.admins);
					$state.loaded();
					console.log(this.alladmins.length)
					if (this.alladmins.length == response.data.total) {
						$state.complete();
					}
				}
				else{
					this.nodata = true
					$state.complete();
				}
			})
			.catch( error  => {
				console.log(error);
			});
		},



		// add new admin
		add:function(){
			var child = this.$refs.modal;
			var click = child.add();
		},
		// Show notification after add
		afteraddadmin:function(value) {
			this.alladmins.unshift(value);
			this.notify = true;
			this.msg = 'created'
			var sel = this
			setTimeout(function() { sel.notify = false }, 5000)
		},
		view:function(value){
			var child = this.$refs.modal;
			var click = child.view(this.alladmins[value]);
		},
		deletes:function(value){
			var child = this.$refs.modal;
			var click = child.delete(value,this.alladmins[value].id);
		},
		// Show notification after delete
		afterdeleteadmin:function(index) {
			this.$delete(this.alladmins,index)
			this.notify = true;
			this.msg = 'deleted'
			var sel = this
			setTimeout(function() { sel.notify = false }, 5000)
		}
	},

	mounted(){
		this.$refs.topProgress.start()
		var vm = this
		setTimeout(() => {
			vm.loading = true,
			vm.$refs.topProgress.done()
		}, 100)
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

.main-contents{
	margin-top: 0;
	margin-left: 240px;
}


.columns{
	width:100% ;
	padding:10px 10px;
}


.content-heading{
	background:#209cee;
	padding:10px 10px;
	color:white;
}

.create{
	padding: 5px 8px;
	background: white;
	color: black;
	border-radius: 3px;
	font-size:18px;
	font-weight:bold;
	border-color: white;
}

.create i{
	padding: 6px 5px;
	
}



.info{
	padding:10px 10px;
	background: white;
}

table{
	border: 1px solid #ddd
}

table thead th{
	border: 1px solid #ddd
}
table td{
	border: 1px solid #ddd
}
table tr{
	border: 1px solid #ddd
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