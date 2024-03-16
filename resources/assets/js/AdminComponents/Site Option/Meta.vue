<template>
	<div>
		<Sidebar ref="toggle"></Sidebar>
		<Header v-on:click-toggle="toggle"></Header>
		
		<div class="main-contents" v-if="loading">
			<div class="columns">
				<div class="column is-one-quarter">
					<nav class="panel" id="panel">
						<p class="panel-heading">
							Site Option 
						</p>
						<router-link :to="{name : 'sitetitle'}" class="panel-block">
							<span class="panel-icon">
								<i class="fa fa-book"></i>
							</span>
							Title
						</router-link>
						<router-link to=" " class="panel-block is-active">
							<span class="panel-icon">
								<i class="fa fa-book"></i>
							</span>
							Meta
						</router-link>
						<router-link :to="{name : 'admintheme'}" class="panel-block">
							<span class="panel-icon">
								<i class="fa fa-book"></i>
							</span>
							Dashboard Theme
						</router-link>
						<router-link :to="{name : 'sitesocial'}" class="panel-block">
							<span class="panel-icon">
								<i class="fa fa-book"></i>
							</span>
							Social
						</router-link>
						<router-link :to="{name : 'sitefooter'}" class="panel-block">
							<span class="panel-icon">
								<i class="fa fa-book"></i>
							</span>
							Footer
						</router-link>
					</nav>
				</div>
				<div class="column"  id="content-body">
					<div class="content-body header">
						


					</div>
				</div>
			</div>
		</div>
		<vue-topprogress ref="topProgress"></vue-topprogress>
	</div>
</template>

<script>

import Sidebar from './../Sidebar.vue'
import Header from './../Header.vue'
import { vueTopprogress } from 'vue-top-progress'

export default{


	components:{
		'Header' : Header,
		'Sidebar' : Sidebar ,
		vueTopprogress
	},

	data(){
		return{
			loading : false,
			items: [
				{ q1: 'Foo' }
			]
		}
	},
	methods:{

		toggle:function(){
			var child = this.$refs.toggle;
			var click = child.toggles();
			if(click  == 'open') {
				$('.main-contents').animate({ 'margin-left': '240px' }, '1500');
			}
			else {
				$('.main-contents').animate({ 'margin-left': '10px' }, '1500');
			}
			
		}
	},

	mounted(){
		this.$refs.topProgress.start()
		var vm = this
		setTimeout(() => {
			vm.loading = true,
			vm.$refs.topProgress.done()
		}, 100)
	}
}

</script>

<style scoped>

/* Main Content */
.main-contents{
	margin-top: 0;
	margin-left: 240px;
}

/* Column : -  */
.columns{
	width:100% ;
	padding:10px 10px;
}

/* Panel */
#panel{
  background: white;
}

/* Content Body */
#content-body{
border-top-color: #dd4b39;
}

/* Content Body Header */
.content-body.header{
  background: white;
  border-top: 3px solid red;
  border-top-color: #dd4b39;
  box-shadow: 0 1px 1px rgba(0,0,0,0.1);
}





/*  Mobile Version  */

@media (max-width:720px){

	.main-contents{
		width: 100%;
		margin-left: 10px;
	}

	.columns{
		width:100% ;
		padding:30px 20px;
	}


}

</style>