<template>
    <div>
     <Sidebar ref="toggle"></Sidebar>
     <Headers v-on:click-toggle="toggle"></Headers>


    <div class="main-contents">
            <div class="columns">
                <div class="column is-one-quarter">
                    <nav class="panel" id="panel">
                        <p class="panel-heading">
                            <router-link :to="{name : 'mailcompose'}" class="mailcompose"> Compose </router-link>
                        </p>
                       <!--  <div class="panel-block">
                            <p class="control has-icons-left">
                                <input class="input is-small" type="text" placeholder="Search Mail">
                                <span class="icon is-small is-left">
                                    <i class="fa fa-search"></i>
                                </span>
                            </p>
                        </div> -->
                        <p class="panel-tabs">
                           
                        </p>
                        <router-link :to="{name :'mail'}" class="panel-block is-active">
                            <span class="panel-icon">
                                <i class="fa fa-inbox"></i>
                            </span>
                            Inbox<span v-show="showunread"> ({{ unread }})</span>
                        </router-link>
                        <router-link :to="{name :'mailsent'}" class="panel-block">
                            <span class="panel-icon">
                                <i class="fa fa-envelope-o"></i>
                            </span>
                            Sent
                        </router-link>
                        <router-link :to="{name :'maildraft'}" class="panel-block">
                            <span class="panel-icon">
                                <i class="fa fa-file-text-o"></i>
                            </span>
                            Draft(s)
                        </router-link>
                        <!-- <router-link :to="{name :'mailimportant'}" class="panel-block">
                            <span class="panel-icon">
                                <i class="fa fa-envelope"></i>
                            </span>
                            Important
                        </router-link> -->
                        <router-link :to="{name :'mailtrash'}" class="panel-block">
                            <span class="panel-icon">
                                <i class="fa fa-trash-o"></i>
                            </span>
                            Trash
                        </router-link>
                    </nav>
                </div>


                <div class="column is-three-quarters">                    
                    <div class="content" style="">
                        <div class="content-heading">
                            <span class=" is-left"> </span>
                            <span>
                                <a class="button is-ligh" v-on:click="deletemsg"> <i class="fa fa-trash" aria-hidden="true"></i> </a>
<!--                                 <a class="button is-ligh" > <i class="fa fa-bookmark" aria-hidden="true"></i> </a> -->
                                <span v-show="loading" class="loading">Loading..</span>
                            </span>
                        </div>
                        <div  class="loader" v-if="loaders"></div> <br v-if="loaders"><br v-if="loaders">
                        <div class="info" v-show="showing">
                             <div  v-html="data"></div>
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

    export default {

        components:{
            'Headers' : Header,
            'Sidebar' : Sidebar,
            vueTopprogress  
        },
        head: {
            title: {
                inner: 'Inbox Message'
            },
            meta: [

            ],
        },
        data(){
            return{
                buttonselect: false,
                id :  this.$route.params.id,
                subject : '',
                data : '',
                loading : false,
                unread : '',
                showunread : false,

                showing : false,     // Showing Data after load
                loaders : true       // Showing snippet when load
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
           
            deletemsg:function() {
                this.loading = true
                axios.get('/*/admin/mail/inbox/trash/' + this.subject)
                 .then(response => {
                    this.$router.push({name : 'mail'})
                })
                 .catch( error  => {
                    console.log(error);
                });
            }
           
        },
        mounted() {

             this.$refs.topProgress.start(),
            setTimeout(() => {
                this.$refs.topProgress.done()
            }, 1500)

            this.subject = this.id.replace(/-/g, ' ').replace(/~/g, '-')
            axios.get('/*/admin/mail/inbox/view/' + this.subject)
            .then(response => {
                this.data = response.data.inbox
                if(response.data.unread != '0') {
                    this.unread = response.data.unread
                    this.showunread = true
                }
                this.loaders = false,
                this.showing = true
            })
            .catch( error  => {
                console.log(error);
            });
        }
    }
</script>

<style scoped>
    
.loader {

    margin: 100px 350px;
    border: 10px solid #f3f3f3; /* Light grey */
    border-top: 10px solid #3498db; /* Blue */
    border-radius: 50%;
    width: 100px;
    height: 100px;
    animation: spin 2s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}


    
.main-contents{
    margin-top: 0;
    margin-left: 240px;
}


.columns{
    width:100% ;
    padding:10px 10px;
}

#panel{
    background: white;
}

.content{
    background: white;
}

.content-heading{
    background: #DEECF9;
    padding:10px 10px;
    color:black;
    font-family: "wf_segoe-ui_normal", "Segoe UI", "Segoe WP", Tahoma, Arial, sans-serif;
    border-left: 1px solid #e5e3e3;
}


.loading{
    font-size: 15px;
    padding: 6px 10px;
    font-weight: bold;
    background: violet;
    margin-left: 25%;
    border-radius: 2px;
}

.mailcompose{
    border-radius: 3px;
    background: #367fa9;
    padding: 7px 35%;
    color: white;
    font-family: arial,sans-serif;
    font-size: 15px;
    text-shadow: 0 1px rgba(0,0,0,0.1);
}

.info{
    padding: 10px 10px 10px 10px;
}

span.is-left {
    color: #666;
    font-size: 20px;
    font-weight: bold;
}

a.button.is-ligh{
    margin-left: 10px;
}

a.button.is-ligh i{
    font-size: 20px;
}

.checkbox {
    height: 17px;
    width: 17px;
}

i.fa.text-yellow.fa-star-o{
    color: #f39c12 !important;
    font-size: 20px;
}

i.fa.text-yellow.fa-star{
    font-size: 20px;
    color: #f39c12 !important;
}






/*  Mobile Version  */

@media (min-width:721px) and (max-width:935px){
    .mailcompose{
        padding: 7px 15%;
    }
    
    .loader {
        margin: 100px 150px;
    }
}


@media (min-width:936px) and (max-width:1250px){
    .mailcompose{
        padding: 7px 28%;
    }

    .loader {
        margin: 100px 180px;
    }
}


@media (max-width:720px){

    .main-contents{
        width: 100%;
        margin-left: 10px;
    }

    .columns{
        width:100% ;
        padding:30px 20px;
    }
    .loader {
        margin: 100px 150px;
    }

}




</style>