<template>
	<div>
		<div class="modal" v-bind:class="activeaddmodal">
			<div class="modal-background"></div>
			<div class="modal-card">
				<header class="modal-card-head">
					<p class="modal-card-title">Add Question</p>
					<button class="delete" aria-label="close" v-on:click="deadd"></button>
				</header>
				<section class="modal-card-body">
					<!-- Content ... -->
					<form @submit.prevent="">


						<label class="control-label" for="question4">Import File : </label><br>
						<input type="file" name="file" id="file" @change="onFileChange" class="input" accept="file/*">
						<br><br>

						<h2 style="text-align:center;">OR</h2>

						<div :class="{ 'has-error': errors.has('institution') }">
							<label class="control-label" for="institution">Institution : </label><br>
							<input v-validate="'required'" v-model="institution" type="text" name="institution" class="input">
							<span v-show="errors.has('institution')">{{ errors.first('institution') }}</span>         
						</div>
						<br>

						<div :class="{ 'has-error': errors.has('question') }">
							<label class="control-label" for="question">Question : </label><br>
							<tinymce v-validate="'required'" v-model="question" :plugins="myPlugins" :toolbar1="myToolbar1" :toolbar2="myToolbar2" :other="myOtherOptions"></tinymce>
							<input type="file" name="image" id="upload" class="hidden" onchange="" style="display:none;">
							<span v-show="errors.has('question')">{{ errors.first('question') }}</span>         
						</div>
						<br>

						<div :class="{ 'has-error': errors.has('question1') }">
							<label class="control-label" for="question1">Question No.1 : </label><br>
							<input v-validate="'required'" v-model="question1" type="text" name="question1" class="input">
							<span v-show="errors.has('question1')">{{ errors.first('question1') }}</span>         
						</div>
						<br>

						<div :class="{ 'has-error': errors.has('question2') }">
							<label class="control-label" for="question2">Question No.2 : </label><br>
							<input v-validate="'required'" v-model="question2" type="text" name="question2" class="input">
							<span v-show="errors.has('question2')">{{ errors.first('question2') }}</span>         
						</div>
						<br>

						<div :class="{ 'has-error': errors.has('question3') }">
							<label class="control-label" for="question3">Question No.3 : </label><br>
							<input v-validate="'required'" v-model="question3" type="text" name="question3" class="input">
							<span v-show="errors.has('question3')">{{ errors.first('question3') }}</span>         
						</div>
						<br>
						<div :class="{ 'has-error': errors.has('question4') }" v-if="questionno4">
							<label class="control-label" for="question4">Question No.4 : </label><br>
							<input v-validate="'required'" v-model="question4" type="text" name="question4" class="input">
							<span v-show="errors.has('question4')">{{ errors.first('question4') }}</span>         
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

		<div class="modal" v-bind:class="activeviewmodal">
			<div class="modal-background"></div>
			<div class="modal-card">
				<header class="modal-card-head">
					<p class="modal-card-title">View Question</p>
					<button class="delete" aria-label="close" v-on:click="deview"></button>
				</header>
				<section class="modal-card-body">
					<!-- Content ... -->
					<strong><p>{{ institution }}</p></strong><br>
					<p v-html="question">
					</p><br>

					<p> 1. {{question1}} </p>
					<p> 2. {{question2}} </p>
					<p> 3. {{question3}} </p>
					<p v-if="question4"> 4. {{question4}} </p>

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

						<div :class="{ 'has-error': errors.has('institution') }">
							<label class="control-label" for="institution">Institution : </label><br>
							<input v-validate="'required'" v-model="institution" type="text" name="institution" class="input">
							<span v-show="errors.has('institution')">{{ errors.first('institution') }}</span>         
						</div>
						<br>

						<div :class="{ 'has-error': errors.has('question') }">
							<label class="control-label" for="question">Question : </label><br>
							<tinymce v-validate="'required'" v-model="question" :plugins="myPlugins" :toolbar1="myToolbar1" :toolbar2="myToolbar2" :other="myOtherOptions"></tinymce>
							<input type="file" name="image" id="upload" class="hidden" onchange="" style="display:none;">      
						</div>
						<br>

						<div :class="{ 'has-error': errors.has('question1') }">
							<label class="control-label" for="question1">Question No.1 : </label><br>
							<input v-validate="'required'" v-model="question1" type="text" name="question1" class="input">
							<span v-show="errors.has('question1')">{{ errors.first('question1') }}</span>         
						</div>
						<br>

						<div :class="{ 'has-error': errors.has('question2') }">
							<label class="control-label" for="question2">Question No.2 : </label><br>
							<input v-validate="'required'" v-model="question2" type="text" name="question2" class="input">
							<span v-show="errors.has('question2')">{{ errors.first('question2') }}</span>         
						</div>
						<br>

						<div :class="{ 'has-error': errors.has('question3') }">
							<label class="control-label" for="question3">Question No.3 : </label><br>
							<input v-validate="'required'" v-model="question3" type="text" name="question3" class="input">
							<span v-show="errors.has('question3')">{{ errors.first('question3') }}</span>         
						</div>
						<br>

						<div :class="{ 'has-error': errors.has('question4') }" v-if="questionno4">
							<label class="control-label" for="question4">Question No.4 : </label><br>
							<input v-validate="'required'" v-model="question4" type="text" name="question4" class="input">
							<span v-show="errors.has('question4')">{{ errors.first('question4') }}</span>         
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
					<p class="modal-card-title">Delete Question</p>
					<button class="delete" aria-label="close" v-on:click="dedelete"></button>
				</header>
				<section class="modal-card-body">
					<!-- Content ... -->
					<p>Are you want to delete this question ?</p>
				</section>
				<footer class="modal-card-foot">
					<button type="submit" class="button is-danger" v-on:click="deletequestion">Delete</button>
					<button class="button" v-on:click="dedelete">Cancel</button>
				</footer>
			</div>
		</div>
	</div>
