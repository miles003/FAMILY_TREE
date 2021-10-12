/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import moment from 'moment'
import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios'
import { stores } from './store';
require('./bootstrap');

window.Vue = require('vue').default;

Vue.prototype.$axios = axios
Vue.use(Vuex);
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('home-page', require('./pages/HomePage.vue').default);
Vue.component('family-tree-page', require('./pages/FamilyTreePage.vue').default);

/**
 * Filter
 */
Vue.filter('formatDate', function(value) {
    if (value) return moment(String(value)).format('MM/DD/YYYY hh:mm a')
});
Vue.filter('age', function(value) {
    if (value) return moment().diff(value, 'years')
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const store = new Vuex.Store(stores);
const app = new Vue({
    el: '#app',
    store: store,
});
