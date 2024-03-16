<template>
	<div>
		<Sidebar ref="toggle"></Sidebar>
		<Header v-on:click-toggle="toggle"></Header>
		<Modal ref="modal"  v-on:add-post="afteraddpost" v-on:edit-post="aftereditpost" v-on:delete-post="afterdeletepost"></Modal>
		
		<div class="main-contents" v-if="loading">
			<div class="notifications" > 
				<span v-if="notify">Post {{msg}} Successfuly</span>
			</div>
			<div class="columns">
				<div class="column" >
					<div class="content" style="background:;border:1px solid #209cee;">
						<div class="content-heading">
							<span class=" is-left"> Blog Post </span>
							<span class="is-right" style="float:right;" v-on:click="add">
								<router-link to="" class="create" ><i class="fa fa-plus" aria-hidden="true"></i>Add New Post</router-link>
							</span>
						</div>
						<div class="info">
							<div class="tablesection">
								<div class="field has-addons">
									<div class="control">
										<input class="input" type="text" placeholder="Find Question" v-model="searchposts" @keyup="searchpost()">
									</div>
								</div>
							</div><br>
							<table>
								<thead>
									<th>S.N</th>
									<th>Title</th>
									<th>Actions</th>
								</thead>
								<tbody>
									<tr v-if="posts == ''">		
										<td class="nodata" colspan='3' v-if="nodata">No Data Available</td>
									</tr>
									<tr v-else v-for="(post,index) in posts">
										<td>{{index +1}}</td>
										<td>{{post.title}}</td>
										<td>
											<a class="icon is-size-5 has-text-info" v-on:click="view(index)"><i class="fa fa-eye" aria-hidden="true"></i></a>
											<a class="icon is-size-5 has-text-primary" v-on:click="edit(index)"><i class="fa fa-pencil" aria-hidden="true"></i></a>
											<a class="icon is-size-5 has-text-danger" v-on:click="deletes(index)"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
										</td>
									</tr>
								</tbody>
							</table>
							<infinite-loading  @infinite="getquestions" ref="infiniteLoading">
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

import Sidebar from './../../Sidebar.vue'
import Header from './../../Header.vue'
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
            inner: 'Blog Post'
        },
        // Meta tags
        meta: [
               
        ],
    },
	data(){
		return{
			nodata : false,
			loading : false,
			posts : [],
			searchposts : '',

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

		getquestions:function($state){
			axios.get('/*/admin/blog/getpost',{				
				params: {
					page: this.posts.length / 20 + 1
				},
			})
			.then( response => {  
				if (response.data.post.data.length != '') {
					this.posts = this.posts.concat(response.data.post.data);
					$state.loaded();
					console.log(this.posts.length)
					if (this.posts.length == response.data.total) {
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
		afteraddpost:function(value) {
			this.posts.unshift(value);
			this.notify = true;
			this.msg = 'created'
			var sel = this
			setTimeout(function() { sel.notify = false }, 5000)
		},
		// edit methods for update categories
		edit:function(index){
			var child = this.$refs.modal;
			var click = child.edit(index,this.posts[index]);
		},
		// Show notification after update
		aftereditpost:function(index,value) {
			this.$set(this.posts, index, value)
			this.notify = true
			this.msg = 'updated'
			var sel = this
			setTimeout(function() { sel.notify = false }, 5000)
		},

		view:function(value){
			var child = this.$refs.modal;
			var click = child.view(this.posts[value]);
		},
		deletes:function(value){
			var child = this.$refs.modal;
			var click = child.delete(value,this.posts[value].id);
		},
		// Show notification after delete
		afterdeletepost:function(index) {
			this.$delete(this.posts,index)
			this.notify = true;
			this.msg = 'deleted'
			var sel = this
			setTimeout(function() { sel.notify = false }, 5000)
		},
		// Search questions
		searchpost:function () {
			axios.post('/*/admin/blog/getsearchpost',{
				data : this.searchposts
			})
			.then( response => {  
				this.posts = response.data
				if (this.posts == '') {
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

<style >

.tag .tag-center[data-v-304091c4] {
  padding-top: 18px;
}
.input[data-v-304091c4], .tags[data-v-304091c4]{
	margin-top: -8px;
}
.vue-tags-input[data-v-304091c4]{
	margin-top: 15px;
}

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