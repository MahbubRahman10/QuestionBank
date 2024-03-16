<template>
	<div>
		<Sidebar ref="toggle"></Sidebar>
		<Header v-on:click-toggle="toggle"></Header>
		<Modal ref="modal" v-on:add-role="afteraddrole" v-on:edit-role="aftereditrole" v-on:delete-role="afterdeleterole"></Modal>
		
		<div class="main-contents">
			<div class="notifications" > 
				<span v-if="notify">Role {{msg}} Successfuly</span>
			</div>
			<div class="columns">
				<div class="column" >
					<div class="content" style="background:;border:1px solid #209cee;">
						<div class="content-heading">
							<div class="content-heading">
								<span class=" is-left"> Admin Role </span>
								<span class="is-right" style="float:right;" v-on:click="add">
									<router-link to="" class="create" ><i class="fa fa-plus" aria-hidden="true"></i>Add New</router-link>
								</span>
							</div>
						</div>
						<div class="info">
							<div class="tablesection">
								<div class="field has-addons">
									<div class="control">
										<input class="input" type="text" placeholder="Find Role" v-model="searchrole" @keyup="searchroles()">
									</div>
								</div>
							</div>
							<table>
								<thead>
									<th>S.N</th>
									<th>Role</th>
									<th>Actions</th>
								</thead>
								<tbody>
									<tr v-if="roles == ''">		
										<td class="nodata" colspan='3' v-if="nodata">No Data Available</td>
									</tr>
									<tr v-else v-for="(role,index) in roles">
										<td>{{index +1}}</td>
										<td>{{ role.name }}</td>
										<td>
											<a class="icon is-size-5 has-text-primary" v-on:click="edit(index)"><i class="fa fa-pencil" aria-hidden="true"></i></a>
											<a class="icon is-size-5 has-text-danger" v-on:click="deletes(index)"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
										</td>
									</tr>
								</tbody>
							</table>
							<infinite-loading  @infinite="getrole" ref="infiniteLoading">
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
import Modal from './Modal/Role.vue'
import InfiniteLoading from 'vue-infinite-loading'
import { vueTopprogress } from 'vue-top-progress'

export default{


	components:{
		'Header' : Header,
		'Sidebar' : Sidebar ,
		'Modal' : Modal,
		InfiniteLoading,
		vueTopprogress 
	},
	head: {
    	title: {
            inner: 'Admin Role'
        },
        // Meta tags
        meta: [
               
        ],
    },
	data(){
		return{
			
			roles : [],
			
			notify : false,	 // notification after CRUD
			msg: '',		 // show messge in notification

			fid : '',		        // save filter id(question)
			searchrole : '',	// Search Category,
			adminrole : '',

			nodata : false
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
		getrole:function($state){
			axios.get('/*/admin/role/getrole',{				
				params: {
					page: this.roles.length / 20 + 1
				},
			})
			.then( response => {  
				if (response.data.role.length != '') {
					this.adminrole = response.data.adminrole
					if(this.adminrole !='Super Admin'){
						this.$router.push('/admin/dashboard')
					}
					this.roles = this.roles.concat(response.data.role);
					$state.loaded();
					console.log(this.roles.length)
					if (this.roles.length == response.data.total) {
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


		// add methods for add new category
		add:function(){
			var child = this.$refs.modal;
			var click = child.add();
		},
		// Show notification after add
		afteraddrole:function(value) {
			this.roles.unshift(value);
			this.notify = true;
			this.msg = 'created'
			var sel = this
			setTimeout(function() { sel.notify = false }, 5000)
		},
		// edit methods for update categories
		edit:function(index){
			var child = this.$refs.modal;
			var click = child.edit(index,this.roles[index]);
		},
		// Show notification after update
		aftereditrole:function(index,value) {
			this.$set(this.roles, index, value)
			this.notify = true
			this.msg = 'updated'
			var sel = this
			setTimeout(function() { sel.notify = false }, 5000)
		},
		// delete methods for delete categories
		deletes:function(index){
			var child = this.$refs.modal;
			var click = child.delete(index,this.roles[index].id);
		},
		// Show notification after delete
		afterdeleterole:function(index) {
			this.$delete(this.roles,index)
			this.notify = true;
			this.msg = 'deleted'
			var sel = this
			setTimeout(function() { sel.notify = false }, 5000)
		},
		// Search categories
		searchroles:function () {
			axios.post('/*/admin/role/getsearchrole',{
				data : this.searchrole
			})
			.then( response => {  
				this.roles = response.data
				if (this.roles == '') {
					this.nodata = true
				}
			})
			.catch( error  => {
				console.log(error);
			});
		}
	},

	mounted(){
		this.$refs.topProgress.start()
		var vm = this            
		setTimeout(() => {
			vm.loading = true,
			vm.$refs.topProgress.done()
		}, 500)
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
	padding:10px 10px;
	color:white;
}

/* Create Question */
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

/* Search in Table */ 
.tablesection{
	padding-bottom: 20px;
}
/* Filter Question by Select*/ 
#questionfilter{
	padding: 0px 10px;
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
td.nodata {
    font-size: 20px;
    font-weight: bold;
    color: #4c4c4c;
    text-align: center;
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