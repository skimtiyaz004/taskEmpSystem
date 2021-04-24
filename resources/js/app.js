import Vue from 'vue'

require('./bootstrap');

window.Vue = require('vue');

Vue.component('employees', require('./components/Employees.vue').default);

const app = new Vue({
	el: '#app'
});
