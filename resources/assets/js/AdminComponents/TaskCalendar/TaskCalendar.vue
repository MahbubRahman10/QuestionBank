<template>
    <div>
        <Sidebar ref="toggle" ></Sidebar>
        <Header v-on:click-toggle="toggle"></Header>
       
        <div class="notifications" > 
            <span v-if="notify">Event {{msg}} Successfuly</span>
        </div>
        <div class="main-contents" v-if="loadings">
                
             <vue-event-calendar :events="demoEvents" @day-changed="handleDayChanged" >
                <template scope="props">
                    <h1 class="activedate"><span>{{ activedate }}</span></h1>
                    <h1 class="addevent" v-if="admin.role == 'Super Admin'"><a class="button is-info" @click="add()" style="text-align:center;" >Add New Event</a></h1>
                    <div v-if="events == ''">
                        <div v-if="showdatas">
                            <h1 class="eventdata" v-if="today === activedate">No Event Today</h1>
                            <h1 class="eventdata" v-else>No Event on {{ activedate }}</h1>
                        </div>
                    </div>
                    <div v-else>
                        <div v-for="(event, index) in events" class="event-item">
                          <!-- In here do whatever you want, make you owner event template -->
                          <div class="wrapper">
                            <h3 class="title">{{ index+1 }}. {{ event.event_title }} <a v-if="admin.role == 'Super Admin'" @click="edit(index)"><i class="fa fa-pencil" style="margin-left:10px;"></i></a>   <a v-if="admin.role == 'Super Admin'" v-on:click="deletes(index)"><i class="fa fa-trash" style="margin-left:5px;"></i></a>  </h3> 
                            <p class="time">{{ event.date }}</p> 
                            <p class="desc" v-html="event.event_description">  </p></div>
                        </div>
                    </div>
              </template>
             </vue-event-calendar>


             <div class="modal" v-bind:class="activeaddmodal">
                <div class="modal-background"></div>
                <div class="modal-card">
                    <header class="modal-card-head">
                        <p class="modal-card-title">Add New Event Task</p>
                        <button class="delete" aria-label="close" v-on:click="deadd"></button>
                    </header>
                    <section class="modal-card-body">
                        <!-- Content ... -->
                        <form @submit.prevent="">
                            <div :class="{ 'has-error': errors.has('eventdate') }">
                                <label class="control-label" for="eventdate">Date : </label><br>
                                <input v-validate="'required'" v-model="eventdate" type="date" name="date" class="input">
                                <span v-show="errors.has('eventdate')">{{ errors.first('eventdate') }}</span>         
                            </div>
                            <br>

                            <div :class="{ 'has-error': errors.has('eventtitle') }">
                                <label class="control-label" for="eventtitle">Event Title : </label><br>
                                <input v-validate="'required'" v-model="eventtitle" type="text" name="eventtitle" class="input">
                                <span v-show="errors.has('eventtitle')">{{ errors.first('eventtitle') }}</span>         
                            </div>
                            <br>


                            <div :class="{ 'has-error': errors.has('eventdescription') }">
                                <label class="control-label" for="eventdescription">Event Description : </label><br>
                                <tinymce v-validate="'required'" v-model="eventdescription" :plugins="myPlugins" :toolbar1="myToolbar1" :toolbar2="myToolbar2" :other="myOtherOptions"></tinymce>
                                <input type="file" name="image" id="upload" class="hidden" onchange="" style="display:none;">      
                            </div>


                            <br>
                        </form>
                    </section>
                    <footer class="modal-card-foot">                    
                        <button type="submit" class="button is-success" v-on:click="validateBeforeSubmit">Submit</button>
                        <button class="button" v-on:click="deadd">Cancel</button>
                    </footer>
                </div>
            </div>

        <div class="modal"  v-bind:class="activeeditmodal">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Edit Event</p>
                    <button class="delete" aria-label="close" v-on:click="deedit"></button>
                </header>
                <section class="modal-card-body">
                    <!-- Content ... -->
                    <form @submit.prevent="">

                        <div :class="{ 'has-error': errors.has('eventdate') }">
                            <label class="control-label" for="eventdate">Date : </label><br>
                            <input v-validate="'required'" v-model="eventdate" type="date" name="date" class="input">
                            <span v-show="errors.has('eventdate')">{{ errors.first('eventdate') }}</span>         
                        </div>
                        <br>

                        <div :class="{ 'has-error': errors.has('eventtitle') }">
                            <label class="control-label" for="eventtitle">Event Title : </label><br>
                            <input v-validate="'required'" v-model="eventtitle" type="text" name="eventtitle" class="input">
                            <span v-show="errors.has('eventtitle')">{{ errors.first('eventtitle') }}</span>         
                        </div>
                        <br>
                        <div :class="{ 'has-error': errors.has('eventdescription') }">
                            <label class="control-label" for="eventdescription">Event Description : </label><br>
                            <tinymce v-validate="'required'" v-model="eventdescription" :plugins="myPlugins" :toolbar1="myToolbar1" :toolbar2="myToolbar2" :other="myOtherOptions"></tinymce>
                            <input type="file" name="image" id="upload" class="hidden" onchange="" style="display:none;">      
                        </div>
                        <br>
                    </form>

                </section>
                <footer class="modal-card-foot">
                    <button class="button is-success" v-on:click="editvalidateBeforeSubmit">Save changes</button>
                    <button class="button" v-on:click="deedit">Cancel</button>
                </footer>
            </div>
        </div>
        <div class="modal"  v-bind:class="activedeletemodal">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Delete Event</p>
                    <button class="delete" aria-label="close" v-on:click="dedelete"></button>
                </header>
                <section class="modal-card-body">
                    <!-- Content ... -->
                    <p>Are you want to delete this Event ?</p>
                </section>
                <footer class="modal-card-foot">
                    <button type="submit" class="button is-danger" v-on:click="deleteevent">Delete</button>
                    <button class="button" v-on:click="dedelete">Cancel</button>
                </footer>
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

