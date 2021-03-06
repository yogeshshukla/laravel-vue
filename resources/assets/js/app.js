require('./bootstrap');

window.Vue = require('vue');

import store from './store';
import router from './router';

import App from './App.vue';

import axios from 'axios'

Vue.prototype.$http = axios;

Vue.prototype.$http.defaults.baseURL =  `http://localhost/vuelaravelcrud/public/api/`

// import { ClientTable } from 'vue-tables-2'
// Vue.use(ClientTable);
import { ServerTable } from 'vue-tables-2';
Vue.use(ServerTable);
const token = localStorage.getItem('token')
if (token) {
  Vue.prototype.$http.defaults.headers.common['Authorization'] = 'Bearer '+token
}
  
const app = new Vue(Vue.util.extend({ router, store }, App)).$mount('#app');