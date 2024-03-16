<template>
	<div>
		<Sidebar ref="toggle"></Sidebar>
		<Header v-on:click-toggle="toggle"></Header>
		
		<div class="main-contents" v-if="loading">
			<div class="columns">
				<div class="column" >
					<div class="content" style="background:;border:1px solid #209cee;">
						<div class="content-heading">
							<span class="is-right">
								<router-link :to="{name:'customsubject'}" class="create" >Topic/Subject</router-link>
							</span>
						</div>
						<div class="info">
							<div class="column"  id="content-body">
								<div class="content-body header">
									<div class="columns is-desktop" id="columns-overview">
										<h1 class="column detail" >
											
											<router-link v-bind:to="'/admin/custom/school'">
												<img src="/img/school.jpg">
												 School
											</router-link>

										</h1>
										<h1 class="column detail">
											<router-link v-bind:to="'/admin/custom/madrasah'">
												<img src="/img/madrasha.jpg">
												Madrasah
											</router-link>

										</h1>
										<h1 class="column detail">
											<router-link v-bind:to="'/admin/custom/university'">  
												<img src="/img/university.jpg">
												University
											</router-link>

										</h1>
										<h1 class="column detail">
											<router-link v-bind:to="'/admin/custom/govt'">
											<img src="/img/job.jpg">
											Govt & non Govt Job
											</router-link>
										</h1>
									</div>
								</div>
							</div>
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
import { vueTopprogress } from 'vue-top-progress'



export default{


	components:{
		'Header' : Header,
		'Sidebar' : Sidebar,
		vueTopprogress
	},
	head: {
    	title: {
            inner: 'Custom'
        },
        // Meta tags
        meta: [
               
        ],
    },
	data(){
		return{
			loading : false,
			items: [
				{ q1: 'Foo' }
			]
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
		this.$refs.topProgress.start()
		var vm = this
		setTimeout(() => {
			vm.loading = true,
			vm.$refs.topProgress.done()
		}, 1000)
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


.content-heading{
	background:#209cee;
	padding:10px 10px;
	color:white;
}

img {
    height: 150px;
}

/* Content Bondy */
#content-body{
border-top-color: #dd4b39;
}
.content-body.header{
  background: white;
  border-top: 3px solid red;
  border-top-color: #dd4b39;
  box-shadow: 0 1px 1px rgba(0,0,0,0.1);
}
.columns.is-desktop .column{
  background: #209cee;
  margin: 10px 10px; 
  color: white;
  font-weight: bold;

}

.columns.is-desktop .column a{
  color: white;
  font-weight: bold;
  font-size: 20px;
}


div#columns-overview .column{
  font-size: 20px;
  padding: 0px 10px;
  color: white;
  text-align: center;
  padding-top: 15px;
  padding-bottom: 15px;
  font-family: BlinkMacSystemFont, -apple-system, "Segoe UI", "Roboto", "Oxygen", "Ubuntu", "Cantarell", "Fira Sans", "Droid Sans", "Helvetica Neue", "Helvetica", "Arial", sans-serif;
}
strong {
    color: white;
    font-size: 40px;
    font-weight: 700;
}



.piechart{
	padding-left: 160px;
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

	.piechart{
		padding-left: 0px;
	}

}

</style>