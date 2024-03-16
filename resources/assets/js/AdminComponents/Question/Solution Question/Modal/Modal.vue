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

						<div :class="{ 'has-error': errors.has('title') }">

							<label class="control-label" for="type">Title : </label><br>
							<input v-validate="'required'" v-model="title" type="text" name="title" class="input">
							<span v-show="errors.has('title')">{{ errors.first('title') }}</span>         
						</div>
						<br>

						<div :class="{ 'has-error': errors.has('year') }">
							<label class="control-label" for="year">Year : </label><br>
							<input v-validate="'required'" v-model="year" type="text" name="year" class="input">
							<span v-show="errors.has('year')">{{ errors.first('year') }}</span>         
						</div>
						<br>

						<div :class="{ 'has-error': errors.has('file') }">
							<label class="control-label" for="file">File : </label><br>
							<input class="input" type="file" name="file" @change="onFileChange" accept="file/*" >
							<span v-show="errors.has('file')">{{ errors.first('file') }}</span>         
						</div>
						<br>
						<div :class="{ 'has-error': errors.has('tag') }">
							<label class="control-label" for="tag">Tags : </label><br>
							<vue-tags-input v-model="tag" :tags="tags" @tags-changed="newTags => tags = newTags"
							/>
							<span v-show="errors.has('tag')">{{ errors.first('tag') }}</span>         
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
					<p> <strong> Title : </strong>
						{{title}}
					</p><br> 
					<p> <strong> Year : </strong>
						{{year}}
					</p><br>
					<p> <strong> Question : </strong>
						<a :href="'http://localhost:8000/SolutionQuestion/'+question">{{ question }}</a>
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
						<div :class="{ 'has-error': errors.has('title') }">
							<label class="control-label" for="title">Title : </label><br>
							<input v-validate="'required'" v-model="title" type="text" name="title" class="input">
							<span v-show="errors.has('title')">{{ errors.first('title') }}</span>         
						</div>
						<br>

						<div :class="{ 'has-error': errors.has('year') }">
							<label class="control-label" for="year">Year : </label><br>
							<input v-validate="'required'" v-model="year" type="text" name="year" class="input">
							<span v-show="errors.has('year')">{{ errors.first('year') }}</span>         
						</div>
						<br>

						<div :class="{ 'has-error': errors.has('file') }">
							<label class="control-label" for="file">File : </label><br>
							<input class="input" type="file" name="file" @change="onFileChange" accept="file/*" >
							<span v-show="errors.has('file')">{{ errors.first('file') }}</span>         
						</div>
						<br>
						<div :class="{ 'has-error': errors.has('tag') }">
							<label class="control-label" for="tag">Tags : </label><br>
							<vue-tags-input v-model="tag" :tags="tags" @tags-changed="newTags => tags = newTags"
							/>
							<span v-show="errors.has('tag')">{{ errors.first('tag') }}</span>         
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
	
	import VueTagsInput from '@johmun/vue-tags-input'

	export default{
		components: {
        	VueTagsInput
    	},
		data(){
			return{
				activeaddmodal: '',
				activeviewmodal: '',
				activeeditmodal: '',
				activedeletemodal: '',

				file : '',
				title : '',
				year: '',

				qindex : '',
				id : '',
				category : '',
				question : '',

				newquestion : [],
				updatequestion : [],

				tag: '',
				tags: []
			}
		},
		methods:{
			add:function(category){
				this.activeaddmodal = 'is-active'
				this.category = category
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
					vm.file = e.target.result; 
				}  
			},
			validateBeforeSubmit() {
				var vm = this
				this.$validator.validateAll().then((result) => {
					if (result) {
						axios.post('/*/admin/questionsolve/addquestion', { 
							category : vm.category ,
							file : vm.file ,
							title : vm.title,
							year : vm.year,
							tags : vm.tags 
						}).then(response => {  
							vm.activeaddmodal = ''
							vm.file = ''
							vm.title = ''
							vm.year = ''
							this.tag = ''
							this.tags = []
							this.errors.clear()
							this.$validator.reset()
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
				this.question  = items.file
				this.title  = items.title
				this.year  = items.year
			},
			deview:function(){
				this.file = ''
				this.title = ''
				this.year = ''
				this.errors.clear()
				this.$validator.reset()
				this.activeviewmodal = ''
			},
			edit:function(index,items){
				
				axios.post('/*/admin/questionsolve/gettags', { 
					id : items.id 
				}).then(response => {  
					var data = response.data
					for (var i = 0; i < data.length; i++) {
						 vm.tags.push({text: data[i].tag_name}); 
					}
					this.activeeditmodal = 'is-active'
					this.qindex = index
					this.id = items.id
					this.title  = items.title
					this.year  = items.year
				})
				.catch( error  => {
					console.log(error);
				});
			},
			deedit:function(){
				this.file = ''
				this.title = ''
				this.year = ''
				this.tag = ''
				this.tags = []
				this.errors.clear()
				this.$validator.reset()
				this.activeeditmodal = ''
			},
			editvalidateBeforeSubmit() {
				var vm = this
				this.$validator.validateAll().then((result) => {
					if (result) {
						axios.post('/*/admin/questionsolve/editquestion', { 
							id : vm.id ,
							// question : vm.question ,
							title : vm.title ,
							year : vm.year,
							tags : vm.tags
						}).then(response => { 
							vm.file = ''
							vm.title = ''
							vm.year = ''
							this.tag = ''
							this.tags = []
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
				this.id = id
				this.qindex = index
			},
			dedelete:function(){
				this.activedeletemodal = ''
			},
			deletequestion() {
				var vm = this
				axios.post('/*/admin/questionsolve/deletequestion', { 
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