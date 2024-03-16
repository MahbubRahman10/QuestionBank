<template>
  <div>
    <Sidebar ref="toggle" ></Sidebar>
    <Header v-on:click-toggle="toggle"></Header>

    <div class="main-contents" v-if="loading">
      <div class="columns">
        <div class="column is-one-third">
          <nav class="panel" id="panel">
            <p class="panel-heading">
             Forum
           </p>
          <router-link :to="{name:'forumquestion'}" class="panel-block">
            <span class="panel-icon">
              <i class="fa fa-book"></i>
            </span>
            Question
          </router-link>
          <router-link :to="{name:'forumreply'}" class="panel-block">
            <span class="panel-icon">
              <i class="fa fa-book"></i>
            </span>
            Reply
          </router-link>
          <router-link :to="{name:'forumcategory'}" class="panel-block">
            <span class="panel-icon">
              <i class="fa fa-book"></i>
            </span>
            Category
          </router-link>
        </nav>
      </div>
      <div class="column"  id="content-body">
        <div class="content-body header">
          <div class="columns is-desktop" id="columns-overview">
            <div class="column" >
              <span class=""> 
                <STRONG> {{ category }} </STRONG><br>  
                Categories
              </span>
            </div>
            <div class="column">
              <span class=""> 
                <STRONG> {{ question }}</STRONG> <br>  
                Question
              </span>
            </div>
            <div class="column">
              <span class=""> 
                <STRONG>{{  reply }}</STRONG> <br>  
                Reply
              </span>
            </div>
          </div>
            <div class="columns is-desktop" id="columns-overview">
            
              <doughnut-chart :chart-data="doughnutdatacollection" :options="{responsive: true, maintainAspectRatio: false}"  id="line" :width="700" :height="250"></doughnut-chart>

          </div>
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
import Doughnut from './../Charts/Doughnut.vue';

export default{


  components:{
    'Header' : Header,
    'Sidebar' : Sidebar ,
    vueTopprogress,
    'doughnut-chart':Doughnut,
  },

  head: {
    title: {
      inner: 'Forum'
    },
    meta: [

    ],
  },

  data(){
    return{
      loading : false,
      category : '',
      reply : '',
      question : '',
      visitor : '',
      doughnutdatacollection: null
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
    getdata:function(){
      axios.get('/*/admin/forum')
      .then( response => {  
        this.question = response.data.forum
        this.reply = response.data.reply
        this.category = response.data.category
        this.visitor = response.data.visitor

        this.doughnutdatacollection = {
            labels: ['Visitor', 'Category', 'Question', 'Reply'],
            datasets: [
            {
              label: 'Forum',
              backgroundColor: [
              "#FF6384",
              "#36A2EB",
              "#2d2d2d",
              "#FFCE56"
              ],
              data: [this.visitor, this.category, this.question, this.reply],
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