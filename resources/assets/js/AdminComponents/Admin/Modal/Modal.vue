<template>
	<div>
		<div class="modal" v-bind:class="activeaddmodal">
			<div class="modal-background"></div>
			<div class="modal-card">
				<header class="modal-card-head">
					<p class="modal-card-title">Add Admin</p>
					<button class="delete" aria-label="close" v-on:click="deadd"></button>
				</header>
				<section class="modal-card-body">
					<!-- Content ... -->
					<form @submit.prevent="">

						<div :class="{ 'has-error': errors.has('name') }">
							<label class="control-label" for="institution">Name : </label><br>
							<input v-validate="'required'" type="text" v-model="name" name="name" class="input">
							<span v-show="errors.has('name')">{{ errors.first('name') }}</span>         
						</div>
						<br>

						<div :class="{ 'has-error': errors.has('email') }">
							<label class="control-label" for="institution">Email : </label><br>
							<input v-validate="'required'" type="text" v-model="email" name="email" class="input">
							<span v-show="errors.has('email')">{{ errors.first('email') }}</span>         
						</div>
						<br>
						<div class="control" id="questionfilter">
							<label class="control-label" for="institution">Role : </label><br>
							<div class="select is-fullwidth">
								<select v-model="selectrule">
									<option v-for="(role,index) in roles" v-if = "role.name !== 'Administration'"> {{ role.name }} </option>
								</select>
							</div>
						</div><br>

						<div :class="{ 'has-error': errors.has('password') }">
							<label class="control-label" for="password">Password : </label><br>
							<input v-validate="'required'" type="text" v-model="password" name="password" class="input">
							<span v-show="errors.has('password')">{{ errors.first('password') }}</span>         
						</div>
						<br>

						<!-- <div :class="{ 'has-error': errors.has('image') }">
							<label class="control-label" for="image">role : </label><br>
							<input v-validate="'required'" type="file" name="image" class="input" @change="onFileChange" accept="file/*">
							<span v-show="errors.has('image')">{{ errors.first('image') }}</span>         
						</div>
						<br>

						<div :class="{ 'has-error': errors.has('role') }">
							<label class="control-label" for="year">Role : </label><br>
							<div class="control is-expanded">
								<div class="select is-fullwidth">
									<select name="country" v-model="role">
										<option value="Argentina">Argentina</option>
										<option value="Bolivia">Bolivia</option>
										<option value="Brazil">Brazil</option>
										<option value="Chile">Chile</option>
										<option value="Colombia">Colombia</option>
										<option value="Ecuador">Ecuador</option>
										<option value="Guyana">Guyana</option>
										<option value="Paraguay">Paraguay</option>
										<option value="Peru">Peru</option>
										<option value="Suriname">Suriname</option>
										<option value="Uruguay">Uruguay</option>
										<option value="Venezuela">Venezuela</option>
									</select>
								</div>
							</div>
							<span v-show="errors.has('role')">{{ errors.first('role') }}</span>         
						</div>
						<br>
					   -->
					</form>
				</section>
				<footer class="modal-card-foot">					
					<button type="submit" class="button is-success" v-on:click="validateBeforeSubmit">Submit</button>
					<button class="button" v-on:click="deadd">Cancel</button>
				</footer>
			</div>
		</div>

		<div class="modal" v-bind:class="activeviewmodal">
			<div class="modal-background"></div>
			<div class="modal-card">
				<header class="modal-card-head">
					<p class="modal-card-title">Admin</p>
					<button class="delete" aria-label="close" v-on:click="deview"></button>
				</header>
				<section class="modal-card-body">
					<!-- Content ... -->
					<p> <strong>Name : </strong> {{name}} </p><br>
					<p> <strong>Email : </strong> {{email}} </p><br>
					<!-- <p> <strong>Status : </strong> {{status}} </p><br> -->
					<p> <strong>Join : </strong> {{ moment(joinDate).format('LL') }} </p><br>
					

				</section>
				<footer class="modal-card-foot">
					<button class="button" v-on:click="deview">Close</button>
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

						<div :class="{ 'has-error': errors.has('name') }">
							<label class="control-label" for="institution">Name : </label><br>
							<input v-validate="'required'" type="text" v-model="name" name="name" class="input">
							<span v-show="errors.has('name')">{{ errors.first('name') }}</span>         
						</div>
						<br>

						<div :class="{ 'has-error': errors.has('email') }">
							<label class="control-label" for="institution">Email : </label><br>
							<input v-validate="'required'" type="text" v-model="email" name="email" class="input">
							<span v-show="errors.has('email')">{{ errors.first('email') }}</span>         
						</div>
						<br>

						<div :class="{ 'has-error': errors.has('password') }">
							<label class="control-label" for="password">Password : </label><br>
							<input v-validate="'required'" type="text" v-model="password" name="password" class="input">
							<span v-show="errors.has('password')">{{ errors.first('password') }}</span>         
						</div>
						<br>

						<!-- <div :class="{ 'has-error': errors.has('image') }">
							<label class="control-label" for="image">role : </label><br>
							<input v-validate="'required'" type="file" name="image" class="input" @change="onFileChange" accept="file/*">
							<span v-show="errors.has('image')">{{ errors.first('image') }}</span>         
						</div>
						<br>

						<div :class="{ 'has-error': errors.has('role') }">
							<label class="control-label" for="year">Role : </label><br>
							<div class="control is-expanded">
								<div class="select is-fullwidth">
									<select name="country" v-model="role">
										<option value="Argentina">Argentina</option>
										<option value="Bolivia">Bolivia</option>
										<option value="Brazil">Brazil</option>
										<option value="Chile">Chile</option>
										<option value="Colombia">Colombia</option>
										<option value="Ecuador">Ecuador</option>
										<option value="Guyana">Guyana</option>
										<option value="Paraguay">Paraguay</option>
										<option value="Peru">Peru</option>
										<option value="Suriname">Suriname</option>
										<option value="Uruguay">Uruguay</option>
										<option value="Venezuela">Venezuela</option>
									</select>
								</div>
							</div>
							<span v-show="errors.has('role')">{{ errors.first('role') }}</span>         
						</div>
						<br>
					   -->
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
					<p class="modal-card-title">Delete Question</p>
					<button class="delete" aria-label="close" v-on:click="dedelete"></button>
				</header>
				<section class="modal-card-body">
					<!-- Content ... -->
					<p>Are you want to delete this admin ?</p>
				</section>
				<footer class="modal-card-foot">
					<button type="submit" class="button is-danger" v-on:click="deleteadmin">Delete</button>
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

				roles : [],
				name : '',
				email : '',
				password : '',
				status : '',
				joinDate : '',
				
				selectrule: '',

				adminId : '',
				index : '',

				newAdmin : []

			}
		},
		methods:{
			getrole:function() {
				axios.get('/*/admin/role/getrole')
				.then( response => {  
					this.roles = response.data.role
				})
				.catch( error  => {
					console.log(error);
				});	
			},
			add:function(){
				this.getrole()
				this.activeaddmodal = 'is-active'
			},
			deadd:function(){
				this.activeaddmodal = ''
			},
			validateBeforeSubmit() {
				var vm  = this
				this.$validator.validateAll().then((result) => {
					if (result) {
						axios.post('/*/admin/admin/addadmin', { 
							name : vm.name,
							email : vm.email,
							role : vm.selectrule,
							password : vm.password
						}).then(response => {
							this.activeaddmodal = ''
							this.newAdmin = response.data
							this.$emit('add-admin',this.newAdmin);
						})
						.catch( error  => {
							console.log(error);
						});
					}
				});
			},
			view:function(admin){
				this.activeviewmodal = 'is-active'

				this.name = admin.name
				this.email = admin.email
				this.status = admin.status
				this.joinDate = admin.created_at
			},
			deview:function(){
				this.activeviewmodal = ''
			},
			edit:function(items){
				this.name = items[0].q1;
				this.activeeditmodal = 'is-active'
			},
			deedit:function(){
				this.activeeditmodal = ''
			},
			editvalidateBeforeSubmit() {
				this.$validator.validateAll().then((result) => {
					if (result) {
						alert("ok")		}
					});
			},
			delete:function(index,id){
				this.activedeletemodal = 'is-active'
				this.userId = id
				this.index  = index
			},
			dedelete:function(){
				this.activedeletemodal = ''
			},
			deleteadmin() {
				var vm = this
				axios.post('/*/admin/admin/deleteadmin', { 
					id : vm.userId
				}).then(response => {
					this.activedeletemodal = ''
					this.$emit('delete-admin',this.index);
				})
				.catch( error  => {
					console.log(error);
				});
			},
			onFileChange(e) {
				alert("ok")
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