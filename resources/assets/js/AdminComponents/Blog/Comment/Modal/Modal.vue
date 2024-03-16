<template>
	<div>
		<div class="modal" v-bind:class="activeviewmodal">
			<div class="modal-background"></div>
			<div class="modal-card">
				<header class="modal-card-head">
					<p class="modal-card-title">Blog Post Comment</p>
					<button class="delete" aria-label="close" v-on:click="deview"></button>
				</header>
				<section class="modal-card-body">
					
					<!-- Content ... -->
					<p> <strong>Name : </strong> {{name}} </p><br>
					<p> <strong>Email : </strong> {{email}} </p><br>
					<p> <strong>comment : </strong> {{comment}} </p><br>
					<p> <strong>Forum Id : </strong> {{postId}} </p><br>
					<p> <strong>Date : </strong> {{ moment(date).format('LL') }} </p><br>

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
					<p class="modal-card-title">Delete Comment</p>
					<button class="delete" aria-label="close" v-on:click="dedelete"></button>
				</header>
				<section class="modal-card-body">
					<!-- Content ... -->
					<p>Are you want to delete this comment ?</p>
				</section>
				<footer class="modal-card-foot">
					<button type="submit" class="button is-danger" v-on:click="deletecomment">Delete</button>
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
				activeviewmodal: '',
				activedeletemodal: '',

				name : '',
				email : '',
				comment : '',
				date : '',

				postId : '',
				userId : '',
				index : '',

				commentId:''
			}
		},
		methods:{
			highlight:function(value){
				return value.slice(0,100);
			},
			view:function(comment){
				this.activeviewmodal = 'is-active'
				this.name = comment.name
				this.email = comment.email
				this.comment = comment.description
				this.userId = comment.user_id
				this.postId = comment.blog_id
				this.date = comment.created_at
			},
			deview:function(){
				this.activeviewmodal = ''
			},
			delete:function(index,id){
				this.activedeletemodal = 'is-active'
				this.commentId = id
				this.index  = index
			},
			dedelete:function(){
				this.activedeletemodal = ''
			},
			deletecomment() {
				var vm = this
				axios.post('/*/admin/blog/deletecomment', { 
					id : vm.commentId
				}).then(response => {
					this.activedeletemodal = ''
					this.$emit('delete-comment',this.index);
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