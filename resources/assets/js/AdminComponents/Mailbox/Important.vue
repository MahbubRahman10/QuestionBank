<template>
    <div>
     <Sidebar ref="toggle"></Sidebar>
     <Header v-on:click-toggle="toggle"></Header>


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
                        <router-link :to="{name :'mail'}"  class="panel-block">
                            <span class="panel-icon">
                                <i class="fa fa-inbox"></i>
                            </span>
                            Inbox
                        </router-link>
                        <router-link :to="{name :'mailsent'}" class="panel-block ">
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
                        <router-link :to="{name :'mailimportant'}" class="panel-block is-active">
                            <span class="panel-icon">
                                <i class="fa fa-envelope"></i>
                            </span>
                            Important
                        </router-link>
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
                            <span class=" is-left"> Inbox </span>
                            <span v-show="buttonselect">
                                <a class="button is-ligh" > <i class="fa fa-trash" aria-hidden="true"></i> </a>
                                <a class="button is-ligh" > <i class="fa fa-bookmark" aria-hidden="true"></i> </a>
                            </span>
                        </div>
                        <div class="info">
                            <table>
                                <thead>
                                   
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="" class="checkbox" v-on:click="CheckedToggle" v-model="checked">
                                        </td>
                                        <td>
                                            <a href="" v-on:click="StarChecked" class="star"><i v-bind:class="[star]" ></i></a>
                                        </td>
                                        <td>BBBBBBBBBBBBBBBBBBBBBBBBB</td>
                                        <td>
                                           <span>15 July 2017</span>
                                        </td>
                                         </router-link>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>

    import Sidebar from './../Sidebar.vue'
    import Header from './../Header.vue'

    export default {

        components:{
            'Header' : Header,
            'Sidebar' : Sidebar  
        },
        data(){
            return{
                buttonselect: false,
                checked:'',
                star: 'fa text-yellow fa-star-o'
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
            CheckedToggle:function(){
                if(this.checked == true){
                    this.buttonselect = false
                }
                else{
                    this.buttonselect = true
                }
            },
            StarChecked:function(e){
                e.preventDefault();
                if(this.star == "fa text-yellow fa-star-o"){
                    this.star = "fa text-yellow fa-star"
                }
                else{
                    this.star = "fa text-yellow fa-star-o"
                }
            }
        },
        mounted() {
            console.log('Component mounted.')
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

.mailcompose{
    border-radius: 3px;
    background: #367fa9;
    padding: 7px 35%;
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
}


@media (min-width:936px) and (max-width:1250px){
    .mailcompose{
        padding: 7px 28%;
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


}



</style>