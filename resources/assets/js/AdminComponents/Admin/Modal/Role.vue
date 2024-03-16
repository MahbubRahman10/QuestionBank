<template>
	<div>
		<div class="modal" v-bind:class="activeaddmodal">
			<div class="modal-background"></div>
			<div class="modal-card">
				<header class="modal-card-head">
					<p class="modal-card-title">Add Role</p>
					<button class="delete" aria-label="close" v-on:click="deadd"></button>
				</header>
				<section class="modal-card-body">
					<!-- Content ... -->
					<form @submit.prevent="">
						<div :class="{ 'has-error': errors.has('role') }">
							<label class="control-label" for="role">Role : </label><br>
							<input v-validate="'required'" v-model="role" type="text" name="role" class="input">
							<span v-show="errors.has('role')">{{ errors.first('role') }}</span>         
						</div>
						<br>
					</form>
				</section>
				<footer class="modal-card-foot">					
					<button type="submit" class="button is-success" v-on:click="validateBeforeSubmit">Submit</button>
					<button class="button" v-on:click="deadd">Cancel</button>
				</footer>
			</div>
		</div>

		<div class="modal"  v-bind:class="activeeditmodal">
			<div class="modal-background"></div>
			<div class="modal-card">
				<header class="modal-card-head">
					<p class="modal-card-title">Edit Question</p>
					<button class="delete" aria-label="close" v-on:click="deedit"></button>
				</header>
				<section class="modal-card-body">
					<!-- Content ... -->
					<form @submit.prevent="">
						<div :class="{ 'has-error': errors.has('role') }">
							<label class="control-label" for="option1">Role : </label><br>
							<input v-validate="'required'" v-model="role" type="text" name="role" class="input">
							<span v-show="errors.has('role')">{{ errors.first('role') }}</span>         
						</div>
						<br>
					</form>
				</section>
				<footer class="modal-card-foot">
					<button class="button is-success" v-on:click="editvalidateBeforeSubmit">Save changes</button>
					<button class="button" v-on:click="deedit">Cancel</button>
				</footer>
			</div>
		</div>
		<div class="modal"  v-bind:class="activedeletemodal">
			<div class="modal-background"></div>
			<div class="modal-card">
				<header class="modal-card-head">
					<p class="modal-card-title">Delete Role</p>
					<button class="delete" aria-label="close" v-on:click="dedelete"></button>
				</header>
				<section class="modal-card-body">
					<!-- Content ... -->
					<p>Are you want to delete this role ?</p>
				</section>
				<footer class="modal-card-foot">
					<button type="submit" class="button is-danger" v-on:click="deleterole">Delete</button>
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

				activeaddmodal: '',
				activeviewmodal: '',
				activeeditmodal: '',
				activedeletemodal: '',
				
				role: '',

				deleteitem : [],
				newrole : [],
				updaterole : [],

				cindex : '',
				id : ''
			}
		},
		methods:{
			add:function(){
				this.activeaddmodal = 'is-active'
			},
			deadd:function(){
				this.activeaddmodal = ''
			},
			validateBeforeSubmit() {
				var vm = this
				this.$validator.validateAll().then((result) => {
					if (result) {
						axios.post('/*/admin/role/addrole', { 
							role : vm.role
						}).then(response => {  
							vm.activeaddmodal = ''
							this.newrole = response.data
							this.$emit('add-role',this.newrole);
						})
						.catch( error  => {
							console.log(error);
						});
					}
				});
			},

			edit:function(index,items){
				this.activeeditmodal = 'is-active'
				this.cindex = index
				this.id = items.id
				this.role = items.name
			},
			deedit:function(){
				this.activeeditmodal = ''
			},
			editvalidateBeforeSubmit() {
				var vm = this
				this.$validator.validateAll().then((result) => {
					if (result) {
						axios.post('/*/admin/role/editrole', { 
							id : vm.id ,
							role : vm.role
						}).then(response => {  
							vm.activeeditmodal = ''
							this.updaterole = response.data
							this.$emit('edit-role',this.cindex,this.updaterole);
						})
						.catch( error  => {
							console.log(error);
						});
					}
				});
			},
			delete:function(index,id){
				this.activedeletemodal = 'is-active'
				this.id = id
				this.cindex = index
			},
			dedelete:function(){
				this.activedeletemodal = ''
			},
			deleterole() {
				var vm = this
				axios.post('/*/admin/role/deleterole', { 
					id : vm.id
				}).then(response => {
					this.activedeletemodal = ''
					this.$emit('delete-role',this.cindex);
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




</style>