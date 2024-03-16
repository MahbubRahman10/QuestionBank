<template>
	<div>
		<div class="modal" v-bind:class="activeviewmodal">
			<div class="modal-background"></div>
			<div class="modal-card">
				<header class="modal-card-head">
					<p class="modal-card-title">User</p>
					<button class="delete" aria-label="close" v-on:click="deview"></button>
				</header>
				<section class="modal-card-body">
					
					<!-- Content ... -->
					<p> <strong>Name : </strong> {{name}} </p><br>
					<p> <strong>Email : </strong> {{email}} </p><br>
					<p> <strong>Status : </strong> {{status}} </p><br>
					<p> <strong>Join : </strong> {{ moment(joinDate).format('LL') }} </p><br>

				</section>
				<footer class="modal-card-foot">
					<button class="button" v-on:click="deview">Close</button>
				</footer>
			</div>
		</div>

		<div class="modal"  v-bind:class="activedeletemodal">
			<div class="modal-background"></div>
			<div class="modal-card">
				<header class="modal-card-head">
					<p class="modal-card-title">Delete Question</p>
					<button class="delete" aria-label="close" v-on:click="dedelete"></button>
				</header>
				<section class="modal-card-body">
					<!-- Content ... -->
					<p>Are you want to delete this question ?</p>
				</section>
				<footer class="modal-card-foot">
					<button type="submit" class="button is-danger" v-on:click="deleteuser">Delete</button>
					<button class="button" v-on:click="dedelete">Cancel</button>
				</footer>
			</div>
		</div>
	</div>
</template>

<script>
	
	export default{
		data(){
			return{
				activeviewmodal: '',
				activedeletemodal: '',

				name : '',
				email : '',
				status : '',
				joinDate : '',

				userId : '',
				index : ''
			}
		},
		methods:{
			
			view:function(user){
				this.activeviewmodal = 'is-active'
				this.name = user.name
				this.email = user.email
				this.status = user.status
				this.joinDate = user.created_at
			},
			deview:function(){
				this.activeviewmodal = ''
			},
			delete:function(index,id){
				this.activedeletemodal = 'is-active'
				this.userId = id
				this.index  = index
			},
			dedelete:function(){
				this.activedeletemodal = ''
			},
			deleteuser() {
				var vm = this
				axios.post('/*/admin/users/deleteuser', { 
					id : vm.userId
				}).then(response => {
					this.activedeletemodal = ''
					this.$emit('delete-user',this.index);
				})
				.catch( error  => {
					console.log(error);
				});
			}
		},
		mounted(){

		}

	}

</script>

<style scoped="">
	

form span{
        padding: 3px 5px;
        color: #d9534f!important;
}
.has-error input{
        border-color: #d9534f!important;
}
.has-error textarea{
        border-color: #d9534f!important;
}

.modal-card-body span{
	margin-left: 10px;
}


</style>