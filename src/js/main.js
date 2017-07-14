import Vue from 'vue';
import VueRouter from 'vue-router';
import App from './App';
import { routes } from './router/routes';
import Header from './components/SiteHeader';
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
Vue.use(VueRouter);

const router = new VueRouter({
  mode: 'history',
  routes,
});

Vue.component('site-header', {
  template:  '#site-header',
});


new Vue({
  router,
  el: '#app',
  render: h => h(App),
});
