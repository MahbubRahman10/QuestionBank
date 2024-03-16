<template>
	<div>
		<Sidebar ref="toggle"></Sidebar>
		<Header v-on:click-toggle="toggle"></Header>
		<Modal ref="modal" v-on:delete-question="afterdeletequestion"></Modal>
		
		<div class="main-contents" v-if="loading">
			<div class="notifications" > 
				<span v-if="notify">Question {{msg}} Successfuly</span>
			</div>
			<div class="columns">
				<div class="column" >
					<div class="content" style="background:;border:1px solid #209cee;">
						<div class="content-heading">
							<span class=" is-left"> Forum Questions </span>
						</div>
						<div class="info">
							<div class="tablesection">
								<div class="field has-addons">
									<div class="control">
										<input class="input" type="text" placeholder="Find Question" v-model="searchquestion" @keyup="searchquestions()">
									</div>
								</div>
							</div><br>
							<table>
								<thead>
									<th>S.N</th>
									<th>Question</th>
									<th>Actions</th>
								</thead>
								<tbody>
									<tr v-if="questions == ''">		
										<td class="nodata" colspan='3' v-if="nodata">No Data Available</td>
									</tr>
									<tr v-else v-for="(question,index) in questions">
										<td>{{index +1}}</td>
										<td>{{question.title}}</td>
										<td>
											<a class="icon is-size-5 has-text-info" v-on:click="view(index)"><i class="fa fa-eye" aria-hidden="true"></i></a>
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
            inner: 'Forum Question'
        },
        // Meta tags
        meta: [
               
        ],
    },

	data(){
		return{
			nodata : false,
			loading : false,
			questions : [],
			searchquestion : '',

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
			axios.get('/*/admin/forum/getquestion',{				
				params: {
					page: this.questions.length / 20 + 1
				},
			})
			.then( response => {  
				if (response.data.question.data.length != '') {
					this.questions = this.questions.concat(response.data.question.data);
					$state.loaded();
					console.log(this.questions.length)
					if (this.questions.length == response.data.total) {
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
			var click = child.view(this.questions[value]);
		},
		deletes:function(value){
			var child = this.$refs.modal;
			var click = child.delete(value,this.questions[value].id);
		},
		// Show notification after delete
		afterdeletequestion:function(index) {
			this.$delete(this.questions,index)
			this.notify = true;
			this.msg = 'deleted'
			var sel = this
			setTimeout(function() { sel.notify = false }, 5000)
		},
		// Search questions
		searchquestions:function () {
			axios.post('/*/admin/forum/getsearchquestion',{
				data : this.searchquestion
			})
			.then( response => {  
				this.questions = response.data
				if (this.questions == '') {
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