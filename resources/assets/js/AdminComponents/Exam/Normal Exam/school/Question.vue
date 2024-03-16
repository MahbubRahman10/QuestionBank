<template>
  <div>
    <Sidebar ref="toggle" ></Sidebar>
    <Header v-on:click-toggle="toggle"></Header>
   
    <div class="main-contents" v-if="loading">
      <div class="columns">
        <div class="column is-one-quarter">        
          <nav class="panel" id="panel">
            <p class="panel-heading">
              Exam
            </p>
            <div class="panel-block">
              <p class="control has-icons-left">
                <input class="input is-small" type="text" placeholder="search">
                <span class="icon is-small is-left">
                  <i class="fa fa-search"></i>
                </span>
              </p>
            </div>
            <p class="panel-tabs">
              <router-link to="" class="is-active">School</router-link>
              <router-link :to="{name:'madrasahexam'}">Madrasah</router-link>
            </p>
            <router-link :to="{name:'class6exam'}" class="panel-block">
              <span class="panel-icon">
                <i class="fa fa-book"></i>
              </span>
              Class 6
            </router-link>
            <router-link :to="{name:'class7exam'}"class="panel-block">
              <span class="panel-icon">
                <i class="fa fa-book"></i>
              </span>
              Class 7
            </router-link>
            <router-link :to="{name:'class8exam'}" class="panel-block">
              <span class="panel-icon">
                <i class="fa fa-book"></i>
              </span>
              Class 8
            </router-link>
            <router-link :to="{name:'class9exam'}" class="panel-block">
              <span class="panel-icon">
                <i class="fa fa-book"></i>
              </span>
              Class 9-10
            </router-link>
            <router-link :to="{name:'class11exam'}" class="panel-block">
              <span class="panel-icon">
                <i class="fa fa-book"></i>
              </span>
              Class 11-12
            </router-link>
          </nav>
        </div>
        <div class="column"  id="content-body">
          <div class="content-body header">
            <div class="columns is-desktop" id="columns-overview">
              <div class="column" >
                <span class=""> 
                  <STRONG>8</STRONG><br>  
                  General Board
                </span>
              </div>
              <div class="column">
                <span class=""> 
                  <STRONG>8</STRONG> <br>  
                  General Board
                </span>
              </div>
              <div class="column">
                <span class=""> 
                  <STRONG>8</STRONG> <br>  
                  General Board
                </span>
              </div>
            </div>
              <div class="columns is-desktop" id="columns-overview">
              <div class="column" >
                <span class=""> 
                  <STRONG>8</STRONG><br>  
                  General Board
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <vue-topprogress ref="topProgress"></vue-topprogress>
  </div>
</template>

<script>

import Sidebar from './../../../Sidebar.vue'
import Header from './../../../Header.vue'
import { vueTopprogress } from 'vue-top-progress'

export default{


  components:{
    'Header' : Header,
    'Sidebar' : Sidebar,
    vueTopprogress 
  },

  data(){
    return{
      loading : false
    }
  },
  methods:{
    examdroptown:function(){
      var child = this.$refs.toggle;
      child.edropmenu();
      
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
    }
  },

  mounted(){
    this.$refs.topProgress.start()
    var vm = this            
    setTimeout(() => {
      vm.loading = true,
      vm.$refs.topProgress.done()
    }, 500)
    this.examdroptown()
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