</template>

<script>

	// Tinymce
	var VueEasyTinyMCE = require('vue-easy-tinymce');

	
	export default{
		components: {
        	'tinymce': VueEasyTinyMCE
    	},
		data(){
			return{
				
				myPlugins : [
				'advlist autolink lists link image charmap print preview hr anchor pagebreak',
				'searchreplace wordcount visualblocks visualchars code fullscreen',
				'insertdatetime media nonbreaking save table contextmenu directionality',
				'emoticons template paste textcolor colorpicker textpattern'
				],
				myToolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
				myToolbar2: "print preview media | forecolor backcolor emoticons",
				myOtherOptions : {
					image_advtab: true,
					file_picker_callback: function(callback, value, meta) {
						if (meta.filetype == 'image') {
							$('#upload').trigger('click');
							$('#upload').on('change', function() {
								var file = this.files[0];
								var reader = new FileReader();
								reader.onload = function(e) {
									callback(e.target.result, {
										alt: ''
									});
								};
								reader.readAsDataURL(file);
							});
						}
					}
				},

				questionno4: true,
				subject_name : '',
				activeaddmodal: '',
				activeviewmodal: '',
				activeeditmodal: '',
				activedeletemodal: '',
				question: '',
				institution : '',
				question1: '',
				question2: '',
				question3: '',
				question4: '',
				file : '',
				deleteitem : [],
				newquestion : [],

				qindex : '',
				secid : ''
			}
		},
		methods:{
			add:function(id, name){
				this.subject_name = name
				if (this.subject_name == 'গনিত') {
					this.question4 = "NULL"
					this.questionno4 = false 
				}
				else{
					this.questionno4 = true 
				}
				this.activeaddmodal = 'is-active'
				this.secid = id
			},
			deadd:function(){
				this.institution = ''
				this.question = ''
				this.question1 = ''
				this.question2 = ''
				this.question3 = ''
				this.question4 = ''
				this.$validator.reset()
				this.errors.clear() 
				this.activeaddmodal = ''
			},
			onFileChange(e) {

				var fileReader = new FileReader()
				fileReader.readAsDataURL(e.target.files[0])
				var vm = this;				
				
				var fileName = e.target.files[0].name
				var ext = fileName.split('.').pop();

				if(ext == "xlsx"){
					fileReader.onload = (e) => {
						vm.file = e.target.result; 
					}  
				}
				else{
					$("#file").val("")
					alert("Please Upload only xlxs file")
				}

			},
			validateBeforeSubmit() {
				var vm = this
				if (vm.file == '') {
					this.$validator.validateAll().then((result) => {
						if (result) {
							axios.post('/*/admin/question/addquestion', { 
								secid : vm.secid ,
								institution : vm.institution,
								question : vm.question ,
								question1 : vm.question1 ,
								question2 : vm.question2 ,
								question3 : vm.question3 ,
								question4 : vm.question4
							}).then(response => {  
								this.institution = ''
								this.question = ''
								this.question1 = ''
								this.question2 = ''
								this.question3 = ''
								this.question4 = ''
								this.$validator.reset()
								this.errors.clear()
								vm.activeaddmodal = ''
								this.newquestion = response.data
								this.$emit('add-question',this.newquestion);
							})
							.catch( error  => {
								console.log(error);
							});
						}
					});
				}
				else{
					axios.post('/*/admin/question/addquestion', { 
						secid : vm.secid ,
						file : vm.file
					}).then(response => {  
						vm.activeaddmodal = ''
						this.newquestion = response.data
						this.$emit('add-question',this.newquestion);
					})
					.catch( error  => {
						console.log(error);
					});

				}
			},

			view:function(items){
				this.activeviewmodal = 'is-active'
				this.institution = items.institution
				this.question  = items.question_name
				this.question1  = items.question_no_1
				this.question2  = items.question_no_2
				this.question3  = items.question_no_3
				this.question4  = items.question_no_4
			},
			deview:function(){
				this.institution = ''
				this.question = ''
				this.question1 = ''
				this.question2 = ''
				this.question3 = ''
				this.question4 = ''
				this.$validator.reset()
				this.errors.clear() 
				this.activeviewmodal = ''
			},
			edit:function(index,items,id,subject){
				this.activeeditmodal = 'is-active'
				this.qindex = index
				this.secid = items.id
				this.institution = items.institution
				this.question  = items.question_name
				this.question1  = items.question_no_1
				this.question2  = items.question_no_2
				this.question3  = items.question_no_3

				this.subject_name = subject
				if (this.subject_name == 'গনিত') {
					this.question4 = "NULL"
					this.questionno4 = false 
				}
				else{
					this.question4  = items.question_no_4
					this.questionno4 = true 
				}
			},
			deedit:function(){
				this.institution = ''
				this.question = ''
				this.question1 = ''
				this.question2 = ''
				this.question3 = ''
				this.question4 = ''
				this.$validator.reset()
				this.errors.clear()
				this.activeeditmodal = ''
			},
			editvalidateBeforeSubmit() {
				var vm = this
				this.$validator.validateAll().then((result) => {
					if (result) {
						axios.post('/*/admin/question/editquestion', { 
							id : vm.secid ,
							institution : vm.institution,
							question : vm.question ,
							question1 : vm.question1 ,
							question2 : vm.question2 ,
							question3 : vm.question3 ,
							question4 : vm.question4
						}).then(response => {  
							this.institution = ''
							this.question = ''
							this.question1 = ''
							this.question2 = ''
							this.question3 = ''
							this.question4 = ''
							this.$validator.reset()
							this.errors.clear()
							vm.activeeditmodal = ''
							this.updatequestion = response.data
							this.$emit('edit-question',this.qindex,this.updatequestion);
						})
						.catch( error  => {
							console.log(error);
						});
					}
				});
			},
			delete:function(index,id){
				this.activedeletemodal = 'is-active'				
				this.secid = id
				this.qindex = index
			},
			dedelete:function(){
				this.activedeletemodal = ''
			},
			deletequestion() {
				var vm = this
				axios.post('/*/admin/question/deletequestion', { 
					id : vm.secid
				}).then(response => {
					this.activedeletemodal = ''
					this.$emit('delete-question',this.qindex);
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