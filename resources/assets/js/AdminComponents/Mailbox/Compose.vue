<template>
    <div>
    
    <Sidebar ref="toggle"></Sidebar>
    <Header v-on:click-toggle="toggle"></Header>
    

    <div class="main-contents" v-if="loadings">
            <div class="columns">
                <div class="column is-one-quarter">
                    <nav class="panel" id="panel">
                        <p class="panel-heading">
                            <a class="mailcompose"> Compose </a>
                        </p>
                        <!-- <div class="panel-block">
                            <p class="control has-icons-left">
                                <input class="input is-small" type="text" placeholder="Search Mail">
                                <span class="icon is-small is-left">
                                    <i class="fa fa-search"></i>
                                </span>
                            </p>
                        </div> -->
                        <p class="panel-tabs">
                           
                        </p>
                        <router-link :to="{name :'mail'}" class="panel-block ">
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

                <div class="column" >
                    <div class="content" style="">
                        <div class="content-heading">
                            <span class=" is-left"> Compose New Message</span>
                            <span v-show="loading" class="loading">{{msg}}</span>
                        </div><br>
                        <div class="info">
                            <form @submit.prevent="validateBeforeSubmit" id="myform">
                                <div :class="{ 'has-error': errors.has('To') }">
                                    <input v-validate="'required'" v-model="To" type="text" name="To" class="input" placeholder="To:">
                                    <span v-show="errors.has('To')">{{ errors.first('To') }}</span>         
                                </div><br>
                                <div :class="{ 'has-error': errors.has('Subject') }">
                                    <input v-model="Subject" type="text" name="Subject" class="input" placeholder="Subject:">  
                                </div><br>
                                <div :class="{ 'has-error': errors.has('Content') }">
                                    <textarea v-validate="'required'" v-model="Content" name="Content" class="textarea"  placeholder="Message:"></textarea>
                                    <span v-show="errors.has('Content')">{{ errors.first('Content') }}</span>        
                                </div><br>
                                <div class="field is-grouped">
                                        <button class="button is-link" >Submit</button>
                                <!-- <div class="control" style="padding:0px 10px;">
                                    <button class="button is-light" v-on:click="draft"><i class="fa fa-pencil" aria-hidden="true"></i> Draft</button>
                                </div> -->
                                <div class="control">
                                    <router-link :to="{name : 'mail'}" class="button is-light"><i class="fa fa-times" aria-hidden="true"></i>   Cancel</router-link>
                                </div>
                            </div>
                           </form>
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
            'Header' : Header,
            'Sidebar' : Sidebar,
            vueTopprogress   
        },
        head: {
            title: {
                inner: 'Compose'
            },
            meta: [

            ],
        },
        data(){
            return{
                loadings : false,
                unread : '',
                showunread : false,

                To : '',
                Subject : '',
                Content : '',
                loading : false,
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
            draft:function(){
                alert("ok")
            },
            validateBeforeSubmit() {
                var vm  = this
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        vm.loading = true
                        vm.msg = 'Sending..'
                        axios.post('/*/admin/mail/compose',{
                            To : this.To,
                            Subject :  this.Subject,
                            Content : this.Content,
                        })
                        .then( response => {  
                            this.msg = 'Message Send Successfully',
                            this.To = '',
                            this.Subject = '',
                            this.Content = '',
                            this.errors.clear(),
                            this.$validator.reset(),
                            setTimeout(function() { vm.loading = false }, 5000)
                            
                        })
                        .catch( error  => {
                            console.log(error);
                        });
                    }
                });
            }
        },
        mounted() {

            if(localStorage.getItem('unread') != '0'){
                this.unread = localStorage.getItem('unread')
                this.showunread = true
            }

            if(localStorage.getItem('email') != null){
                this.To = localStorage.getItem('email')
                localStorage.removeItem('email')
            }
            this.$refs.topProgress.start(),
            setTimeout(() => {
                this.loadings = true,
                this.$refs.topProgress.done()
            }, 500)
        }
    }
</script>

<style scoped>
    
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
    margin-left: 17%;
    border-radius: 2px;
}

.active{
    background: #dbdbdb;
    border-bottom: 2px solid white;
}


.mailcompose{
    border-radius: 3px;
    background: #367fa9;
    padding: 7px 77px;
    color: white;
    font-family: arial,sans-serif;
    font-size: 15px;
    text-shadow: 0 1px rgba(0,0,0,0.1);
}



span.is-left {
    color: #666;
    font-size: 20px;
    font-weight: bold;
}

form{
    padding: 0px 15px 15px 15px;
}

.input, .textarea{
     
}
i.fa.fa-pencil {
    padding: 0px 5px;
}
i.fa.fa-times {
    padding: 0px 5px;
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