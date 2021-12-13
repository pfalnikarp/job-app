require('./bootstrap');
require('admin-lte');

window.Vue = require('vue').default;


// import vue from 'vue'
// window.Vue = vue;

import App from './components/App.vue';
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';
import {routes} from './routes';
import JobInvoiceList from './components/jobinvoice/list.vue';
 
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
    components: { JobInvoiceList },
    router: router,
      render: h => h(App),
});