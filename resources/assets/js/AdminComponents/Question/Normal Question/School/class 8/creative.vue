<template>
	<div>
		<Sidebar ref="toggle"></Sidebar>
		<Headers v-on:click-toggle="toggle"></Headers>
		<Modal ref="modal" v-on:add-question="afteraddquestion" v-on:edit-question="aftereditquestion" v-on:delete-question="afterdeletequestion"></Modal>
		
		<div class="main-contents" v-if="loading">
			<div class="notifications" > 
				<span v-if="notify">Questions {{msg}} Successfuly</span>
			 </div>
			<div class="columns">
				<div class="column is-one-quarter">
					<nav class="panel" id="panel">
						<p class="panel-heading">
							Question
						</p>
					<!-- 	<div class="panel-block">
							<p class="control has-icons-left">
								<input class="input is-small" type="text" placeholder="search">
								<span class="icon is-small is-left">
									<i class="fa fa-search"></i>
								</span>
							</p>
						</div> -->
						<p class="panel-tabs">
							<router-link to="" class="is-active">Creative</router-link>
							<router-link to="" :to="{name:'class8mcq'}">MCQ</router-link>
						</p>
						<a class="panel-block" v-for="items in subjects" v-on:click="getsubject(items.id)">
							<span class="panel-icon">
								<i class="fa fa-book"></i>
							</span>
							{{ items.subject_name }}
						</a>
					</nav>
				</div>

				<div class="column">
					<div class="content" style="background:;border:1px solid #209cee;">
						<div class="content-heading">
							<span class=" is-left"> {{activeClaSubName}}  ||  </span>
							<span class=" is-left"> {{activesectionno}} অধ্যায় - {{activesectionname}}  </span>
							<span class="is-right" style="float:right;" v-on:click="add">
								<router-link to="" class="create" ><i class="fa fa-plus" aria-hidden="true"></i>Add New</router-link>
							</span>
						</div>
						<div class="info">
							<div class="tablesection">
								<div class="field has-addons">
									<div class="control" id="questionfilter">
										<div class="select is-fullwidth">
											<select  @change="getsectionbyclick"  id="section" >
												<option v-for="(section,index) in sections" v-bind:value="section.id">{{ section.section_no }} - {{ section.section_name }}</option>
											</select>
										</div>
									</div>
									<div class="control" id="questionfilter">
										<!-- <div class="select is-fullwidth">
											<select @change="filterquestion" v-model="filterselected">
												<option>10</option>
												<option>20</option>
												<option>30</option>
											</select>
										</div> -->
									</div>
									<div class="control">
										<input class="input" type="text" placeholder="Find Question" v-model="searchquestions" @keyup="searchquestion()">
									</div>
								</div>
							</div>
							<table>
								<thead>
									<th>S.N</th>
									<th>Name</th>
									<th>Actions</th>
								</thead>
								<tbody>
									<tr v-if="questions == ''">		
										<td class="nodata" colspan='3' v-if="nodata">No Data Available</td>
									</tr>
									<tr v-else v-for="(question,index) in questions">
										<td>{{index +1}}</td>
										<td v-html="highlight(question.question_name)"> </td>
										<td>
											<a class="icon is-size-5 has-text-info" v-on:click="view(index)"><i class="fa fa-eye" aria-hidden="true"></i></a>
											<a class="icon is-size-5 has-text-primary" v-on:click="edit(index)"><i class="fa fa-pencil" aria-hidden="true"></i></a>
											<a class="icon is-size-5 has-text-danger" v-on:click="deletes(index)"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
										</td>
									</tr>
								</tbody>
							</table>
							<infinite-loading  @infinite="getquestion" ref="infiniteLoading">
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

import Sidebar from './../../../../Sidebar.vue'
import Header from './../../../../Header.vue'
import Modal from './../Modal/Creative.vue'
import { vueTopprogress } from 'vue-top-progress'
import InfiniteLoading from 'vue-infinite-loading'

