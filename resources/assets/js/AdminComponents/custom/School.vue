<template>
	<div>
		<Sidebar ref="toggle"></Sidebar>
		<Header v-on:click-toggle="toggle"></Header>
		<Modal ref="modal" v-on:add-subject="afteraddsubject" v-on:add-section="afteradddsection"  v-on:edit-section="aftereditsection" v-on:delete-subject="afterdeletesubject" v-on:delete-section="afterdeletesection"></Modal>
		
		<div class="main-contents" v-if="loading">
			<div class="notifications" > 
				<span v-if="notify">{{msg}} Successfuly</span>
			</div>
			<div class="columns">
				<div class="column is-one-quarter">
					<nav class="panel" id="panel">
						<p class="panel-heading">
							{{ category }}
						</p>
						<!-- <div class="panel-block">
							<p class="control has-icons-left">
								<input class="input is-small" type="text" placeholder="search">
								<span class="icon is-small is-left">
									<i class="fa fa-search"></i>
								</span>
							</p>
						</div> -->
						<p class="panel-tabs">
							<router-link to="" class="is-active"> {{ classname }} শ্রেণি </router-link>
						</p>
						<a class="panel-block" v-for="items in classes" v-on:click="getclass(items.id,items.class)">
							<span class="panel-icon">
								<i class="fa fa-book"></i>
							</span>
							{{items.class}} শ্রেণি
						</a>
					</nav>
				</div>

				<div class="column" >
					<div class="content" style="background:;border:1px solid #209cee;">
						<div class="content-heading">
							<span class=" is-left">  								
						      <a to="" class="button is-primary is-inverted is-outlined" v-on:click="showsubject"></i>Subject</a>
						      <a to="" class="button is-primary is-inverted is-outlined" v-on:click="showsection"></i>Section</a>

							</span>

							<span class="is-right" style="float:right;" v-on:click="addsubject">
								<router-link to="" class="create" ><i class="fa fa-plus" aria-hidden="true"></i>Add Subject</router-link>
							</span>
						</div>
						<div class="info" v-show="showsubjects">
							<div class="tablesection">
								<div class="field has-addons">
									<div class="control" id="questionfilter">
										<!-- <div class="select is-fullwidth">
											<select  @change="getsubjectbyclick"  id="subject">
												<option v-for="(subject,index) in subjects" v-bind:value="subject.id">{{ subject.subject_name }}</option>
											</select>
										</div> -->
									</div>
									<div class="control">
										<input class="input" type="text" placeholder="Find Subject" v-model="searchsubjects" @keyup="searchsubject()">
									</div>
								</div>
							</div>
							<table>
								<thead>
									<th>S.N</th>
									<th>Subject</th>
									<th>Actions</th>
								</thead>
								<tbody>
									<tr v-if="subjects == ''">		
										<td class="nodata" colspan='3' v-if="nodata">No Data Available</td>
									</tr>
									<tr v-else v-for="(subject,index) in subjects">
										<td>{{index +1}}</td>
										<td> {{ subject.subject_name }} </td>
										<td>
											<a class="icon is-size-5 has-text-danger" v-on:click="deletes(index)"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
										</td>
									</tr>
								</tbody>
							</table>
							<infinite-loading  @infinite="getsection" ref="infiniteLoading">
								<span slot="no-more"></span>
							</infinite-loading>
						</div>
						<div class="info" v-show="showsections">
							<div class="tablesection">
								<div class="field has-addons">
									<div class="control" id="questionfilter">
										<div class="select is-fullwidth">
											<select  @change="getsubjectbyclick" v-model="activesubject" id="subject">
												<option v-for="(subject,index) in subjects" v-bind:value="subject.id">{{ subject.subject_name }}</option>
											</select>
										</div>
									</div>
									<div class="control">
										<input class="input" type="text" placeholder="Find Section" v-model="searchsections" @keyup="searchsection()">
									</div>
								</div>
							</div>
							<a class="button is-info is-outlined" style="margin-left:10px;" v-on:click="addsection"><i class="fa fa-plus" aria-hidden="true"></i> Add Section</a>
							<br><br>
							<table>
								<thead>
									<th>S.N</th>
									<th>Section</th>
									<th>Actions</th>
								</thead>
								<tbody>
									<tr v-if="sections == ''">		
										<td class="nodata" colspan='3' v-if="nodata">No Data Available</td>
									</tr>
									<tr v-else v-for="(section,index) in sections">
										<td>{{index +1}}</td>
										<td> {{ section.section_name }} </td>
										<td>
											<a class="icon is-size-5 has-text-primary" v-on:click="edit(index)"><i class="fa fa-pencil" aria-hidden="true"></i></a>
											<a class="icon is-size-5 has-text-danger" v-on:click="deletesection(index)"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
										</td>
									</tr>
								</tbody>
							</table>
							<infinite-loading  @infinite="getsection" ref="infiniteLoading">
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
			inner: 'Category'
		},
		meta: [

		],
	},
	data(){
		return{

			showsubjects : true,
			showsections : false,

			loading : false,
			nodata : false,

			category : this.$route.params.category, // Take University name from route
            
            classes : [], // Get All Exam Subject
            classname : '',
            activeclass : '', // Currently Active Subject

            subjects : [],
            activesubject: '',
            activesubjectname : '',

            sections : [],

            questions : [], // Get all question

            notify : false,	 // notification after CRUD
			msg: '',		 // show messge in notification

			fid : '',		        // save filter id(question)
			filterselected : '20',	// Filter select
			searchsubjects : '',	// Search Question
			searchsections : '',	// Search Question
			
			items: [
				{ q1: 'Foo' }
			]
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
		showsubject:function() {
			this.showsections = true
			this.showsubjects = true
		},
		showsection:function() {
			this.showsubjects = false
			this.showsections = true
			this.nodata = false
			this.$nextTick(() => {
				this.$refs.infiniteLoading.$emit('$InfiniteLoading:reset');
			});
		},

		getclass:function(value,name) {
			this.activeclass = value
			this.classname = name
			
			this.getallsubject()

		},

		// get subject of JSC on click in Subject side
		getsubject:function(value,name) {
			this.activeSubjectId = value
			this.subject = name
			
			this.questions = []
			this.nodata = false
			// this.$nextTick(() => {
			// 	this.$refs.infiniteLoading.$emit('$InfiniteLoading:reset');
			// });
		},

		// get all subject JSC
		getallclass:function(){
			var vm = this
			axios.post('/*/admin/custom/getallclass', { 
				category : vm.category
			})
			.then( response => { 
				this.classes = response.data,
				this.activeclass = this.classes[0].id
				this.classname = this.classes[0].class
				this.getallsubject()
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
		getallsubject:function(){
			axios.post('/*/admin/question/getAllsubject', { 
				id : this.activeclass
             })
			.then( response => {  
				this.subjects = response.data.subjects,
				this.activesubject = this.subjects[0].id
				this.activesubjectname = this.subjects[0].subject_name
				// this.nodata = false
				// this.$nextTick(() => {
				// 	this.$refs.infiniteLoading.$emit('$InfiniteLoading:reset');
				// });
			})
			.catch( error  => {
				console.log(error);
			});
		},

		// get subject  click in Subject side
		getsubjectbyclick:function() {
			axios.get('/*/admin/custom/getsection',{				
				params: {
					sid : this.activesubject,
					cid : this.activeclass,
					page: this.questions.length / 20 + 1
				},
			})
			.then( response => {  
				if (response.data.section.data.length != '') {
					this.sections = response.data.section.data;	
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
		// Get all question
		getsection:function($state){
			
			axios.get('/*/admin/custom/getsection',{				
				params: {
					sid : this.activesubject,
					cid : this.activeclass,
					page: this.questions.length / 20 + 1
				},
			})
			.then( response => {  
				if (response.data.section.data.length != '') {
					this.sections = this.sections.concat(response.data.section.data);
					$state.loaded();
					if (this.sections.length == response.data.total ||  this.sections.length > response.data.total) {
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
		addsubject:function(){
			var child = this.$refs.modal;
			var click = child.add(this.classname);
		},
		addsection:function(){
			var child = this.$refs.modal;
			var click = child.addsection(this.activesubject);
		},
		// Show notification after add
		afteraddsubject:function(value) {
			this.subjects.unshift(value);
			this.notify = true;
			this.msg = 'Subject created'
			var sel = this
			setTimeout(function() { sel.notify = false }, 5000)
		},
		afteradddsection:function(value) {
			this.sections.unshift(value);
			this.notify = true;
			this.msg = 'Section created'
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
			var click = child.editsection(index,this.sections[index]);
		},
		// Show notification after update
		aftereditsection:function(index,value) {
			this.$set(this.sections, index, value)
			this.notify = true
			this.msg = 'Section Updated'
			var sel = this
			setTimeout(function() { sel.notify = false }, 5000)
		},
		// delete methods for delete questions
		deletes:function(index){
			var child = this.$refs.modal;
			var click = child.delete(index,this.subjects[index].subject_id,this.classname);
		},
		deletesection:function(index){
			var child = this.$refs.modal;
			var click = child.deletes(index,this.sections[index].id);
		},
		// Show notification after delete
		afterdeletesubject:function(index) {
			this.$delete(this.subjects,index)
			this.notify = true;
			this.msg = 'Subject deleted'
			var sel = this
			setTimeout(function() { sel.notify = false }, 5000)
		},

		// Show notification after delete
		afterdeletesection:function(index) {
			this.$delete(this.sections,index)
			this.notify = true;
			this.msg = 'Subject deleted'
			var sel = this
			setTimeout(function() { sel.notify = false }, 5000)
		},

		// Filter Question
		filterquestion:function () {
			axios.post('/*/admin/university/getfilterquestion',{
				clasubid : this.activeSubjectId,
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
		searchsubject:function () {
			axios.get('/*/admin/custom/getcustomsearchsubject',{
				params:{
					category : this.classname,
					data : this.searchsubjects
				}
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
		},
		// Search Question
		searchsection:function () {
			axios.get('/*/admin/custom/getsearchsection',{
				params:{
					id : this.activesubject,
					data : this.searchsections
				}
			})
			.then( response => {  
				this.sections = response.data
				if (this.sections == '') {
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
		this.getallclass()
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