<template>
  <div>
    <Sidebar ref="toggle"></Sidebar>
    <Header v-on:click-toggle="toggle"></Header>

    <div class="main-contents" v-if="loading">
      <div class="columns">
        <div class="column is-one-quarter">
          <nav class="panel" id="panel">
            <p class="panel-heading">
             BD Question Archive
           </p>
          <!--  <div class="panel-block">
            <p class="control has-icons-left">
              <input class="input is-small" type="text" placeholder="search">
              <span class="icon is-small is-left">
                <i class="fa fa-search"></i>
              </span>
            </p>
          </div> -->
          <p class="panel-tabs">
            <router-link to="" class="is-active">Question Archive</router-link>
          </p>
          
          <router-link to="/admin/questionarchive/bcs" class="panel-block">
            <span class="panel-icon">
              <i class="fa fa-book"></i>
            </span>
            BCS
          </router-link>
          <router-link to="/admin/questionarchive/teacher" class="panel-block">
            <span class="panel-icon">
              <i class="fa fa-book"></i>
            </span>
            Teacher Requirement
          </router-link>
          <router-link to="/admin/questionarchive/bank" class="panel-block">
            <span class="panel-icon">
              <i class="fa fa-book"></i>
            </span>
            Bank Job
          </router-link>
          <router-link to="/admin/questionarchive/university" class="panel-block">
            <span class="panel-icon">
              <i class="fa fa-book"></i>
            </span>
            University
          </router-link>

        </nav>
      </div>
      <div class="column"  id="content-body">
        <div class="content-body header">
          <div class="columns is-desktop" d="columns-overview">
            <div class="column" >
              <span class="tags"> 
                <STRONG> {{ bcs }}  </STRONG><br>  
                BCS Question Solution
              </span>
            </div>
             <div class="column" >
              <span class="tags"> 
                <STRONG> {{ teacher }} </STRONG><br>  
                Teacher Requirement Question Solution
              </span>
            </div>
            <div class="column">
              <span class="tags"> 
                <STRONG> {{ bank }} </STRONG> <br>  
                Bank Job Question Solutionn
              </span>
            </div>
            <div class="column">
              <span class="tags"> 
                <STRONG>{{ university }}</STRONG> <br>  
                University Admission Question Solution
              </span>
            </div>
          </div>
          <div class="columns is-desktop" id="columns-overview">
            <pie-chart :chart-data="piedatacollection" :width="700"
            :height="250" id="pie" ></pie-chart> 
          </div>
        </div>
      </div>
    </div>
  </div>
  <vue-topprogress ref="topProgress"></vue-topprogress>
</div>
</template>

<script>

import Sidebar from './../../Sidebar.vue'
import Header from './../../Header.vue'
import { vueTopprogress } from 'vue-top-progress'
import Pie from './../../Charts/Pie.vue';

export default{


  components:{
    'Header' : Header,
    'Sidebar' : Sidebar ,
    vueTopprogress,
    'pie-chart' : Pie
  },
  head: {
    title: {
      inner: 'Archive Question'
    },
    meta: [

    ],
  },
  data(){
    return{
      loading : false,
      bcs : '',
      teacher : '',
      university : '',
      bank : '',
      piedatacollection : null
    }
  },
  methods:{
    quesdroptown:function(){
      var child = this.$refs.toggle;
      child.fdropmenu();
      
    },
    toggle:function(){
      var child = this.$refs.toggle;
      var click = child.toggles();
      if(click  == 'open') {
        $('.main-contents').animate({ 'margin-left': '240px' }, '1500');
      }
      else {
        $('.main-contents').animate({ 'margin-left': '10px' }, '1500');
      }i
    },
    getdata:function(){
      axios.get('/*/admin/questionsolve/index')
      .then( response => {  
        this.bcs = response.data.bcs
        this.teacher = response.data.teacher
        this.university = response.data.university
        this.bank = response.data.bank

        this.piedatacollection = {
          labels: ['bcs', 'university','bank', 'teacher'],
          datasets: [
          {

            backgroundColor: [
            "#FF6384",
            "#36A2EB",
            "#FFCE56",
            "#9B2020"
            ],
            hoverBackgroundColor: [
            "#FF6384",
            "#36A2EB",
            "#FFCE56",
            "#A74F07"
            ],
            data: [this.bcs, this.university, this.bank, this.teacher]
          }
          ]
        }
        var vm = this
        setTimeout(() => {
          vm.loading = true,
          vm.$refs.topProgress.done()
        }, 100)
      })
      .catch( error  => {
        console.log(error);
      }); 
    }

  },

  mounted(){
    this.$refs.topProgress.start()
    this.quesdroptown()
    this.getdata()
  }
}

</script>

<style scoped>

.main-contents{
  margin-top: 0;
  margin-left: 240px;
  position :relative;
}


.columns{
 width:100% ;
 padding:10px 20px;
}

#panel{
  background: white;
}

.panel-heading{
  font-weight: bold;
}

#content-body{
border-top-color: #dd4b39;
}

.tags{
  color: white;
}

.content-body.header{
  background: white;
  border-top: 3px solid red;
  border-top-color: #dd4b39;
  box-shadow: 0 1px 1px rgba(0,0,0,0.1);
}



.columns.is-desktop .column{
  background: #209cee;
  margin: 10px 10px; 
}


div#columns-overview .column{
  font-size: 20px;
  padding: 0px 10px;
  color: white;
  font-family: BlinkMacSystemFont, -apple-system, "Segoe UI", "Roboto", "Oxygen", "Ubuntu", "Cantarell", "Fira Sans", "Droid Sans", "Helvetica Neue", "Helvetica", "Arial", sans-serif;
}

strong {
    color: white;
    font-size: 40px;
    font-weight: 700;
}






/*  Mobile Version  */


@media (max-width:720px){

  .main-contents{
    width: 100%;
    margin-left: 10px;
  }

  .columns{
   width:100% ;
   padding:30px 10px;
 }


}

</style>