export default{


	components:{
		'Headers' : Header,
		'Sidebar' : Sidebar ,
		'Modal' : Modal  ,
		vueTopprogress,
		InfiniteLoading
	},
	head: {
		title: {
			inner: 'Creative Question'
		},
		meta: [

		],
	},
	data(){
		return{

			loading : false,
			nodata : false,
			
			// Class+Subject 
			activeClaSubId : '',
			activeClaSubName : '',
			selected : '',
			
			// Section
			sid: '',
			activesectionid : '',
			activesectionno : '',
			activesectionname : '',

			subjects : [],   // Subject list
			sections : [],	 // Sections list
			questions :[],	 // Questions list

			notify : false,	 // notification after CRUD
			msg: '',		 // show messge in notification

			fid : '',		        // save filter id(question)
			filterselected : '10',	// Filter select
			searchquestions : ''	// Search Question



		}
	},
	methods:{
		highlight:function(value){
			if (value.includes('img') == true) {
				return 'Data:Image';
			}
			else{
				return value.slice(0,100);
			}
		},
		// Question Drop-down method
		quesdroptown:function(){
			var child = this.$refs.toggle;
			child.fdropmenu();

		},
		// Nav toggle
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
		// get subject of class 6 on click in Subject side
		getsubject:function(value) {
			this.sid = '' 
			this.activeClaSubId = value
			
			var result = $.grep(this.subjects, function(e){ return e.id == value; })
			this.activeClaSubId = result[0].id
			this.activeClaSubName = result[0].subject_name
			
			this.getsection()

		},
		// get section of subject on click in section option
		getsectionbyclick:function() {
			this.sid = $('#section').val()
			// this.getquestion(this.sid)

			var id = this.sid
			var result = $.grep(this.sections, function(e){ return e.id == id; });
			this.activesectionid = result[0].id
			this.activesectionno = result[0].section_no
			this.activesectionname = result[0].section_name 
			this.fid = this.sid
			this.filterselected =  '10';

			this.questions = []
			this.nodata = false
			this.$nextTick(() => {
				this.$refs.infiniteLoading.$emit('$InfiniteLoading:reset');
			});
		},
		// get all subject of clas 6
		getallsubject:function(){
			axios.post('/*/admin/question/getAllsubject', { 
				id : 3
             })
			.then( response => {  
				this.subjects = response.data.subjects,
				this.activeClaSubId = this.subjects[0].id
				this.activeClaSubName = this.subjects[0].subject_name
				this.getsection(this.subjects[0].id)
			})
			.catch( error  => {
				console.log(error);
			});
		},
		
		// get section of subject
		getsection:function(value){
			axios.post('/*/admin/question/getsection', { 
				sid : this.activeClaSubId,
				cid : 3
             }).then( response => { 
             	this.sections = response.data.sections

             	// this.getquestion(this.sections[0].id)
             	this.activesectionid = this.sections[0].section_no
             	this.activesectionno = this.sections[0].section_no
             	this.activesectionname = this.sections[0].section_name   
             	this.fid = this.sections[0].id   

             	$("#section").val(this.sections[0].id);
             	this.filterselected =  '10';

             	this.questions = []
             	this.nodata = false
             	this.$nextTick(() => {
             		this.$refs.infiniteLoading.$emit('$InfiniteLoading:reset');
             	});

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
		// Get all question
		getquestion:function($state){
			axios.get('/*/admin/question/getquestion',{				
				params: {
					clsubid : this.activeClaSubId,
					secid : this.activesectionid,
					page: this.questions.length / 20 + 1
				},
			})
			.then( response => {
			console.log(response.data.question.data)  
				if (response.data.question.data.length != '') {
					this.questions = this.questions.concat(response.data.question.data);
					$state.loaded();
					console.log(this.questions.length)
					if (this.questions.length == response.data.total ||  this.questions.length > response.data.total) {
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
		// add methods for add new questions
		add:function(){
			var child = this.$refs.modal;
			var click = child.add(this.activesectionid,this.activeClaSubName);
		},
		// Show notification after add
		afteraddquestion:function(value) {
			this.questions.unshift(value);
			this.notify = true;
			this.msg = 'created'
			var sel = this
			setTimeout(function() { sel.notify = false }, 5000)
		},
		// view methods for view questions
		view:function(index){
			var child = this.$refs.modal;
			var click = child.view(this.questions[index]);
		},
		// edit methods for update questions
		edit:function(index){
			var child = this.$refs.modal;
			var click = child.edit(index,this.questions[index],this.activesectionid,this.activeClaSubName);
		},
		// Show notification after update
		aftereditquestion:function(index,value) {
			this.$set(this.questions, index, value)
			this.notify = true
			this.msg = 'updated'
			var sel = this
			setTimeout(function() { sel.notify = false }, 5000)
		},
		// delete methods for delete questions
		deletes:function(index){
			var child = this.$refs.modal;
			var click = child.delete(index,this.questions[index].id);
		},
		// Show notification after delete
		afterdeletequestion:function(index) {
			this.$delete(this.questions,index)
			this.notify = true;
			this.msg = 'deleted'
			var sel = this
			setTimeout(function() { sel.notify = false }, 5000)
		},
		// Filter Question
		filterquestion:function () {
			axios.post('/*/admin/question/getfilterquestion',{
				ClsSubid : this.activeClaSubId,
				secid : this.fid,
				data : this.filterselected
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
		},
		// Search Question
		searchquestion:function () {
			axios.post('/*/admin/question/getsearchquestion',{
				ClsSubid : this.activeClaSubId,
				secid : this.fid,
				data : this.searchquestions
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
		this.$refs.topProgress.start(),
		this.quesdroptown(),
		this.getallsubject()
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