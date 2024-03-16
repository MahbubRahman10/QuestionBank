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
						
						<div class="control" id="questionfilter">
							<label class="control-label" for="institution">Subject : </label><br>
							<div class="select is-fullwidth">
								<select v-model="selectsubject">
									<option v-for="(subject,index) in subjects"> {{ subject.subject_name }} </option>
								</select>
							</div>
						</div><br>

						<br>
					</form>
				</section>
				<footer class="modal-card-foot">					
					<button type="submit" class="button is-success" v-on:click="validateBeforeSubmit">Submit</button>
					<button class="button" v-on:click="deadd">Cancel</button>
				</footer>
			</div>
		</div>

		<div class="modal" v-bind:class="activeaddsectionmodal">
			<div class="modal-background"></div>
			<div class="modal-card">
				<header class="modal-card-head">
					<p class="modal-card-title">Add Section</p>
					<button class="delete" aria-label="close" v-on:click="deaddsection"></button>
				</header>
				<section class="modal-card-body">
					<!-- Content ... -->
					<form @submit.prevent="">
						
						<div :class="{ 'has-error': errors.has('sectionno') }">
							<label class="control-label" for="option1">Section No : </label><br>
							<input v-validate="'required'" v-model="sectionno" type="text" name="sectionno" class="input">
							<span v-show="errors.has('sectionno')">{{ errors.first('sectionno') }}</span>         
						</div><br>
						<div :class="{ 'has-error': errors.has('section') }">
							<label class="control-label" for="option1">Section Name : </label><br>
							<input v-validate="'required'" v-model="section" type="text" name="subject" class="input">
							<span v-show="errors.has('section')">{{ errors.first('section') }}</span>         
						</div>

						<br>
					</form>
				</section>
				<footer class="modal-card-foot">					
					<button type="submit" class="button is-success" v-on:click="validateSectionBeforeSubmit">Submit</button>
					<button class="button" v-on:click="deaddsection">Cancel</button>
				</footer>
			</div>
		</div>

		<div class="modal" v-bind:class="activesectioneditmodal">
			<div class="modal-background"></div>
			<div class="modal-card">
				<header class="modal-card-head">
					<p class="modal-card-title">Edit Section</p>
					<button class="delete" aria-label="close" v-on:click="deeditsection"></button>
				</header>
				<section class="modal-card-body">
					<!-- Content ... -->
					<form @submit.prevent="">
						
						<div :class="{ 'has-error': errors.has('sectionno') }">
							<label class="control-label" for="option1">Section No : </label><br>
							<input v-validate="'required'" v-model="sectionno" type="text" name="sectionno" class="input">
							<span v-show="errors.has('sectionno')">{{ errors.first('sectionno') }}</span>         
						</div><br>
						<div :class="{ 'has-error': errors.has('section') }">
							<label class="control-label" for="option1">Section Name : </label><br>
							<input v-validate="'required'" v-model="section" type="text" name="subject" class="input">
							<span v-show="errors.has('section')">{{ errors.first('section') }}</span>         
						</div>

						<br>
					</form>
				</section>
				<footer class="modal-card-foot">					
					<button type="submit" class="button is-success" v-on:click="editsectionvalidateBeforeSubmit">Submit</button>
					<button class="button" v-on:click="deeditsection">Cancel</button>
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

		<div class="modal"  v-bind:class="activedeletesectionmodal">
			<div class="modal-background"></div>
			<div class="modal-card">
				<header class="modal-card-head">
					<p class="modal-card-title">Delete Section</p>
					<button class="delete" aria-label="close" v-on:click="dedeletesection"></button>
				</header>
				<section class="modal-card-body">
					<!-- Content ... -->
					<p>Are you want to delete this section ?</p>
				</section>
				<footer class="modal-card-foot">
					<button type="submit" class="button is-danger" v-on:click="deletesection">Delete</button>
					<button class="button" v-on:click="dedeletesection">Cancel</button>
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
				
				activeaddsectionmodal : '',
				activedeletesectionmodal : '',
				activesectioneditmodal : '',


				subject: '',
				subjects : [],
				selectsubject : '',
				clasub : '',

				section: '',
				sectionno : '',

				deleteitem : [],
				newsubject : [],
				updatesubject : [],

				cindex : '',
				id : ''
			}
		},
		methods:{
			add:function(category){
					this.category = category
					axios.get('/*/admin/custom/getsubject',{				
						params: {
							page: this.subjects.length / 20 + 1
						},
					})
					.then( response => {  
						this.subjects = response.data.subject.data;
						this.activeaddmodal = 'is-active'
					})
					.catch( error  => {
						console.log(error);
					});
				
			},
			deaddsection:function(id){
				this.activeaddsectionmodal = ''	
			},
			addsection:function(id){
				this.id = id 
				this.activeaddsectionmodal = 'is-active'	
			},
			deadd:function(){
				this.activeaddmodal = ''
			},
			validateBeforeSubmit() {
				var vm = this
				this.$validator.validateAll().then((result) => {
					if (result) {
						axios.post('/*/admin/custom/addsubjecttoclass', { 
							category : vm.category,
							subject : vm.selectsubject
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
			validateSectionBeforeSubmit() {
				var vm = this
				this.$validator.validateAll().then((result) => {
					if (result) {
						axios.post('/*/admin/custom/addsectiontosubject', { 
							clasubid : vm.id,
							section : vm.section,
							sectionno : vm.sectionno
						}).then(response => {  
							vm.activeaddsectionmodal = ''
							this.newsubject = response.data
							this.$emit('add-section',this.newsubject);
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
			editsection:function(index,items){
				this.activesectioneditmodal = 'is-active'
				this.cindex = index
				this.id = items.id
				this.section = items.section_name
				this.sectionno = items.section_no
			},
			deeditsection:function(){
				this.activesectioneditmodal = ''
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
			editsectionvalidateBeforeSubmit() {
				var vm = this
				this.$validator.validateAll().then((result) => {
					if (result) {
						axios.post('/*/admin/custom/editsection', { 
							id : vm.id ,
							sectionno : vm.sectionno,
							section : vm.section
						}).then(response => {  
							vm.activesectioneditmodal = ''
							this.updatesubject = response.data
							this.$emit('edit-section',this.cindex,this.updatesubject);
						})
						.catch( error  => {
							console.log(error);
						});
					}
				});
			},
			delete:function(index,id, category){
				this.activedeletemodal = 'is-active'
				this.id = id
				this.category = category
				this.cindex = index
			},
			dedelete:function(){
				this.activedeletemodal = ''
			},
			deletesubject() {
				var vm = this
				axios.post('/*/admin/custom/deleteclasssubject', { 
					id : vm.id,
					category : vm.category
				}).then(response => {
					this.activedeletemodal = ''
					this.$emit('delete-subject',this.cindex);
				})
				.catch( error  => {
					console.log(error);
				});
			},
			deletes:function(index,id){
				this.activedeletesectionmodal = 'is-active'
				this.id = id
				this.cindex = index
			},
			dedeletesection:function(){
				this.activedeletesectionmodal = ''
			},
			deletesection() {
				var vm = this
				axios.post('/*/admin/custom/deletesubjectsection', { 
					id : vm.id
				}).then(response => {
					this.activedeletesectionmodal = ''
					this.$emit('delete-section',this.cindex);
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