// Tinymce
var VueEasyTinyMCE = require('vue-easy-tinymce');
window.moment = require('moment');

export default{

    
    components:{
        'Header' : Header,
        'Sidebar' : Sidebar,
        vueTopprogress,
        'tinymce': VueEasyTinyMCE
    },
    head: {
        title: {
            inner: 'Event'
        },
        meta: [

        ],
    },

    data(){
        return{
            myPlugins : [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern'
            ],
            myToolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            myToolbar2: "print preview media | forecolor backcolor emoticons",
            myOtherOptions : {
                image_advtab: true,
                file_picker_callback: function(callback, value, meta) {
                    if (meta.filetype == 'image') {
                        $('#upload').trigger('click');
                        $('#upload').on('change', function() {
                            var file = this.files[0];
                            var reader = new FileReader();
                            reader.onload = function(e) {
                                callback(e.target.result, {
                                    alt: ''
                                });
                            };
                            reader.readAsDataURL(file);
                        });
                    }
                }
            },

            activeaddmodal: '',
            activeeditmodal: '',
            activedeletemodal: '',

            loadings : false,
            events: [],
            activedate:'',
            today:'',
            date : '',
            id : '',
            index : '',
            eventdate : '',
            eventtitle : '',
            eventdescription : '',
            admin : '',

            showdatas : false,
            notify : false,  // notification after CRUD
            msg: ''         // show messge in notification
        }
    },
    methods:{
        getadmin:function() {
            axios.get('/*/admin/getadmin')
            .then( response => {  
                this.admin = response.data
            })
            .catch( error  => {
                console.log(error);
            }); 
        },
        add:function(id){
            this.activeaddmodal = 'is-active'
            this.clasubid = id
        },
        deadd:function(){
            this.eventdate = ''
            this.eventtitle = ''
            this.eventdescription = ''
            this.errors.clear()
            this.$validator.reset()
            this.activeaddmodal = ''
        },
        validateBeforeSubmit() {
            var vm = this            
            this.$validator.validateAll().then((result) => {
                if (result) {
                    axios.post('/*/admin/events/add', { 
                        date : vm.eventdate ,
                        title : vm.eventtitle ,
                        description : vm.eventdescription ,
                    }).then(response => {  
                        this.eventdate = ''
                        this.eventtitle = ''
                        this.eventdescription = ''
                        this.errors.clear()
                        this.$validator.reset()
                        vm.activeaddmodal = ''
                        this.events.unshift(response.data);
                        this.notify = true;
                        this.msg = 'created'
                        var sel = this
                        setTimeout(function() { sel.notify = false }, 5000)
                    })
                    .catch( error  => {
                        console.log(error);
                    });
                }
            });
        },
        edit:function(index){
            this.activeeditmodal = 'is-active'
            this.index = index
            this.id = this.events[index].id
            this.eventdate  = this.events[index].date
            this.eventtitle  = this.events[index].event_title
            this.eventdescription  = this.events[index].event_description
        },
        deedit:function(){
            this.eventdate = ''
            this.eventtitle = ''
            this.eventdescription = ''
            this.errors.clear()
            this.$validator.reset()
            this.activeeditmodal = ''
        },
        editvalidateBeforeSubmit() {
                var vm = this
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        axios.post('/*/admin/events/edit', { 
                            id : vm.id ,
                            date : vm.eventdate ,
                            title : vm.eventtitle ,
                            description : vm.eventdescription ,
                        }).then(response => {  
                            this.eventdate = ''
                            this.eventtitle = ''
                            this.eventdescription = ''
                            this.errors.clear()
                            this.$validator.reset()
                            vm.activeeditmodal = ''
                            this.$set(this.events, this.index, response.data)
                            this.notify = true
                            this.msg = 'updated'
                            var sel = this
                            setTimeout(function() { sel.notify = false }, 5000)
                        })
                        .catch( error  => {
                            console.log(error);
                        });
                    }
                });
            },
        deletes:function(index){
            this.activedeletemodal = 'is-active'
            this.id = this.events[index].id
            this.index = index
        },
        dedelete:function(){
            this.activedeletemodal = ''
        },
        deleteevent() {
            var vm = this
            axios.post('/*/admin/events/delete', { 
                id : vm.id
            }).then(response => {
                this.activedeletemodal = ''
                this.$delete(this.events,this.index)
                this.notify = true;
                this.msg = 'deleted'
                var sel = this
                setTimeout(function() { sel.notify = false }, 5000)
            })
            .catch( error  => {
                console.log(error);
            });
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
        handleDayChanged:function(event) {
            this.showdatas = false
            this.activedate = moment(event.date).format('Do MMMM YYYY')
            this.getevent(event.date)
        },
        getevent:function(date){
            axios.post('/*/admin/events', { 
                date : date
            }).then(response => {  
                this.events = response.data
                this.showdatas = true
            })
            .catch( error  => {
                console.log(error);
            });
        }
    },

    mounted(){
        this.activedate = moment().format('Do MMMM YYYY')
        this.today = moment().format('Do MMMM YYYY')
        this.date = "current"
        this.getevent(this.date)
        this.getadmin()
        this.$refs.topProgress.start(),
        setTimeout(() => {
            this.loadings = true,
            this.$refs.topProgress.done()
        }, 500)
    }
}

</script>

<style scoped>
/* notifications after CRUD */
.notifications{
    text-align: center;
    margin-top: 10px;
    margin-left:10%;
}
.notifications span{
    background: #5f5f5f;
    color: #ffffff;
    font-size: 17px;
    border: 1px solid #cccccc;
    font-family: Verdana,sans-serif;
    padding: 5px 14px 10px 10px;
    overflow: visible;
    border-radius: 6px;
}

.main-contents{
    margin-top: 0;
    margin-left: 240px;
    position :relative;
}

.cal-wrapper{
    background: white;
}
.addevent{
    text-align:  center;
    font-weight: bold;
    font-size: 18px;
    margin-bottom: 20px;
}
.eventdata{
    background: #33AF73;
    padding: 10px 10px;
    text-align: center;
    font-size: 20px;
    font-weight: bold;
    margin-top: 20px;
}
.activedate{
    font-weight: bold;
    text-align: center;  
    margin-bottom: 20px;
}
.activedate span{
    background: #0D95B2; 
    font-size:20px;
    border-color: #0D6C80;
    padding: 10px;
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