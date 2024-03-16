<template >
    <section class="section" v-if="loadings">
        <div class="container">
            <nav class="panel">
                <div class=" panel-block" id="datatitle">
                    <div class="columns">
                        <div class="column is-half" id="times">
                            <div class="countdown" v-show="countdowns">
                                <countdown v-bind:deadline="time" v-on:timecount="timecount"></countdown>
                            </div>
                            <div class="note" v-html="note">  </div>
                            <span  v-for="(item, index) in items" style=" padding:10px 10px;">
                               <a v-on:click="question(index)"> <span class="tag is-light" v-bind:class="{ 'active': isActive === index}" > Q. {{ index+1 }}</span></a>
                            </span>
                        </div>
                        <div class="column is-half" id="questions">
                            <div v-if="items[c].parent_id != null">
                                <br>
                                <span :class="textClass" style="font-weight:bold;"> {{index}} . </span>
                                <span style="font-size:15px;">উদ্দীপক থেকে নিচের প্রশ্নের উত্তর দাও-</span>
                                <br>
                                <span v-html="items[c].paragraph"></span>
                                <br><br>
                                <h4 id="question">  {{items[c].question_name}}</h4>
                            </div>
                            <div v-else>
                                <h4 id="question" style="display:block"> <div style="display:inline-flex"> <span :class="textClass">  {{index}}.  </span> <span style="padding-left:10px;" v-html="items[c].question_name"> </span> </div>  </h4>
                            </div>
                            <ul class="answers">
                               <div v-if="items[c].mcq_type == 2">
                                i)  {{items[c].c1}}<br>
                                ii)  {{items[c].c2}}<br>
                                iii)  {{items[c].c3}} 
                                <br><br> 
                                নিচের কোনটি সঠিক?
                                <br> 
                                <br>  
                                </div>
                                <h6> <input type="radio" name="q1"  v-on:change="pick(items[c].id)" :value="items[c].option_no_1" v-model="chceked[items[c].id]" id="q1a"><label for="q1a"> {{ items[c].option_no_1 }}</label><br/></h6>
                               
                                <h6><input type="radio" name="q1" v-on:change="pick(items[c].id)" :value="items[c].option_no_2" v-model="chceked[items[c].id]" id="q1b"><label for="q1b"> {{ items[c].option_no_2 }}</label><br/></h6>
                               
                                <h6><input type="radio" name="q1"v-on:change="pick(items[c].id)" :value="items[c].option_no_3" v-model="chceked[items[c].id]" id="q1c"><label for="q1c"> {{ items[c].option_no_3 }}</label><br/></h6>
                               
                                <h6><input type="radio" name="q1" v-on:change="pick(items[c].id)" :value="items[c].option_no_4" v-model="chceked[items[c].id]" id="q1d"><label for="q1d"> {{ items[c].option_no_4 }}</label><br/></h6>
                            </ul>
                            <br>
                            <button class="button is-info" v-on:click="previous" v-if="previouses">Previous</button>
                            <button class="button is-info" v-on:click="next" v-if="nexts">Next</button>
                            <br><br>
                            <a href="/exams/result/submit" class="button is-success" >Submit</a>
                        </div>
                    </div>
                    <div class="modal" v-bind:class="active">
                        <div class="modal-background"></div>
                        <div class="modal-card">
                            <header class="modal-card-head">
                                <p class="modal-card-title">Time Out</p>
                                <button class="delete" aria-label="close"></button>
                            </header>
                            <section class="modal-card-body">
                            Your Time is out.

                            </section>
                            <footer class="modal-card-foot">
                                <a href="/exams/result/submit" class="button is-success">Back to</a>
                            </footer>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </section>
</template>


