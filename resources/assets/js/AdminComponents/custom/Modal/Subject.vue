<template>
	<div>
		<div class="modal" v-bind:class="activeaddmodal">
			<div class="modal-background"></div>
			<div class="modal-card">
				<header class="modal-card-head">
					<p class="modal-card-title">Add Subject</p>
					<button class="delete" aria-label="close" v-on:click="deadd"></button>
				</header>
				<section class="modal-card-body">
					<!-- Content ... -->
					<form @submit.prevent="">
						<div :class="{ 'has-error': errors.has('subject') }">
							<label class="control-label" for="option1">Subject : </label><br>
							<input v-validate="'required'" v-model="subject" type="text" name="subject" class="input">
							<span v-show="errors.has('subject')">{{ errors.first('subject') }}</span>         
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
					<p class="modal-card-title">Edit Subject</p>
					<button class="delete" aria-label="close" v-on:click="deedit"></button>
				</header>
				<section class="modal-card-body">
					<!-- Content ... -->
					<form @submit.prevent="">
						<div :class="{ 'has-error': errors.has('subject') }">
							<label class="control-label" for="option1">Subject : </label><br>
							<input v-validate="'required'" v-model="subject" type="text" name="subject" class="input">
							<span v-show="errors.has('subject')">{{ errors.first('subject') }}</span>         
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
					<p class="modal-card-title">Delete Subject</p>
					<button class="delete" aria-label="close" v-on:click="dedelete"></button>
				</header>
				<section class="modal-card-body">
					<!-- Content ... -->
					<p>Are you want to delete this subject ?</p>
				</section>
				<footer class="modal-card-foot">
					<button type="submit" class="button is-danger" v-on:click="deletesubject">Delete</button>
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
				
				subject: '',

				deleteitem : [],
				newsubject : [],
				updatesubject : [],

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
						axios.post('/*/admin/custom/addsubject', { 
							subject : vm.subject
						}).then(response => {  
							vm.activeaddmodal = ''
							this.newsubject = response.data
							this.$emit('add-subject',this.newsubject);
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
				this.subject = items.subject_name
			},
			deedit:function(){
				this.activeeditmodal = ''
			},
			editvalidateBeforeSubmit() {
				var vm = this
				this.$validator.validateAll().then((result) => {
					if (result) {
						axios.post('/*/admin/custom/editsubject', { 
							id : vm.id ,
							subject : vm.subject
						}).then(response => {  
							vm.activeeditmodal = ''
							this.updatesubject = response.data
							this.$emit('edit-subject',this.cindex,this.updatesubject);
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
			deletesubject() {
				var vm = this
				axios.post('/*/admin/custom/deletesubject', { 
					id : vm.id
				}).then(response => {
					this.activedeletemodal = ''
					this.$emit('delete-subject',this.cindex);
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