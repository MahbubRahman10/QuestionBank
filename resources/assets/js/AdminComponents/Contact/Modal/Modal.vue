<template>
	<div>
		<div class="modal" v-bind:class="activeviewmodal">
			<div class="modal-background"></div>
			<div class="modal-card">
				<header class="modal-card-head">
					<p class="modal-card-title">Message</p>
					<button class="delete" aria-label="close" v-on:click="deview"></button>
				</header>
				<section class="modal-card-body">
					
					<!-- Content ... -->
					<p> <strong>Name : </strong> {{name}} </p><br>
					<p> <strong>Email : </strong> {{email}} </p><br>
					<p> <strong>Message : </strong> {{message}} </p><br>
					<p> <strong>Date : </strong> {{ moment(joinDate).format('LL') }} </p><br>
					<a v-on:click="sendmail" class="button is-primary is-outlined">Reply</a>

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
					<p class="modal-card-title">Delete Message</p>
					<button class="delete" aria-label="close" v-on:click="dedelete"></button>
				</header>
				<section class="modal-card-body">
					<!-- Content ... -->
					<p>Are you want to delete this message ?</p>
				</section>
				<footer class="modal-card-foot">
					<button type="submit" class="button is-danger" v-on:click="deletemessage">Delete</button>
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
				message : '',
				joinDate : '',

				d : '',
				index : ''
			}
		},
		methods:{
			
			view:function(message){
				this.activeviewmodal = 'is-active'
				this.name = message.name
				this.email = message.email
				this.message = message.message
				this.joinDate = message.created_at

				axios.post('/*/admin/contact-us/seenmessage', { 
					id : message.id
				}).then(response => {
					this.$emit('seen-message');
				})
				.catch( error  => {
					console.log(error);
				});
			},
			deview:function(){
				this.activeviewmodal = ''
			},
			delete:function(index,id){
				this.activedeletemodal = 'is-active'
				this.Id = id
				this.index  = index
			},
			dedelete:function(){
				this.activedeletemodal = ''
			},
			deletemessage() {
				var vm = this
				axios.post('/*/admin/contact-us/deletemessage', { 
					id : vm.Id
				}).then(response => {
					this.activedeletemodal = ''
					this.$emit('delete-message',this.index);
				})
				.catch( error  => {
					console.log(error);
				});
			},
			sendmail(){
				localStorage.setItem('email',this.email);
				this.$router.push({name : 'mailcompose'})
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