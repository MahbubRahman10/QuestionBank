<template>
	<div>
		<div class="modal" v-bind:class="activeviewmodal">
			<div class="modal-background"></div>
			<div class="modal-card">
				<header class="modal-card-head">
					<p class="modal-card-title">Forum Replies</p>
					<button class="delete" aria-label="close" v-on:click="deview"></button>
				</header>
				<section class="modal-card-body">
					
					<!-- Content ... -->
					<p> <strong>Name : </strong> {{name}} </p><br>
					<p> <strong>Reply : </strong> <span v-html="reply"></span>  </p><br>
					<p> <strong>Like : </strong> {{like}} </p><br>
					<p> <strong>Uesr Id : </strong> {{userId}} </p><br>
					<p> <strong>Forum Id : </strong> {{forumId}} </p><br>
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
					<p class="modal-card-title">Delete Reply</p>
					<button class="delete" aria-label="close" v-on:click="dedelete"></button>
				</header>
				<section class="modal-card-body">
					<!-- Content ... -->
					<p>Are you want to delete this reply ?</p>
				</section>
				<footer class="modal-card-foot">
					<button type="submit" class="button is-danger" v-on:click="deletereply">Delete</button>
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
				reply : '',
				like : '',
				date : '',

				forumId : '',
				userId : '',
				index : '',
				replyId : ''
			}
		},
		methods:{
			highlight:function(value){
				return value.slice(0,100);
			},
			view:function(reply){
				this.activeviewmodal = 'is-active'
				this.name = reply.name
				this.reply = reply.description
				this.like = reply.Like
				this.userId = reply.user_id
				this.forumId = reply.forum_id
				this.date = reply.created_at
			},
			deview:function(){
				this.activeviewmodal = ''
			},
			delete:function(index,id){
				this.activedeletemodal = 'is-active'
				this.replyId = id
				this.index  = index
			},
			dedelete:function(){
				this.activedeletemodal = ''
			},
			deletereply() {
				var vm = this
				axios.post('/*/admin/forum/deletereply', { 
					id : vm.replyId
				}).then(response => {
					this.activedeletemodal = ''
					this.$emit('delete-reply',this.index);
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