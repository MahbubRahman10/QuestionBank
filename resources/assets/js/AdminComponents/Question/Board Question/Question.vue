<template>
  <div>
    <Sidebar ref="toggle"></Sidebar>
    <Header v-on:click-toggle="toggle"></Header>

    <div class="main-contents" v-if="loading">
      <div class="columns">
        <div class="column is-one-third">
          <nav class="panel" id="panel">
            <p class="panel-heading">
             Board Question
           </p>
          
          <p class="panel-tabs">
            <router-link to="" class="is-active">General</router-link>
            <router-link :to="{name:'madrasahboardjdcquestion'}">Madrasah</router-link>
          </p>
          <router-link v-for="items in boards" v-bind:to="'/admin/board/question/' + items.board_name.replace(/ /g, '-') + '/jsc'" class="panel-block" v-if="items.board_name != 'Madrasah Board'">
            <span class="panel-icon">
              <i class="fa fa-book"></i>
            </span>
            {{ items.board_name }}
          </router-link>
        </nav>
      </div>
      <div class="column"  id="content-body">
        <div class="content-body header">
          <div class="columns is-desktop" id="columns-overview">
            <div class="column" >
              <span class=""> 
                <STRONG>9</STRONG><br>  
                Board
              </span>
            </div>
            <div class="column">
              <span class=""> 
                <STRONG>{{ questions }}</STRONG> <br>  
                Questions
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
    'Sidebar' : Sidebar,
     vueTopprogress,
     'pie-chart' : Pie

  },
  head: {
    title: {
      inner: 'Board Question'
    },
    meta: [

    ],
  },
  data(){
    return{
            loading : false,

            boards: [], // Contain Board list
            questions : '',
            piedatacollection : null,
            label : '',
            datas : '',
            backcolor : '',
            hovcolor : ''
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
      }
    },

    // Get all boards
    getallboard:function(){
      axios.get('/*/admin/board/getAllboard')
      .then( response => {  
        var vm = this            
        // setTimeout(() => {
        //   vm.loading = true,
          vm.boards = response.data
        //   vm.$refs.topProgress.done()
        // }, 300)
      })
      .catch( error  => {
        console.log(error);
      });
    },
    getdata:function(){
      axios.get('/*/admin/questiondataboard')
      .then( response => {  
        this.mcq = response.data.mcq
        this.questions  = response.data.questions
        this.label = response.data.label
        this.datas = response.data.totals
        this.backcolor = response.data.backcolors
        this.hovcolor = response.data.hovcolors

        console.log(this.datas)
        this.piedatacollection = {
          labels: this.label,
          datasets: [
          {
            backgroundColor: this.backcolor,
            hoverBackgroundColor:  this.hovcolor,
            data: this.datas
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
    this.$refs.topProgress.start(),
    this.quesdroptown(),
    this.getallboard()
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












@media screen and (min-width: 769px){
  .column.is-one-third, .column.is-one-third-tablet {
   
    width: 28.3333%; 
  }
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