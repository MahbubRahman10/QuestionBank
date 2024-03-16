<template>
    <div>
        <Sidebar ref="toggle" ></Sidebar>
        <Header v-on:click-toggle="toggle"></Header>

        <div class="main-contents" v-if="loading">
            <div class="columns">
                <div class="column is-one-third">
                    <nav class="panel" id="panel">
                        <p class="panel-heading">
                            Question
                        </p>
                       <!--  <div class="panel-block" >
                            <p class="control has-icons-left">
                                <input class="input is-small" type="text" placeholder="search">
                                <span class="icon is-small is-left">
                                    <i class="fa fa-search"></i>
                                </span>
                            </p>
                        </div> -->
                        <!-- <p class="panel-tabs">
                            <router-link :to="{name:'bcsquestion'}">BCS</router-link>
                            <router-link :to="{name:'ntrcaquestion'}">NTRCA</router-link>
                            <router-link :to="{name:'dpequestion'}">DPE</router-link>
                            <router-link :to="{name:'bankquestion'}">BANK</router-link>
                        </p> -->
                        <!-- <router-link :to="{name:'bcsquestion'}"class="panel-block">
                            <span class="panel-icon">
                                <i class="fa fa-book"></i>
                            </span>
                            BCS -->
                        </router-link>
                        <router-link :to="{name:'ntrcaquestion'}"class="panel-block">
                            <span class="panel-icon">
                                <i class="fa fa-book"></i>
                            </span>
                            NTRCA
                        </router-link>
                        <router-link :to="{name:'dpequestion'}"class="panel-block">
                            <span class="panel-icon">
                                <i class="fa fa-book"></i>
                            </span>
                            DPE
                        </router-link>
                        <router-link :to="{name:'bankquestion'}"class="panel-block">
                            <span class="panel-icon">
                                <i class="fa fa-book"></i>
                            </span>
                            BANK
                        </router-link>
                    </nav>
                </div>
                <div class="column"  id="content-body">
                    <div class="content-body header">
                      <div class="columns is-desktop" id="columns-overview">
                        <div class="column" >
                          <span class=""> 
                            <STRONG>{{ subject }}</STRONG><br>  
                            Subjects
                          </span>
                        </div>
                        <div class="column">
                          <span class=""> 
                            <STRONG>{{ mcq }}</STRONG> <br>  
                            Question
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
        inner: 'Question'
      },
      meta: [

      ],
    },
    data(){
        return{
          loading : false,
          subject : '',
          mcq : '',
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
            }
        },
        getdata:function(){
          axios.get('/*/admin/questiondatamcq/req')
          .then( response => {  
            this.subject = response.data.subject
            this.mcq = response.data.mcq
            this.creative = response.data.creative

            this.piedatacollection = {
              labels: ['Subject' , 'MCQ'],
              datasets: [
              {

                backgroundColor: [
                "#FF6384",
                "#36A2EB",
                "#FFCE56"
                ],
                hoverBackgroundColor: [
                "#FF6384",
                "#36A2EB",
                "#FFCE56"
                ],
                data: [this.subject, this.mcq]
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
        this.quesdroptown()

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
 padding:10px 10px;
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