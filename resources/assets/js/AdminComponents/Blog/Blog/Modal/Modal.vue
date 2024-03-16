<template>
	<div>

		<div class="modal" v-bind:class="activeaddmodal">
			<div class="modal-background"></div>
			<div class="modal-card">
				<header class="modal-card-head">
					<p class="modal-card-title">Add Post</p>
					<button class="delete" aria-label="close" v-on:click="deadd"></button>
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
						<div :class="{ 'has-error': errors.has('description') }">
							<label class="control-label" for="description">Description : </label><br>
							<tinymce v-validate="'required'" v-model="description" :plugins="myPlugins" :toolbar1="myToolbar1" :toolbar2="myToolbar2" :other="myOtherOptions"></tinymce>
							<input type="file" name="image" id="upload" class="hidden" onchange="" style="display:none;">
							<span v-show="errors.has('description')">{{ errors.first('description') }}</span>         
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

		<div class="modal"  v-bind:class="activeeditmodal">
			<div class="modal-background"></div>
			<div class="modal-card">
				<header class="modal-card-head">
					<p class="modal-card-title">Edit Post</p>
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
						<div :class="{ 'has-error': errors.has('description') }">
							<label class="control-label" for="description">Description : </label><br>
							<tinymce v-validate="'required'" v-model="description" :plugins="myPlugins" :toolbar1="myToolbar1" :toolbar2="myToolbar2" :other="myOtherOptions"></tinymce>
							<input type="file" name="image" id="upload" class="hidden" onchange="" style="display:none;">
							<span v-show="errors.has('description')">{{ errors.first('description') }}</span>         
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

		<div class="modal" v-bind:class="activeviewmodal">
			<div class="modal-background"></div>
			<div class="modal-card">
				<header class="modal-card-head">
					<p class="modal-card-title">Blog Post</p>
					<button class="delete" aria-label="close" v-on:click="deview"></button>
				</header>
				<section class="modal-card-body">
					
					<!-- Content ... -->
					<p> <strong>Title : </strong> {{title}} </p><br>
					<!-- <p> <strong>Admin Id : </strong> {{userId}} </p><br> -->
					<p> <strong>Date : </strong> {{ moment(date).format('LL') }} </p><br>
					 <p> <strong>Tag : </strong> <span class="tag" v-for="tag in tags">{{ tag.text }} </span> </p><br>
					<p> <strong>Description :</strong> <span v-html="description"></span>  </p><br>
					
					

				</section>
				<footer class="modal-card-foot">
					<button class="button" v-on:click="deview">Close</button>
				</footer>
			</div>
		</div>

		<div class="modal"  v-bind:class="activedeletemodal">
			<div class="modal-background"></div>
			<div class="modal-card">
				<header class="modal-card-head">
					<p class="modal-card-title">Delete Post</p>
					<button class="delete" aria-label="close" v-on:click="dedelete"></button>
				</header>
				<section class="modal-card-body">
					<!-- Content ... -->
					<p>Are you want to delete this post ?</p>
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
	import VueTagsInput from '@johmun/vue-tags-input';

	export default{
		components: {
        	'tinymce': VueEasyTinyMCE,
        	VueTagsInput
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
				activeeditmodal: '',
				activeviewmodal: '',
				activedeletemodal: '',

				title : '',
				description : '',
				date : '',

				userId : '',
				postId : '',
				index : '',
				cindrx:'',
				id:'',
				newpost : '',
				tag: '',
				tags: []
			}
		},
		methods:{
			highlight:function(value){
				return value.slice(0,100);
			},
			add:function(){
				this.activeaddmodal = 'is-active'
			},
			deadd:function(){
				this.activeaddmodal = ''
				this.title = ''
				this.description = ''
				this.tag = ''
				this.tags = ''
				this.$validator.reset()
				this.errors.clear()
			},
			validateBeforeSubmit() {
				var vm = this
				this.$validator.validateAll().then((result) => {
					if (result) {
						axios.post('/*/admin/blog/addpost', { 
							title : vm.title,
							description : vm.description,
							tags : vm.tags,
						}).then(response => {  
							vm.activeaddmodal = ''
							this.newpost = response.data
							this.title = ''
							this.description = ''
							this.tag = ''
							this.tags = []

							this.$validator.reset()
							this.errors.clear()
							this.$emit('add-post',this.newpost)
						})
						.catch( error  => {
							console.log(error);
						});
					}
				});
			},
			edit:function(index,items){
				var vm = this
				axios.post('/*/admin/blog/gettags', { 
					id : items.id 
				}).then(response => {  
					var data = response.data
					for (var i = 0; i < data.length; i++) {
						 vm.tags.push({text: data[i].tag_name}); 
					}
					this.activeeditmodal = 'is-active'
					this.cindex = index
					this.id = items.id
					this.title = items.title
					this.description = items.description

				})
				.catch( error  => {
					console.log(error);
				});
				
			},
			deedit:function(){
				this.title = ''
				this.description = ''
				this.tag = ''
				this.tags = []
				this.$validator.reset()
				this.errors.clear()
				this.activeeditmodal = ''
			},
			editvalidateBeforeSubmit() {
				var vm = this
				this.$validator.validateAll().then((result) => {
					if (result) {
						axios.post('/*/admin/blog/editpost', { 
							id : vm.id ,
							title : vm.title,
							description : vm.description,
							tags : vm.tags
						}).then(response => {  
							vm.activeeditmodal = ''
							this.title = ''
							this.description = ''
							this.tag = []
							this.tags.splice(0, 10);
							this.$validator.reset()
							this.errors.clear()
							this.$emit('edit-post',this.cindex,response.data);
						})
						.catch( error  => {
							console.log(error);
						});
					}
				});
			},
			view:function(post){
				var vm = this
				axios.post('/*/admin/blog/gettags', { 
					id : post.id 
				}).then(response => {  
					var data = response.data
					for (var i = 0; i < data.length; i++) {
						 vm.tags.push({text: data[i].tag_name}); 
					}					
					this.activeviewmodal = 'is-active'
					this.title = post.title
					this.description = post.description
					this.userId = post.admin_id
					this.date = post.created_at

				})
				.catch( error  => {
					console.log(error);
				});

				
			},
			deview:function(){
				this.title = ''
				this.description = ''
				this.tag = ''
				this.tags = []
				this.$validator.reset()
				this.errors.clear()
				this.activeviewmodal = ''
			},
			delete:function(index,id){
				this.activedeletemodal = 'is-active'
				this.postId = id
				this.index  = index
			},
			dedelete:function(){
				this.activedeletemodal = ''
			},
			deletequestion() {
				var vm = this
				axios.post('/*/admin/blog/deletepost', { 
					id : vm.postId
				}).then(response => {
					this.activedeletemodal = ''
					this.$emit('delete-post',this.index);
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

.modal-card-body span{
	margin-left: 10px;
}




</style>