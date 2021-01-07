/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.moment = require('moment-timezone');

import App from './App.vue';
import VueRouter from 'vue-router';
import axios from 'axios';
import routes from './routes';
import DataTable from 'laravel-vue-datatable';   /* https://jamesdordoy.github.io/laravel-vue-datatable/ */


Vue.use(VueRouter);
Vue.prototype.axios = axios;
Vue.use(DataTable);


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

Vue.config.devtools = false
Vue.config.productionTip = false

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const router = new VueRouter({
    mode: 'history',
    routes: routes
})

const app = new Vue({
    el: '#app',
    router: router,
    render: h => h(App),
});
