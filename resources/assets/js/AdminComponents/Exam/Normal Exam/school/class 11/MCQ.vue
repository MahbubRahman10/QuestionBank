<template>
	<div>
		<Sidebar ref="toggle"></Sidebar>
		<Header v-on:click-toggle="toggle"></Header>
		<Modal ref="modal" v-on:add-question="afteraddquestion" v-on:edit-question="aftereditquestion" v-on:delete-question="afterdeletequestion"></Modal>
		
		<div class="main-contents" v-if="loading">
			<div class="notifications" > 
				<span v-if="notify">Questions {{msg}} Successfuly</span>
			</div>
			<div class="columns">
				<div class="column is-one-quarter">
					<nav class="panel" id="panel">
						<p class="panel-heading">
							Exam
						</p>
						<div class="panel-block">
							<p class="control has-icons-left">
								<input class="input is-small" type="text" placeholder="search">
								<span class="icon is-small is-left">
									<i class="fa fa-search"></i>
								</span>
							</p>
						</div>
						<p class="panel-tabs">
							<router-link to=""  class="is-active">MCQ Question</router-link>
						</p>
						<a class="panel-block" v-for="items in subjects" v-on:click="getsubject(items.id)">
							<span class="panel-icon">
								<i class="fa fa-book"></i>
							</span>
							{{ items.subject_name }}
						</a>
					</nav>
				</div>

				<div class="column" >
					<div class="content" style="background:;border:1px solid #209cee;">
						<div class="content-heading">
							<div class="content-heading">
								<span class=" is-left"> {{activeSubjectName}}  ||  </span>
								<span class=" is-left"> {{activesectionno}} অধ্যায় - {{activesectionname}}  </span>
								<span class="is-right" style="float:right;" v-on:click="add">
									<router-link to="" class="create" ><i class="fa fa-plus" aria-hidden="true"></i>Add New</router-link>
								</span>
							</div>
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
										<div class="select is-fullwidth">
											<select @change="filterquestion" v-model="filterselected">
												<option>10</option>
												<option>20</option>
												<option>30</option>
											</select>
										</div>
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
									<tr v-for="(question,index) in questions">
										<td>{{index +1}}</td>
										<td>{{ question.question_name }}</td>
										<td>
											<a class="icon is-size-5 has-text-info" v-on:click="view(index)"><i class="fa fa-eye" aria-hidden="true"></i></a>
											<a class="icon is-size-5 has-text-primary" v-on:click="edit(index)"><i class="fa fa-pencil" aria-hidden="true"></i></a>
											<a class="icon is-size-5 has-text-danger" v-on:click="deletes(index)"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
										</td>
									</tr>
								</tbody>
							</table>
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
import Modal from './../Modal/MCQ.vue'
import { vueTopprogress } from 'vue-top-progress'

export default{


	components:{
		'Header' : Header,
		'Sidebar' : Sidebar ,
		'Modal' : Modal ,
		vueTopprogress
	},

	data(){
		return{
			
			loading : false,

			// Class+Subject 
			activeSubjectId : '',
			activeSubjectName : '',

			// Section
			sid: '',
			activesectionid : '',
			activesectionno : '',
			activesectionname: '',

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
		examdroptown:function(){
			var child = this.$refs.toggle;
			child.edropmenu();

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
		
		// get subject of class 6 on click in Subject side
		getsubject:function(value) {
			this.sid = '' 
			this.activeSubjectId= value
			
			var result = $.grep(this.subjects, function(e){ return e.id == value; })
			this.activeSubjectId = result[0].id
			this.activeSubjectName = result[0].subject_name
			
			this.getsection()

		},
		// get section of subject on click in section option
		getsectionbyclick:function() {
			this.sid = $('#section').val()
			this.getquestion(this.sid)

			var id = this.sid
			var result = $.grep(this.sections, function(e){ return e.id == id; });
			this.activesectionid = result[0].id
			this.activesectionno = result[0].section_no
			this.activesectionname = result[0].section_name 
			this.fid = this.sid

			this.filterselected =  '10';
		},
		// get all subject of clas 6
		getallsubject:function(){
			axios.post('/*/admin/exam/normal/getAllsubject', { 
				id : 5
             })
			.then( response => {  
				this.subjects = response.data,

				this.activeSubjectId = this.subjects[0].id
				this.activeSubjectName = this.subjects[0].subject_name
				this.getsection(this.subjects[0].id)

			})
			.catch( error  => {
				console.log(error);
			});
		},

		// get section of subject
		getsection:function(value){
			axios.post('/*/admin/exam/normal/getsection', { 
				sid : this.activeSubjectId,
				cid : 5
			}).then( response => { 
				this.sections = response.data.sections
				this.getquestion(this.sections[0].id)
				this.activesectionid = this.sections[0].id
				this.activesectionno = this.sections[0].section_no
				this.activesectionname = this.sections[0].section_name   
				this.fid = this.sections[0].id   

				$("#section").val(this.sections[0].id);
				this.filterselected =  '10';

			})
			.catch( error  => {
				console.log(error);
			});
		},
		// Get all question
		getquestion:function(value){

			axios.post('/*/admin/exam/normal/getquestion',{
				ClsSubid : this.activeSubjectId,
				secid : value,
			})
			.then( response => {  
				this.questions = response.data
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


		// add methods for add new questions
		add:function(){
			var child = this.$refs.modal;
			var click = child.add(this.activesectionid);
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
			var click = child.edit(index,this.questions[index],this.activesectionid);
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
			axios.post('/*/admin/exam/normal/filterquestion',{
				ClsSubid : this.activeSubjectId,
				secid : this.fid,
				data : this.filterselected
			})
			.then( response => {  
				this.questions = response.data
			})
			.catch( error  => {
				console.log(error);
			});
		},
		// Search Question
		searchquestion:function () {
			axios.post('/*/admin/exam/normal/searchquestion',{
				ClsSubid : this.activeSubjectId,
				secid : this.fid,
				data : this.searchquestions
			})
			.then( response => {  
				this.questions = response.data
			})
			.catch( error  => {
				console.log(error);
			});
		}
	},

	mounted(){
		this.$refs.topProgress.start(),
		this.examdroptown()
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