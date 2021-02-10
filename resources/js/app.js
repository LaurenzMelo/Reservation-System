import Vue from 'vue'

require('./bootstrap');

// axios
import axios from 'axios'
Vue.prototype.$http = axios

//sweetalert2
import Swal from 'sweetalert2'
window.Swal = Swal;

//moment.js
import moment from 'moment'
window.moment = moment

import Chart from 'chart.js';

window.Vue = require('vue').default;


Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('dashboard-index', require('./components/dashboard/dashboard-index.vue').default);


const app = new Vue({
    el: '#app',
});
