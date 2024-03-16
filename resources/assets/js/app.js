require('./bootstrap');
window.Vue = require('vue');

import Router from './router'

import Vue from 'vue'
/* Vue Router */
import VueRouter from 'vue-router'
Vue.use(VueRouter)

/* Vue Validator Form */
import VeeValidate from 'vee-validate'
Vue.use(VeeValidate)

/* Vue Chat Scroll */
import VueChatScroll from 'vue-chat-scroll'
Vue.use(VueChatScroll)

/* Vue Event Calendar */
import 'vue-event-calendar/dist/style.css' 
import vueEventCalendar from 'vue-event-calendar'
Vue.use(vueEventCalendar, {locale: 'en'})

/* Moment js */
import VueMoment from 'moment'
Vue.prototype.moment = VueMoment

// vue-infinite-scroll


/* EXAM  */ 
Vue.component('exam', require('./components/Exam.vue'));
Vue.component('countdown', require('vuejs-countdown'));
import vClickOutside from 'v-click-outside'
Vue.use(vClickOutside)

//Filters Truncate
Vue.filter('truncate',function(value){
    return value.slice(0,70);
});

// Vue Head
import VueHead from 'vue-head';
Vue.use(VueHead, {
  separator: '|'
});

const router = new VueRouter({
	routes : Router,
	mode : 'history'

})

const app = new Vue({
    el: '#app',
    router: router
});

