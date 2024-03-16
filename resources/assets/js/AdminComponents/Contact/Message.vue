<template>
  <div>
    <Sidebar ref="toggle"></Sidebar>
    <Header v-on:click-toggle="toggle"></Header>
    <Modal ref="modal" v-on:delete-message="afterdeletemessage" v-on:seen-message="seenmessage"></Modal>
    
    <div class="main-contents" v-if="loading">
      <div class="notifications" > 
        <span v-if="notify">message {{msg}} Successfuly</span>
      </div>
      <div class="columns">
        <div class="column" >
          <div class="content" style="background:;border:1px solid #209cee;">
            <div class="content-heading">
              <span class=" is-left"> Message </span>
            </div>
            <div class="info">
              <table>
                <thead>
                  <th>S.N</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Actions</th>
                </thead>
                <tbody>
                  <tr v-for="(message,index) in getmessages" v-if="message.status == 1">
                      <td>{{index +1}}</td>
                      <td>{{message.name}}</td>
                      <td>{{message.email}}</td>
                      <td>
                        <a class="icon is-size-5 has-text-info" v-on:click="view(index)"><i class="fa fa-eye" aria-hidden="true"></i></a>
                        <a class="icon is-size-5 has-text-danger" v-on:click="deletes(index)"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                      </td>
                  </tr>
                  <tr v-else style="background:#eee;">
                      <td>{{index +1}}</td>
                      <td>{{message.name}}</td>
                      <td>{{message.email}}</td>
                      <td>
                        <a class="icon is-size-5 has-text-info" v-on:click="view(index)"><i class="fa fa-eye" aria-hidden="true"></i></a>
                        <a class="icon is-size-5 has-text-danger" v-on:click="deletes(index)"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                      </td>
                  </tr>
                </tbody>
              </table>
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
import Modal from './Modal/Modal.vue'
import { vueTopprogress } from 'vue-top-progress'

export default{


  components:{
    'Header' : Header,
    'Sidebar' : Sidebar ,
    'Modal' : Modal ,
    vueTopprogress
  },
  head: {
    title: {
      inner: 'Message'
    },
    meta: [

    ],
  },
  data(){
    return{
      loading : false,
      getmessages : [],

      notify : false,
      msg : ''
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
    getmessage:function() {
      var vm = this
      axios.get('/*/admin/contact-us/getmessage')
      .then( response => {  
        this.getmessages = response.data.contact
        // this.seen = response.data.seen
        setTimeout(() => {
          vm.loading = true,
          vm.$refs.topProgress.done()
        }, 1000)
      })
      .catch( error  => {
        console.log(error);
      }); 
    },

    view:function(value){
      var child = this.$refs.modal;
      var click = child.view(this.getmessages[value]);
    },
    deletes:function(value){
      var child = this.$refs.modal;
      var click = child.delete(value,this.getmessages[value].id);
    },
    // Show notification after delete
    afterdeletemessage:function(index) {
      this.$delete(this.getmessages,index)
      this.notify = true;
      this.msg = 'deleted'
      var sel = this
      setTimeout(function() { sel.notify = false }, 5000)
    },
    seenmessage:function() {
      this.getmessage() 
    }

  },

  mounted(){
  
    this.$refs.topProgress.start()
    this.getmessage()
  
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


.content-heading{
  background:#209cee;
  padding:10px 10px;
  color:white;
}

.create{
  padding: 5px 8px;
  background: white;
  color: black;
  border-radius: 3px;
  font-size:18px;
  font-weight:bold;
  border-color: white;
}

.create i{
  padding: 6px 5px;
  
}



.info{
  padding:10px 10px;
  background: white;
}

table{
  border: 1px solid #ddd
}

table thead th{
  border: 1px solid #ddd
}
table td{
  border: 1px solid #ddd
}
table tr{
  border: 1px solid #ddd
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