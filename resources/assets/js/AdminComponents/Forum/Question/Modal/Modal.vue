<template>
	<div>
		<div class="modal" v-bind:class="activeviewmodal">
			<div class="modal-background"></div>
			<div class="modal-card">
				<header class="modal-card-head">
					<p class="modal-card-title">Forum Question</p>
					<button class="delete" aria-label="close" v-on:click="deview"></button>
				</header>
				<section class="modal-card-body">
					
					<!-- Content ... -->
					<p> <strong>Title : </strong> {{title}} </p><br>
					<p> <strong>Category : </strong> {{category}} </p><br>
					<p> <strong>Description :</strong> <span v-html="highlight(description,truncate)"></span>  </p><br>
					<p> <strong>Uesr Id : </strong> {{userId}} </p><br>
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
				activeviewmodal: '',
				activedeletemodal: '',

				title : '',
				category : '',
				description : '',
				date : '',

				userId : '',
				questionId : '',
				index : ''
			}
		},
		methods:{
			highlight:function(value){
				return value.slice(0,100);
			},
			view:function(question){
				this.activeviewmodal = 'is-active'
				this.title = question.title
				this.category = question.category
				this.description = question.description
				this.userId = question.user_id
				this.date = question.created_at
			},
			deview:function(){
				this.activeviewmodal = ''
			},
			delete:function(index,id){
				this.activedeletemodal = 'is-active'
				this.questionId = id
				this.index  = index
			},
			dedelete:function(){
				this.activedeletemodal = ''
			},
			deletequestion() {
				var vm = this
				axios.post('/*/admin/forum/deletequestion', { 
					id : vm.questionId
				}).then(response => {
					this.activedeletemodal = ''
					this.$emit('delete-question',this.index);
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