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

						<div :class="{ 'has-error': errors.has('type') }">

							<label class="control-label" for="type">Question Type : </label><br>
							<div class="select is-fullwidth">
								<select  v-model="type" class="input">
									<option>Creative</option>
									<option>MCQ</option>
								</select>
							</div>
							<span v-show="errors.has('type')">{{ errors.first('type') }}</span>         
						</div>
						<br>

						<div :class="{ 'has-error': errors.has('question') }">
							<label class="control-label" for="question">Question : </label><br>
							<input class="input" type="file" name="file" @change="onFileChange" accept="file/*" >
							<span v-show="errors.has('question')">{{ errors.first('question') }}</span>         
						</div>
						<br>

						<div :class="{ 'has-error': errors.has('year') }">
							<label class="control-label" for="year">Year : </label><br>
							<input v-validate="'required'" v-model="year" type="text" name="year" class="input">
							
							<span v-show="errors.has('year')">{{ errors.first('year') }}</span>         
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
					<p> <strong> Question Type : </strong>
						{{type}}
					</p><br> 
					<p> <strong> Question Year : </strong>
						{{year}}
					</p><br>
					<p> <strong> Question : </strong>
						{{question}}
					</p><br>
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

						<div :class="{ 'has-error': errors.has('type') }">

							<label class="control-label" for="type">Question Type : </label><br>
							<div class="select is-fullwidth">
								<select  v-model="type" class="input">
									<option>Creative</option>
									<option>MCQ</option>
								</select>
							</div>
							<span v-show="errors.has('type')">{{ errors.first('type') }}</span>         
						</div>
						<br>

						<div :class="{ 'has-error': errors.has('question') }">
							<label class="control-label" for="question">Question : </label><br>
							<input class="input" type="file" name="file" @change="onFileChange" accept="file/*" >
							<span v-show="errors.has('question')">{{ errors.first('question') }}</span>         
						</div>
						<br>

						<div :class="{ 'has-error': errors.has('year') }">
							<label class="control-label" for="year">Year : </label><br>
							<input v-validate="'required'" v-model="year" type="text" name="year" class="input">
							<span v-show="errors.has('year')">{{ errors.first('year') }}</span>         
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
				activeaddmodal: '',
				activeviewmodal: '',
				activeeditmodal: '',
				activedeletemodal: '',

				question : '',
				type : 'Creative',
				year: '',

				qindex : '',
				id : '',
				subjectid : '',
				exam : '',
				boards : '',

				newquestion : [],
				updatequestion : []
			}
		},
		methods:{
			add:function(sid,exam,board){
				this.activeaddmodal = 'is-active'
				this.subjectid = sid
				this.exam = exam
				this.boards = board
			},
			deadd:function(){
				this.activeaddmodal = ''
			},

			questiontype:function() {
					
			},
			onFileChange(e) {
				var fileReader = new FileReader()
				fileReader.readAsDataURL(e.target.files[0])
				var vm = this;
				fileReader.onload = (e) => {
					vm.question = e.target.result; 
				}  
			},
			validateBeforeSubmit() {
				var vm = this
				this.$validator.validateAll().then((result) => {
					if (result) {
						axios.post('/*/admin/board/addquestion', { 
							subjectid : vm.subjectid ,
							exam : vm.exam,
							board : vm.boards,
							question : vm.question ,
							type : vm.type ,
							year : vm.year 
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
			},
			view:function(items){
				this.activeviewmodal = 'is-active'
				this.question  = items.question
				this.type  = items.type
				this.year  = items.year
			},
			deview:function(){
				this.activeviewmodal = ''
			},
			edit:function(index,items){
				this.activeeditmodal = 'is-active'
				this.qindex = index
				this.id = items.id
				this.question  = items.question
				this.type  = items.type
				this.year  = items.year
			},
			deedit:function(){
				this.activeeditmodal = ''
			},
			editvalidateBeforeSubmit() {
				var vm = this
				this.$validator.validateAll().then((result) => {
					if (result) {
						axios.post('/*/admin/board/editquestion', { 
							id : vm.id ,
							// question : vm.question ,
							type : vm.type ,
							year : vm.year
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
				this.id = id
				this.qindex = index
			},
			dedelete:function(){
				this.activedeletemodal = ''
			},
			deletequestion() {
				var vm = this
				axios.post('/*/admin/board/deletequestion', { 
					id : vm.id
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