 require('./bootstrap');
require('admin-lte');

window.Vue = require('vue').default;


// import vue from 'vue'
// window.Vue = vue;

//import App from './components/App.vue';
import Bell from './components/Bell.vue';
import Vmenu from './components/Vmenu.vue';
import Groupmenu from './components/Groupmenu.vue';
import Note from './components/NotificationMessage.vue';

import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';
import {routes} from './routes';
import JobInvoiceList from './components/jobinvoice/list.vue';
import VueSweetalert2 from 'vue-sweetalert2';
import BootstrapVue from 'bootstrap-vue'; //Importing
import GroupList from './components/group/list.vue';


import 'sweetalert2/dist/sweetalert2.min.css';

Vue.prototype.$userId = document.querySelector("meta[name='user-id']").getAttribute('content');


Vue.use(VueSweetalert2);
 
Vue.use(VueRouter);
Vue.use(VueAxios, axios);
 
const router = new VueRouter({
    mode: 'history',
    routes: routes
});
 


Vue.component('JobInvoiceList', require('./components/jobinvoice/list.vue'));


// const app = new Vue({
// 	 name: 'jobInvoiceList',
//     router: router,
//     components: { JobInvoiceList },
// }).$mount('#app')
 
const app = new Vue({
    el: '#app',
    components: { JobInvoiceList, Bell, Note, Vmenu , Groupmenu, GroupList},
    router: router,
    //  render: h => h(App),
});