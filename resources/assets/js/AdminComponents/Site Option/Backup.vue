<template>
	<div>
		<Sidebar ref="toggle"></Sidebar>
		<Header v-on:click-toggle="toggle"></Header>
		
		<div class="main-contents" v-if="loading">
			<div class="notifications" > 
				<span v-if="notify"> {{ msg }}Successfuly</span>
			</div>
			<div class="columns">
				<div class="column" >
					<div class="content" style="background:;border:1px solid #209cee;">
						<div class="content-heading">
							<span class=" is-left" style="font-weight:bold;"> Backup </span>
							<span class="is-right" style="margin-left:15px; float:right;" v-on:click="backupdata('database')">
								<router-link to="" class="create" ><i class="fa fa-database" aria-hidden="true"></i>Backup Database</router-link>
							</span>
							<span class="is-right" style="float:right;" v-on:click="backupdata('system')">
								<router-link to="" class="create" ><i class="fa fa-file" aria-hidden="true"></i>Backup System</router-link>
							</span>
						</div>
						<div class="info">
							<div class="tablesection">
								<div class="field has-addons">
									<div class="control">
										<input class="input" type="text" placeholder="Find Backup" v-model="searchbackup" @keyup="searchbackups()">
									</div>
								</div>
							</div><br>
							<table>
								<thead>
									<th>S.N</th>
									<th>Type</th>
									<!-- <th>File</th> -->
									<th>Date</th>
									<th>Actions</th>
								</thead>
								<tbody>
									<tr v-if="backups == ''">		
										<td class="nodata" colspan='4' v-if="nodata">No Data Available</td>
									</tr>
									<tr v-else v-for="(backup,index) in backups">
										<td>{{index +1}}</td>
										<td>{{backup.type}}</td>
										<!-- <td>{{backup.file}}</td> -->
										<td>{{backup.date}}</td>
										<td>
											<a class="icon is-size-5 has-text-info" v-on:click="downloadbackup(index)"><i class="fa fa-download" aria-hidden="true"></i></a>
											<a class="icon is-size-5 has-text-danger" v-on:click="deletes(index)"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
										</td>
									</tr>
								</tbody>
							</table>
							<infinite-loading  @infinite="getbackups" ref="infiniteLoading">
								<span slot="no-more"></span>
							</infinite-loading>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal"  v-bind:class="activedeletemodal">
			<div class="modal-background"></div>
			<div class="modal-card">
				<header class="modal-card-head">
					<p class="modal-card-title">Delete Data</p>
					<button class="delete" aria-label="close" v-on:click="dedelete"></button>
				</header>
				<section class="modal-card-body">
					<!-- Content ... -->
					<p>Are you want to delete this data ?</p>
				</section>
				<footer class="modal-card-foot">
					<button type="submit" class="button is-danger" v-on:click="deletebackup">Delete</button>
					<button class="button" v-on:click="dedelete">Cancel</button>
				</footer>
			</div>
		</div>
		<vue-topprogress ref="topProgress"></vue-topprogress>
	</div>
</template>

<script>

import Sidebar from './../Sidebar.vue'
import Header from './../Header.vue'
import { vueTopprogress } from 'vue-top-progress'
import InfiniteLoading from 'vue-infinite-loading'

export default{


	components:{
		'Header' : Header,
		'Sidebar' : Sidebar ,
		vueTopprogress,
		InfiniteLoading 
	},
	head: {
		title: {
			inner: 'Backup'
		},
		meta: [

		],
	},
	data(){
		return{
			nodata : false,
			activedeletemodal : '',
			loading : false,
			backups : [],
			searchbackup : '',

			notify : false,
			msg : '',
			did : '',
			bindex : ''
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

		getbackups:function($state){
			axios.get('/*/admin/backup/getbackup',{				
				params: {
					page: this.backups.length / 20 + 1
				},
			})
			.then( response => {  
				if (response.data.backup.data.length != '') {
					var adminrole = response.data.adminrole
					if(adminrole !='Super Admin'){
						this.$router.push('/admin/dashboard')
					}
					this.backups = this.backups.concat(response.data.backup.data);
					$state.loaded();
					console.log(this.backups.length)
					if (this.backups.length == response.data.total) {
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


		deletes:function(index){
			this.activedeletemodal = 'is-active'				
			this.did = this.backups[index].id
			this.bindex = index
		},
		dedelete:function(){
			this.activedeletemodal = ''
		},
		downloadbackup:function(index){
			this.did = this.backups[index].id
			window.location.href = '/*/admin/backup/download/'+this.did;	
		},
		deletebackup:function(){
			var vm = this
			axios.post('/*/admin/backup/deletebackup', { 
				id : vm.did
			}).then(response => {
				this.activedeletemodal = ''
				this.$delete(this.backups,this.bindex)
				this.notify = true;
				this.msg = 'Backup data deleted '
				setTimeout(function() { vm.notify = false }, 5000)
			})
			.catch( error  => {
				console.log(error);
			});
		},
		// Search Backup
		searchbackups:function () {
			axios.post('/*/admin/backup/getsearchbackup',{
				data : this.searchbackup
			})
			.then( response => {  
				this.backups = response.data
				if (this.backups == '') {
					this.nodata = true
				}
			})
			.catch( error  => {
				console.log(error);
			});
		},
		backupdata:function(value) {
			axios.get('/*/admin/backup/data/'+value).then(response => {
				
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