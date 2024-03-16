<template>
	<div>
		<Sidebar ref="toggle"></Sidebar>
		<Header v-on:click-toggle="toggle"></Header>
		<Modal ref="modal" v-on:add-subject="afteraddsubject" v-on:edit-subject="aftereditsubject" v-on:delete-subject="afterdeletesubject"></Modal>
		
		<div class="main-contents">
			<div class="notifications" > 
				<span v-if="notify">Subject {{msg}} Successququfuly</span>
			</div>
			<div class="columns">
				<div class="column" >
					<div class="content" style="background:;border:1px solid #209cee;">
						<div class="content-heading">
							<div class="content-heading">
								<span class=" is-left"> Subject/Topic </span>
								<span class="is-right" style="float:right;" v-on:click="add">
									<router-link to="" class="create" ><i class="fa fa-plus" aria-hidden="true"></i>Add New</router-link>
								</span>
							</div>
						</div>
						<div class="info">
							<div class="tablesection">
								<div class="field has-addons">
									<div class="control">
										<input class="input" type="text" placeholder="Find Subject" v-model="searchsubject" @keyup="searchsubjects()">
									</div>
								</div>
							</div>
							<table>
								<thead>
									<th>S.N</th>
									<th>Subject/Topic Name</th>
									<th>Actions</th>
								</thead>
								<tbody>
									<tr v-if="subjects == ''">		
										<td class="nodata" colspan='3' v-if="nodata">No Data Available</td>
									</tr>
									<tr v-else v-for="(subject,index) in subjects">
										<td>{{index +1}}</td>
										<td>{{ subject.subject_name }}</td>
										<td>
											<a class="icon is-size-5 has-text-primary" v-on:click="edit(index)"><i class="fa fa-pencil" aria-hidden="true"></i></a>
											<a class="icon is-size-5 has-text-danger" v-on:click="deletes(index)"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
										</td>
									</tr>
								</tbody>
							</table>
							<infinite-loading  @infinite="getcategory" ref="infiniteLoading">
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
import Modal from './Modal/Subject.vue'
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
            inner: 'Subject'
        },
        // Meta tags
        meta: [
               
        ],
    },

	data(){
		return{
			nodata : false,
			subjects : [],
			
			notify : false,	 // notification after CRUD
			msg: '',		 // show messge in notification

			fid : '',		        // save filter id(question)
			searchsubject : ''	// Search Category
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

		getcategory:function($state){
			axios.get('/*/admin/custom/getsubject',{				
				params: {
					page: this.subjects.length / 20 + 1
				},
			})
			.then( response => {  
				if (response.data.subject.data.length != '') {
					this.subjects = this.subjects.concat(response.data.subject.data);
					$state.loaded();
					console.log(this.subjects.length)
					if (this.subjects.length == response.data.total ||  this.subjects.length > response.data.total) {
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


		// add methods for add new subject
		add:function(){
			var child = this.$refs.modal;
			var click = child.add();
		},
		// Show notification after add
		afteraddsubject:function(value) {
			this.subjects.unshift(value);
			this.notify = true;
			this.msg = 'created'
			var sel = this
			setTimeout(function() { sel.notify = false }, 5000)
		},
		// edit methods for update subjects
		edit:function(index){
			var child = this.$refs.modal;
			var click = child.edit(index,this.subjects[index]);
		},
		// Show notification after update
		aftereditsubject:function(index,value) {
			this.$set(this.subjects, index, value)
			this.notify = true
			this.msg = 'updated'
			var sel = this
			setTimeout(function() { sel.notify = false }, 5000)
		},
		// delete methods for delete subjects
		deletes:function(index){
			var child = this.$refs.modal;
			var click = child.delete(index,this.subjects[index].id);
		},
		// Show notification after delete
		afterdeletesubject:function(index) {
			this.$delete(this.subjects,index)
			this.notify = true;
			this.msg = 'deleted'
			var sel = this
			setTimeout(function() { sel.notify = false }, 5000)
		},
		// Search subjects
		searchsubjects:function () {
			axios.post('/*/admin/custom/getsearchsubject',{
				data : this.searchsubject
			})
			.then( response => {  
				this.subjects = response.data
				if (this.subjects == '') {
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