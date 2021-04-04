import Vue from 'vue'

require('./bootstrap');

// axios
import axios from 'axios'
Vue.prototype.$http = axios

//V-Datepicker
import VCalendar from 'v-calendar';
Vue.use(VCalendar)

//sweetalert2
import Swal from 'sweetalert2'
window.Swal = Swal;

//moment.js
import moment from 'moment'
window.moment = moment

//Vue Form Wizard
import VueFormWizard from 'vue-form-wizard'
import 'vue-form-wizard/dist/vue-form-wizard.min.css'
Vue.use(VueFormWizard)

//Vue Loader
import Loading from 'vue-loading-overlay';
Vue.use(Loading, {
    color: 'blue',
    loader: 'spinner',
    width: 64,
    height: 64,
})

//Vuetify
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
Vue.use(Vuetify)

const opts = {}

export default new Vuetify(opts)

import Chart from 'chart.js';

window.Vue = require('vue').default;

Vue.component('dashboard-index', require('./components/dashboard/dashboard-index.vue').default);
Vue.component('list-of-rooms', require('./components/rooms/list-of-rooms.vue').default);
Vue.component('deposit', require('./components/deposits/deposit.vue').default);
Vue.component('reservation', require('./components/reservation/reservation.vue').default);


Vue.component('index', require('./components/website/index.vue').default);
Vue.component('rooms-list', require('./components/website/rooms-list.vue').default);
Vue.component('facilities', require('./components/website/facilities.vue').default);
Vue.component('contact-us', require('./components/website/contact-us.vue').default);
Vue.component('booking', require('./components/website/booking.vue').default);
Vue.component('booking-details', require('./components/website/booking-details.vue').default);



const app = new Vue({
    el: '#app',
    vuetify: new Vuetify(),
});