<script>

    export default {
        data(){
            return{
                countdowns : true,
                active :'',
                items:[],
                result:[],
                index:1,
                c:0,
                d:'',
                note : '',
                time : "",
                nexts : true,
                previouses : false,
                click : false,
                clickcount : 0,
                chceked : Array(),

                isActive : null,

                loadings:false

            }
        },
        computed: {

            textClass: function() {
               
               // if (this.index == 1) {
               //  this.index = '১'
               // }
               // else if (this.index == 2) {
               //      this.index = '২'
               // }   
            }
        },
        methods:{

            pick:function(id) {
               var vm = this
                axios.post('/*/results/exams',{
                    id : id, 
                    answer : this.chceked[id]
                })
                .then(function (response) {
                    setTimeout(function(){     
                        vm.next()
                     }, 1000);
                }.bind(this))
                .catch(function (error) {
        
                });

            },



            timecount:function(min,sec){
                if(min == 0 && sec == 1){
                    this.countdowns = false
                    this.active = 'is-active'
                }
            },

           
           next:function() {
            
                if (this.c+1 < this.items.length) {

                    this.previouses = true
                    if(this.c+1 == this.items.length-1){
                        this.nexts = false
                    }
                    this.c++;
                    this.index++;
                    this.isActive = this.index-1
                }
            },
            previous: function() {

                this.nexts = true
                if (this.c-1 < this.items.length) {
                    if(this.c-1 == 0){
                        this.previouses = false
                    }
                    if (this.c == 0) {
                        this.c = 0
                        this.index  = 1
                    }
                    else{
                        this.c--;
                        this.index--;
                    }
                    
                    this.isActive = this.index-1
                }
            },
            question: function(index) {
                
                this.isActive = index
                this.nexts = true
                this.previouses = true
                
                if (index == this.items.length-1){
                    this.nexts = false
                }
                else if (index == '0'){
                    this.previouses = false
                }

                this.c = index,
                this.index = index + 1
            }

        },
        mounted() {


            var lang = document.querySelector('#lang').getAttribute('content');
            if (lang == 'en') {
                this.note = '* You can change question by Keypress <i class="fa fa-arrow-right" style="font-weight:bold"></i> for next question &  Keypress <i class="fa fa-arrow-left" style="font-weight:bold"></i> for previous question.'
            }
            else{
                this.note = '* আপনি কিপ্রেস এর মাধ্যমে প্রশ্ন পরিবর্তন করতে পারেন। কিপ্রেস <i class="fa fa-arrow-right" style="font-weight:bold"></i> পরবর্তী প্রশ্নের জন্য এবং কীপ্রেস <i class="fa fa-arrow-left" style="font-weight:bold"></i> আগের প্রশ্নের জন্য।'
            }

            var self = this
            axios.get('/*/exams/start')
              .then(function (response) {
                
                if (response.data.msg == 'errortime') {
                    window.location.href = '/exams/result/submit';                   
                }
                else{
                    this.items = response.data.question,
                    this.time = response.data.time,
                    this.isActive = 0,
                    this.loadings = true
                    $('.footer').css('display', 'block')
                }
                
              }.bind(this))
              .catch(function (error) {
                console.log(error);
            });

            $(document).ready(function() {
                $(document).keydown(function(e) {
                    var keycode = window.event? event.keyCode: e.keyCode;
                    if(keycode == '37' || keycode == '188'){
                        self.previous();
                    }
                    else if(keycode == '39' || keycode == '190'){
                        self.next();
                    }
                });
            });
        }
    }
</script>

















<style>
    

    .titleimage {
        position: relative;
        font-size: 30px;
        margin-top: 0;
        font-family: 'Lobster', helvetica, arial;
        padding: 12px;
        margin-left: 70px;
        padding-right: 50px;
    }


    div#app {
        margin-top: 100px;
    }

    .columns {
        padding: 5% 0px;
        width: 100%;
    }

    .answers{
        padding: 10px 0px; 
    }
    .note{
        font-size: 15px;
        margin-bottom: 20px;
        margin-top: -20px;
        padding-left: 10px;   
    }
    .content ul {
        list-style: disc outside;
        margin-left: 10px;
    }

    .answers label{
        font-weight: normal;
        padding: 0px 10px;  
        font-family: 'Bangla', sans-serif;
        font-size: 21px;

    }
    #times{
        border-right: 2px solid #eee; 
    }
    #times span{
        margin-bottom: 15px;
    }
    #questions{
        padding-left: 50px;
    }

    #datatitle{
        font-size: 20px;
    }

    span.tag.is-light {
        font-size: 15px;
        font-weight: bold;
        color: black;
    }

    span.tag.is-light.active{
        font-size: 15px;
        font-weight: bold;
        color: white;
        background: hsl(204, 86%, 53%);
    }
    a:hover{
        text-decoration: none;
    }

    .tag:not(body).is-light {
        border: 1px solid darkcyan;
    }

    .vue-countdown .text {
        text-transform: uppercase;
        margin-bottom: 0px;
        font-size: 10px;
        margin-top: -30px;
    }

    .title{
        color: white;
    }

    #ok{
        display: inline-flex;
    }
    #ok i{
        padding: 10px 10px;
        font-size: 15px;

    }

    #notfound{
        text-align: center;
    }

    .section {
      padding: 3rem 1.5rem;
    }

    #question{
        font-size: 24px;
        font-weight: 540;
        letter-spacing: 0.04em;
        line-height: 1.8em;
        font-family: 'Bangla', sans-serif;
    }

    ul.answers {
        margin-left: 23px;
        font-size: 22px;
        font-family: 'Bangla', sans-serif;
    }
    ul.answers h6{
        margin-bottom: 15px;
    }

        /* 
         Media between 00 and 580  */
    @media (max-width:580px){

        .section {
            padding: 0rem 0rem;
        }
        #times{
            padding-bottom: 30px;
        }
        .countdown {
            padding: 0px 23%;
            padding-bottom: 20px;
        }
        button.button.is-primary {
            margin-left: 10px;
        }
        a.button.is-success {
            margin-left: 3%;
        }

    }

    /*  Media between 581 and 924  */
    @media(min-width:581px) and (max-width:770px) {

        .section {
            padding: 0rem 0rem;
        } 
        .countdown {
            padding: 0px 32%;
            padding-bottom: 20px;
        }
        #times{
            padding-bottom: 30px;
        }
    }


    .footer-content {
        margin: 30px 0px;
    }
    
    #links ul li {
        list-style: none;
        margin-left: 0px;
        padding: 5px 26px;
    }


</style>
