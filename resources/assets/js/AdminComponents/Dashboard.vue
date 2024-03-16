<template>
	<div>
		<Sidebar ref="toggle"></Sidebar>
		<Headers v-on:click-toggle="toggle"></Headers>
		<div class="main-contents" v-if="loading">

			<div id="linechart">
                <line-chart :chart-data="linedatacollection" :options="{responsive: true, maintainAspectRatio: false}"  id="line" :width="1000" :height="250"></line-chart>
            </div>
			
			<div class="columns">
				<div class="column is-half" id="piechart">
					<pie-chart :chart-data="piedatacollection" :width="450"
					:height="250" id="pie" ></pie-chart>
				</div>
				<div class="column is-half">
					<calendar  id="calendar"></calendar>
				</div>
			</div>
			<br><br><br>
		</div>
		<vue-topprogress ref="topProgress"></vue-topprogress>
	</div>
</template>

<script>
	
	import Sidebar from './Sidebar.vue'
	import Header from './Header.vue'
	import { vueTopprogress } from 'vue-top-progress'
	import calendar from 'vuejs-calendar';

	import Line from './Charts/Line.vue';
	import Pie from './Charts/Pie.vue';
	
	export default{


		components:{
			'Headers' : Header,
			'Sidebar' : Sidebar ,
			vueTopprogress,
			calendar,
			'line-chart':Line,
			'pie-chart':Pie
		},

		head: {
            title: {
                inner: 'Dashboard'
            },
            // Meta tags
            meta: [
               
            ],
        },

		data(){
			return{
				loading : false,
				linedata: [],
				linelabel: [],
				piedata : [],
				pielabel : [],
				linedatacollection: null,
				piedatacollection : null
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
			},
			linechart(){
				axios.get('/*/admin/chart/visitor')
				.then(response => {
					this.linedata = response.data.data
					this.linelabel = response.data.label
					this.linedatacollection = {
						labels: this.linelabel,
						datasets: [
						{
							label: 'Visitor',
							backgroundColor: '#48C9B0',
							data: this.linedata
						}
						]
					}
				})
			},
			piechart(){
				axios.get('/*/admin/chart/piedata')
				.then(response => {
					
					this.piedata = response.data
					console.log(this.piedata)
					this.pielabel = ['Blog','Forum Question','Question Set','Question Solution','User']
					this.piedatacollection = {
						labels: this.pielabel,
						datasets: [
						{
							backgroundColor: [
							"#FF6384",
							"#36A2EB",
							"#FFCE56",
							"#14726A",
							"#E5279B"
							],
							hoverBackgroundColor: [
							"#FF6384",
							"#36A2EB",
							"#FFCE56",
							"#14726A",
							"#E5279B"
							],
							data: [this.piedata.blog,this.piedata.forum,this.piedata.question,this.piedata.solution,this.piedata.user]
						}
						]
					}
				})

			}
		},

		mounted() {
           this.$refs.topProgress.start()
           var vm = this            
           setTimeout(() => {          	
           	vm.linechart()
           	vm.piechart()           	
           	vm.loading = true,
           	vm.$refs.topProgress.done() 
           }, 300)


        }
	}
	
</script>

<style scoped>
	


#smallheader{
	margin-top: 20px;
	margin-bottom:20px; 
}
.total{
	color:white;
	font-size: 24px;

}
#smallspan {
	color:white;
	font-size: 16px;
	font-weight: bold;
}







.main-contents{
	margin-top: -20px;
	margin-left: 240px;
	position :relative;
	
}


/* Line Chart */ 
#linechart{
    margin-bottom: 20px;
    background: white;
    margin-top: 30px;
    margin-right: 30px;
    padding: 30px 50px;
    border: 1px solid rgba(0,0,0,.15);
}
#line{
	width: 1000px;
	height: 250px;
}


/* Pie Chart */ 
#piechart{
	margin-top: 10px;
	margin-left: 11px;
    background: white;
    padding: 0px 0px;
    border: 1px solid rgba(0,0,0,.15);
}


/* Calender */ 
#calendar{
	width: 470px;
	height: 400px;
}







/*  Mobile Version  */


@media (max-width:720px){

	.main-contents{
		width: 100%;
		margin-left: 10px;
	}
	.column.is-one-third {
		padding: 30px 0px;
	}

}

</style>