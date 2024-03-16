<template>
	<div>
		<Header v-on:click-toggle="toggle"></Header>
		<Sidebar ref="toggle"></Sidebar>
		<Modal ref="modal"></Modal>
		
		<div class="main-contents">
			<div class="columns">
				<div class="column is-one-quarter">
					<nav class="panel" id="panel">
						<p class="panel-heading">
							Board Question
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
							<router-link to="" class="is-active">JSC</router-link>
							<router-link to="" :to="{name:'dinajpurboardsscquestion'}">SSC</router-link>
							<router-link to="" :to="{name:'dinajpurboardhscquestion'}">HSC</router-link>
						</p>
						<router-link to="" class="panel-block is-active">
							<span class="panel-icon">
								<i class="fa fa-book"></i>
							</span>
							Bangla
						</router-link>
						<router-link to="" class="panel-block is-active">
							<span class="panel-icon">
								<i class="fa fa-book"></i>
							</span>
							Ananda Path
						</router-link>
						<router-link to="" class="panel-block">
							<span class="panel-icon">
								<i class="fa fa-book"></i>
							</span>
							Mathematics
						</router-link>
						<router-link to="" class="panel-block">
							<span class="panel-icon">
								<i class="fa fa-book"></i>
							</span>
							Bangladesh And Bisho
						</router-link>
						<router-link to="" class="panel-block">
							<span class="panel-icon">
								<i class="fa fa-book"></i>
							</span>
							Science
						</router-link>
						<router-link to="" class="panel-block">
							<span class="panel-icon">
								<i class="fa fa-book"></i>
							</span>
							Home Science	
						</router-link>
						<router-link to="" class="panel-block">
							<span class="panel-icon">
								<i class="fa fa-book"></i>
							</span>
							Islam and moral Education
						</router-link>
						<router-link to="" class="panel-block">
							<span class="panel-icon">
								<i class="fa fa-book"></i>
							</span>
							Hindu Religion and moral Education
						</router-link>
						<router-link to="" class="panel-block">
							<span class="panel-icon">
								<i class="fa fa-book"></i>
							</span>
							Christian Religion and moral Education
						</router-link>
						<router-link to="" class="panel-block">
							<span class="panel-icon">
								<i class="fa fa-book"></i>
							</span>
							Buddhist religion and moral educationn
						</router-link>
						<router-link to="" class="panel-block">
							<span class="panel-icon">
								<i class="fa fa-book"></i>
							</span>
							Phycical Education and helth
						</router-link>
					</nav>
				</div>

				<div class="column" >
					<div class="content" style="background:;border:1px solid #209cee;">
						<div class="content-heading">
							<span class=" is-left"> Javascript </span>

							<span class="is-right" style="float:right;" v-on:click="add">
								<router-link to="" class="create" ><i class="fa fa-plus" aria-hidden="true"></i>Add New</router-link>
							</span>
						</div>
						<div class="info">
							<table>
								<thead>
									<th>S.N</th>
									<th>Name</th>
									<th>Email</th>
									<th>Actions</th>
								</thead>
								<tbody>
									<tr>
										<td>1</td>
										<td>A</td>
										<td>BB</td>
										<td>
											<a class="icon is-size-5 has-text-info" v-on:click="view"><i class="fa fa-eye" aria-hidden="true"></i></a>
											<a class="icon is-size-5 has-text-primary" v-on:click="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
											<a class="icon is-size-5 has-text-danger" v-on:click="deletes"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>

import Sidebar from './../../../../../Sidebar.vue'
import Header from './../../../../../Header.vue'
import Modal from './../../Modal/Creative.vue'

export default{


	components:{
		'Header' : Header,
		'Sidebar' : Sidebar ,
		'Modal' : Modal 
	},

	data(){
		return{
			items: [
				{ q1: 'Foo' }
			]
		}
	},
	methods:{
		quesdroptown:function(){
			var child = this.$refs.toggle;
			child.fdropmenu();

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

		add:function(){
			var child = this.$refs.modal;
			var click = child.add();
		},
		view:function(){
			var child = this.$refs.modal;
			var click = child.view();
		},
		edit:function(){
			var child = this.$refs.modal;
			var click = child.edit(this.items);
		},
		deletes:function(){
			var child = this.$refs.modal;
			var click = child.delete();
		}
	},

	mounted(){
		this.quesdroptown()
	}
}

</script>

<style scoped>

.main-contents{
	margin-top: 0;
	margin-left: 240px;
}


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