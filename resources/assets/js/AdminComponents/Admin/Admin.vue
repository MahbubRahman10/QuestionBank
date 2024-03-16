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
								<router-link :to="{name:'showadmin'}" class="create" > View All Admin(s)</router-link>
								<router-link :to="{name:'showrole'}" class="create" > View Rules</router-link>
							</span>
						</div>
						<div class="info">
							<div class="column"  id="content-body">
								<div class="content-body header">
									<div class="columns is-desktop" id="columns-overview">
										<div class="column" >
											<span class=""> 
												<STRONG>{{  admin }}</STRONG><br>  
												Admin
											</span>
										</div>
										<div class="column">
											<span class=""> 
												<STRONG> {{  role }} </STRONG> <br>  
												Role
											</span>
										</div>
									</div>
									<div class="columns is-desktop piechart" id="columns-overview">
										<pie-chart :chart-data="piedatacollection" :width="700"
										:height="250" id="pie" ></pie-chart>            
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
import Line from './../Charts/Line.vue';
import Pie from './../Charts/Pie.vue';


export default{


	components:{
		'Header' : Header,
		'Sidebar' : Sidebar,
		vueTopprogress,
		'pie-chart':Pie
	},
	head: {
    	title: {
            inner: 'Admin'
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
			],
			piedata: [],
			pielabel: [],
			piedatacollection: null,
			adminrole : ''
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
		piechart(){
			axios.get('/*/admin/chart/admin')
			.then( response => { 
				this.adminrole = response.data.adminrole
				if(this.adminrole !='Super Admin'){
					this.$router.push('/admin/dashboard')
				} 
				this.admin = response.data.admin
				this.role = response.data.role
				this.creative = response.data.creative

				this.piedata = response.data.data
				this.pielabel = response.data.label

				this.piedatacollection = {
					labels: this.pielabel,
					datasets: [
					{
						backgroundColor: [
						"#FF6384",
						"#36A2EB"
						],
						hoverBackgroundColor: [
						"#FF6384",
						"#36A2EB"
						],
						label: 'Admin',
						data: this.piedata
					}	
					]
				}
			})
			.catch( error  => {
				console.log(error);
			}); 
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
			this.piechart()
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
}

div#columns-overview .column{
  font-size: 20px;
  padding: 0px 10px;
  color: white;
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