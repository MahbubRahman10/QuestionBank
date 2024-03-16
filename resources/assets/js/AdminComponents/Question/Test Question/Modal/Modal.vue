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
						<br>

						<div :class="{ 'has-error': errors.has('question') }">
							<label class="control-label" for="question">Question : </label><br>
							<tinymce v-validate="'required'" v-model="question" :plugins="myPlugins" :toolbar1="myToolbar1" :toolbar2="myToolbar2" :other="myOtherOptions"></tinymce>
							<input type="file" name="image" id="upload" class="hidden" onchange="" style="display:none;">
							<span v-show="errors.has('question')">{{ errors.first('question') }}</span>         
						</div>
						<br>

						<div :class="{ 'has-error': errors.has('option1') }">
							<label class="control-label" for="option1">Option 1 : </label><br>
							<input v-validate="'required'" v-model="option1" type="text" name="option1" class="input">
							<span v-show="errors.has('option1')">{{ errors.first('option1') }}</span>         
						</div>
						<br>

						<div :class="{ 'has-error': errors.has('option2') }">
							<label class="control-label" for="option2">Option 2 : </label><br>
							<input v-validate="'required'" v-model="option2" type="text" name="option2" class="input">
							<span v-show="errors.has('option2')">{{ errors.first('option2') }}</span>         
						</div>
						<br>

						<div :class="{ 'has-error': errors.has('option3') }">
							<label class="control-label" for="option3">Option 3 : </label><br>
							<input v-validate="'required'" v-model="option3" type="text" name="option3" class="input">
							<span v-show="errors.has('option3')">{{ errors.first('option3') }}</span>         
						</div>
						<br>

						<div :class="{ 'has-error': errors.has('option4') }">
							<label class="control-label" for="option4">Option 4 : </label><br>
							<input v-validate="'required'" v-model="option4" type="text" name="option4" class="input">
							<span v-show="errors.has('option4')">{{ errors.first('option4') }}</span>         
						</div>
						<br>
						<div :class="{ 'has-error': errors.has('correct') }">
							<label class="control-label" for="correct">Correct Answer : </label><br>
							<div class="control" id="questionfilter">
								<div class="select is-fullwidth">
									<select @change="correctanswer" v-model="correctans" class="input">
										<option> option 1 </option>
										<option> option 2</option>
										<option> option 3</option>
										<option> option 4</option>
									</select><br>
								</div>
							</div>
							<span v-show="errors.has('correct')">{{ errors.first('correct') }}</span>         
						</div>
						<br>
						<div>
							<label class="control-label" for="pexam">Last Exam : </label><br>
							<input v-model="pexam" type="text" name="pexam" class="input">         
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
					<h2><strong v-html="question"> </strong> <span v-if="pexam != null">({{ pexam }})</span> </h2><br>

					<p>১. {{option1}}</p>
					<p>৩. {{option2}}</p>
					<p> ২. {{option3}} </p>
					<p> ৪. {{option4}} </p>
					<br>
					<h4><strong> Correct Answer : {{correctans}} </strong></h4>											
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

						<div :class="{ 'has-error': errors.has('question') }">
							<label class="control-label" for="question">Question : </label><br>
							<tinymce v-validate="'required'" v-model="question" :plugins="myPlugins" :toolbar1="myToolbar1" :toolbar2="myToolbar2" :other="myOtherOptions"></tinymce>
							<input type="file" name="image" id="upload" class="hidden" onchange="" style="display:none;">      
						</div>
						<br>

						<div :class="{ 'has-error': errors.has('option1') }">
							<label class="control-label" for="option1">Option 1 : </label><br>
							<input v-validate="'required'" v-model="option1" type="text" name="option1" class="input">
							<span v-show="errors.has('option1')">{{ errors.first('option1') }}</span>         
						</div>
						<br>

						<div :class="{ 'has-error': errors.has('option2') }">
							<label class="control-label" for="option2">Option 2 : </label><br>
							<input v-validate="'required'" v-model="option2" type="text" name="option2" class="input">
							<span v-show="errors.has('option2')">{{ errors.first('option2') }}</span>         
						</div>
						<br>

						<div :class="{ 'has-error': errors.has('option3') }">
							<label class="control-label" for="option3">Option 3 : </label><br>
							<input v-validate="'required'" v-model="option3" type="text" name="option3" class="input">
							<span v-show="errors.has('option3')">{{ errors.first('option3') }}</span>         
						</div>
						<br>

						<div :class="{ 'has-error': errors.has('option4') }">
							<label class="control-label" for="option4">Option 4 : </label><br>
							<input v-validate="'required'" v-model="option4" type="text" name="option4" class="input">
							<span v-show="errors.has('option4')">{{ errors.first('option4') }}</span>         
						</div>
						<br>
						<div :class="{ 'has-error': errors.has('correct') }">
							<label class="control-label" for="correct">Correct Answer : </label><br>
							<div class="control" id="questionfilter">
								<div class="select is-fullwidth">
									<select @change="correctanswer" v-model="correctans" class="input">
										<option> option 1 </option>
										<option> option 2</option>
										<option> option 3</option>
										<option> option 4</option>
									</select><br>
								</div>
							</div>
							<span v-show="errors.has('correct')">{{ errors.first('correct') }}</span>         
						</div>
						<br>
						<div>
							<label class="control-label" for="pexam">Last Exam : </label><br>
							<input v-model="pexam" type="text" name="pexam" class="input">         
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


				activeaddmodal: '',
				activeviewmodal: '',
				activeeditmodal: '',
				activedeletemodal: '',
				
				question : '',
				option1 : '',
				option2 : '',
				option3 : '',
				option4 : '',
				canswer : '',
				pexam : '',
				file : '',

				correctans : '',

				deleteitem : [],
				newquestion : [],

				qindex : '',
				clasubid : ''
			}
		},
		methods:{
				add:function(id){
				this.activeaddmodal = 'is-active'
				this.clasubid = id
			},
			correctanswer:function() {
				if (this.correctans == 'option 1' && this.option1 != '') {
					this.canswer = this.option1
				}
				else if (this.correctans == 'option 2' && this.option2 != '') {
					this.canswer = this.option2
				}
				else if (this.correctans == 'option 3' && this.option3 != '') {
					this.canswer = this.option3
				}
				else if (this.correctans == 'option 4' && this.option4 != '') {
					this.canswer = this.option4
				}
				else{
					this.correctans = ''
					alert("Please fill up question part properly")
				}
			},
			deadd:function(){
				this.correctans = ''
				this.question = ''
				this.option1 = ''
				this.option2 = ''
				this.option3 = ''
				this.option4 = ''
				this.canswer = ''
				this.pexam = ''
				this.errors.clear()
				this.$validator.reset()
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
							axios.post('/*/admin/university/addquestion', { 
								clasubid : vm.clasubid ,
								question : vm.question ,
								mcq_type : 1 ,
								option1 : vm.option1 ,
								option2 : vm.option2 ,
								option3 : vm.option3 ,
								option4 : vm.option4 ,
								correct : vm.canswer ,
								pexam  : vm.pexam
							}).then(response => {
								this.correctans = ''
								this.question = ''
								this.option1 = ''
								this.option2 = ''
								this.option3 = ''
								this.option4 = ''
								this.canswer = ''
								this.pexam = ''
								this.errors.clear()
								this.$validator.reset()  
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
					axios.post('/*/admin/university/addquestion', { 
						clasubid : vm.clasubid ,
						mcq_type : 1 ,
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
				this.question  = items.question_name
				this.option1  = items.option_no_1
				this.option2  = items.option_no_2
				this.option3  = items.option_no_3
				this.option4  = items.option_no_4
				this.pexam  = items.pexam
				this.correctans  = items.correct_answer
			},
			deview:function(){
				this.correctans = ''
				this.question = ''
				this.option1 = ''
				this.option2 = ''
				this.option3 = ''
				this.option4 = ''
				this.canswer = ''
				this.pexam = ''
				this.errors.clear()
				this.$validator.reset()
				this.activeviewmodal = ''
			},
			edit:function(index,items,id){
				this.activeeditmodal = 'is-active'
				this.qindex = index
				this.clasubid = items.id
				this.question  = items.question_name
				this.option1  = items.option_no_1
				this.option2  = items.option_no_2
				this.option3  = items.option_no_3
				this.option4  = items.option_no_4
				this.pexam  = items.pexam
				if(items.correct_answer == this.option1){
					this.correctans = 'option 1'
					this.canswer = items.correct_answer
				}
				else if(items.correct_answer == this.option2){
					this.correctans = 'option 2'
					this.canswer = items.correct_answer
				}
				else if(items.correct_answer == this.option3){
					this.correctans = 'option 3'
					this.canswer = items.correct_answer
				}
				else{
					this.correctans = 'option 4'
					this.canswer = items.correct_answer
				}

			},
			deedit:function(){
				this.correctans = ''
				this.question = ''
				this.option1 = ''
				this.option2 = ''
				this.option3 = ''
				this.option4 = ''
				this.canswer = ''
				this.pexam = ''
				this.errors.clear()
				this.$validator.reset()
				this.activeeditmodal = ''
			},
			editvalidateBeforeSubmit() {
				var vm = this
				this.$validator.validateAll().then((result) => {
					if (result) {
						axios.post('/*/admin/university/editquestion', { 
							id : vm.clasubid ,
							question : vm.question ,
							option1 : vm.option1 ,
							option2 : vm.option2 ,
							option3 : vm.option3 ,
							option4 : vm.option4 ,
							correct : vm.canswer,							
							pexam    : vm.pexam
						}).then(response => { 
							this.correctans = ''
							this.question = ''
							this.option1 = ''
							this.option2 = ''
							this.option3 = ''
							this.option4 = ''
							this.canswer = ''
							this.pexam = ''
							this.errors.clear()
							this.$validator.reset() 
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
				this.clasubid = id
				this.qindex = index
			},
			dedelete:function(){
				this.activedeletemodal = ''
			},
			deletequestion() {
				var vm = this
				axios.post('/*/admin/university/deletequestion', { 
					id : vm.clasubid
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