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

						<div :class="{ 'has-error': errors.has('institution') }">
							<label class="control-label" for="institution">Institution Name : </label><br>
							<input v-validate="'required'" type="text" v-model="institution" name="institution" class="input">
							<span v-show="errors.has('institution')">{{ errors.first('question') }}</span>         
						</div>
						<br>

						<div :class="{ 'has-error': errors.has('question') }">
							<label class="control-label" for="question">Question : </label><br>
							<input type="file" name="question" class="input" @change="onFileChange" accept="file/*">
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
					<p> Board 	 <span>:</span> <strong>Dhaka</strong> </p><br>
					<p> Exam 	 <span>:</span> <strong>JSC</strong> </p><br>
					<p> Question <span>:</span> <strong>cscsc</strong> </p><br>
					<p> Year 	 <span>:</span> <strong>2017</strong> </p><br>
					

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
							<label class="control-label" for="institution">Institution Name : </label><br>
							<input v-validate="'required'" type="text" v-model="institution" name="institution" class="input" >
							<span v-show="errors.has('institution')">{{ errors.first('question') }}</span>         
						</div>
						<br>

						<div :class="{ 'has-error': errors.has('question') }">
							<label class="control-label" for="question">Question : </label><br>
							<input type="file" name="question" class="input" @change="onFileChange" accept="file/*">
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
				question:'',
				institution:'',
				year:''
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
				this.$validator.validateAll().then((result) => {
					if (result) {
							
						}
					});
			},
			view:function(){
				this.activeviewmodal = 'is-active'
			},
			deview:function(){
				this.activeviewmodal = ''
			},
			edit:function(items){
				this.institution = items[0].q1;
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
			delete:function(){
				this.activedeletemodal = 'is-active'
			},
			dedelete:function(){
				this.activedeletemodal = ''
			},
			deletequestion() {
				alert("ok")
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