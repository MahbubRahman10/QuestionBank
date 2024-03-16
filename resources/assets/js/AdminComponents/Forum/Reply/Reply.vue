<template>
	<div>
		<Sidebar ref="toggle"></Sidebar>
		<Header v-on:click-toggle="toggle"></Header>
		<Modal ref="modal" v-on:delete-reply="afterdeletereply"></Modal>
		
		<div class="main-contents" v-if="loading">
			<div class="notifications" > 
				<span v-if="notify">Reply {{msg}} Successfuly</span>
			</div>
			<div class="columns">
				<div class="column" >
					<div class="content" style="background:;border:1px solid #209cee;">
						<div class="content-heading">
							<span class=" is-left"> Forum Question Replies </span>
						</div>
						<div class="info">
							<div class="tablesection">
								<div class="field has-addons">
									<div class="control">
										<input class="input" type="text" placeholder="Find Reply" v-model="searchreply" @keyup="searchreplies()">
									</div>
								</div>
							</div><br>
							<table>
								<thead>
									<th>S.N</th>
									<th>Name</th>
									<th>Reply</th>
									<th>Actions</th>
								</thead>
								<tbody>
									<tr v-if="replies == ''">		
										<td class="nodata" colspan='4' v-if="nodata">No Data Available</td>
									</tr>
									<tr v-else v-for="(reply,index) in replies">
										<td>{{index +1}}</td>
										<td>{{reply.name}}</td>
										<td v-html="highlight(reply.description,truncate)"></td>
										<td>
											<a class="icon is-size-5 has-text-info" v-on:click="view(index)"><i class="fa fa-eye" aria-hidden="true"></i></a>
											<a class="icon is-size-5 has-text-danger" v-on:click="deletes(index)"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
										</td>
									</tr>
								</tbody>
							</table>
							<infinite-loading  @infinite="getreplies" ref="infiniteLoading">
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
            inner: 'Forum Reply'
        },
        // Meta tags
        meta: [
               
        ],
    },

	data(){
		return{
			nodata : false,
			loading : false,
			replies : [],
			searchreply : '',

			notify : false,
			msg : ''
		}
	},
	methods:{
		highlight:function(value){
			return value.slice(0,100);
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
		
		getreplies:function($state){
			axios.get('/*/admin/forum/getreply',{				
				params: {
					page: this.replies.length / 20 + 1
				},
			})
			.then( response => {  
				if (response.data.reply.data.length != '') {
					this.replies = this.replies.concat(response.data.reply.data);
					$state.loaded();
					console.log(this.replies.length)
					if (this.replies.length == response.data.total) {
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

		view:function(value){
			var child = this.$refs.modal;
			var click = child.view(this.replies[value]);
		},
		deletes:function(value){
			var child = this.$refs.modal;
			var click = child.delete(value,this.replies[value].id);
		},
		// Show notification after delete
		afterdeletereply:function(index) {
			this.$delete(this.replies,index)
			this.notify = true;
			this.msg = 'deleted'
			var sel = this
			setTimeout(function() { sel.notify = false }, 5000)
		},
		// Search replies
		searchreplies:function () {
			axios.post('/*/admin/forum/getsearchreply',{
				data : this.searchreply
			})
			.then( response => {  
				this.replies = response.data
				if (this.replies == '') {
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