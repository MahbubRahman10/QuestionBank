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

						<h1>MCQ Type :  </h1> 

						<div class="control" id="questionfilter">
							<div class="select is-fullwidth">
								<select @change="selectmcqtype" v-model="selecttype">
									<option> Normal </option>
									<option> Advance</option>
									<option> Total Advance</option>
								</select>
							</div>
						</div><br>

						<div :class="{ 'has-error': errors.has('question') }">
							<label class="control-label" for="question">Question : </label><br>
							<textarea v-validate="'required'" v-model="question" name="question" class="textarea"></textarea>
							<span v-show="errors.has('question')">{{ errors.first('question') }}</span>         
						</div>
						<br>

						<div v-if="type == 2">
							<div :class="{ 'has-error': errors.has('question1') }">
								<label class="control-label" for="question1">Question 1 (i) : </label><br>
								<input v-validate="'required'" v-model="question1" type="text" name="question1" class="input">
								<span v-show="errors.has('question1')">{{ errors.first('question1') }}</span>         
							</div>
							<br>
							<div :class="{ 'has-error': errors.has('question2') }">
								<label class="control-label" for="question2">Question 2 (ii) : </label><br>
								<input v-validate="'required'" v-model="question2" type="text" name="question2" class="input">
								<span v-show="errors.has('question2')">{{ errors.first('question2') }}</span>         
							</div>
							<br>
							<div :class="{ 'has-error': errors.has('question3') }">
								<label class="control-label" for="question3">Question 3 (iii) : </label><br>
								<input v-validate="'required'" v-model="question3" type="text" name="question3" class="input">
								<span v-show="errors.has('question3')">{{ errors.first('question3') }}</span>         
							</div>
							<br>
							<h1>Choose the Option : </h1><br>
						</div>

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
						<h2 style="text-align:center;">OR</h2>

						<label class="control-label" for="question4">Import File : </label><br>
						<input type="file" name="file" id="file" @change="onFileChange" class="input" accept="file/*">
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
					<h2><strong> {{question}} </strong></h2><br>

					<div v-if="type == 2">
						<p>(i) {{question1}}</p>
						<p>(ii) {{question2}}</p>
						<p>(iii) {{question3}}</p>
						<br>
						<h2><b>নিচের কোনটি সঠিক?</b></h2>
						<br>
					</div>

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
							<textarea v-validate="'required'" v-model="question" name="question" class="textarea"></textarea>
							<span v-show="errors.has('question')">{{ errors.first('question') }}</span>         
						</div>
						<br>

						<div v-if="type == 2">
							<div :class="{ 'has-error': errors.has('question1') }">
								<label class="control-label" for="question1">Question 1 (i) : </label><br>
								<input v-validate="'required'" v-model="question1" type="text" name="question1" class="input">
								<span v-show="errors.has('question1')">{{ errors.first('question1') }}</span>         
							</div>
							<br>
							<div :class="{ 'has-error': errors.has('question2') }">
								<label class="control-label" for="question2">Question 2 (ii) : </label><br>
								<input v-validate="'required'" v-model="question2" type="text" name="question2" class="input">
								<span v-show="errors.has('question2')">{{ errors.first('question2') }}</span>         
							</div>
							<br>
							<div :class="{ 'has-error': errors.has('question3') }">
								<label class="control-label" for="question3">Question 3 (iii) : </label><br>
								<input v-validate="'required'" v-model="question3" type="text" name="question3" class="input">
								<span v-show="errors.has('question3')">{{ errors.first('question3') }}</span>         
							</div>
							<br>
							<h1>Choose the Option : </h1><br>
						</div>

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
	
	export default{
		data(){
			return{
				selecttype : 'Normal',
				type : '1',

				activeaddmodal: '',
				activeviewmodal: '',
				activeeditmodal: '',
				activedeletemodal: '',
				
				question : '',
				question1 : '',
				question2 : '',
				question3 : '',
				question4 : '',
				option1 : '',
				option2 : '',
				option3 : '',
				option4 : '',
				canswer : '',
				file : '',

				correctans : '',

				deleteitem : [],
				newquestion : [],

				qindex : '',
				secid : ''
			}
		},
		methods:{
			selectmcqtype:function() {
				if(this.selecttype == 'Normal'){
					this.type = 1
				}
				else{
					this.type = 2
				}
			},
			add:function(id){
				this.activeaddmodal = 'is-active'
				this.secid = id
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
							axios.post('/*/admin/exam/normal/addquestion', { 
								secid : vm.secid ,
								question : vm.question ,
								mcq_type : vm.type ,
								question1 : vm.question1 ,
								question2 : vm.question2 ,
								question3 : vm.question3 ,
								question4 : vm.question4 ,
								option1 : vm.option1 ,
								option2 : vm.option2 ,
								option3 : vm.option3 ,
								option4 : vm.option4 ,
								correct : vm.canswer
							}).then(response => {  
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
					axios.post('/*/admin/exam/normal/addquestion', { 
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
				this.question  = items.question_name
				this.type  = items.mcq_type
				this.question1  = items.c1
				this.question2  = items.c2
				this.question3  = items.c3
				this.option1  = items.option_no_1
				this.option2  = items.option_no_2
				this.option3  = items.option_no_3
				this.option4  = items.option_no_4
				this.correctans  = items.correct_answer
			},
			deview:function(){
				this.activeviewmodal = ''
			},
			edit:function(index,items,id){
				this.activeeditmodal = 'is-active'
				this.qindex = index
				this.secid = items.id
				this.question  = items.question_name
				this.type = items.mcq_type
				this.question1  = items.c1
				this.question2  = items.c2
				this.question3  = items.c3
				this.option1  = items.option_no_1
				this.option2  = items.option_no_2
				this.option3  = items.option_no_3
				this.option4  = items.option_no_4
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
				this.activeeditmodal = ''
			},
			editvalidateBeforeSubmit() {
				var vm = this
				this.$validator.validateAll().then((result) => {
					if (result) {
						axios.post('/*/admin/exam/normal/editquestion', { 
							id : vm.secid ,
							question : vm.question ,
							option1 : vm.option1 ,
							option2 : vm.option2 ,
							option3 : vm.option3 ,
							option4 : vm.option4 ,
							correct : vm.canswer
						}).then(response => {  
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
				axios.post('/*/admin/exam/normal/deletequestion', { 
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