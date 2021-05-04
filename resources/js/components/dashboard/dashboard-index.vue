<template>
    <div class="col-md-12">
        <div class="card mb-5 mt-2 border shadow">
            <div class="card-body">
                <div class="row col-md-12">
                    <div class="col-md-4" style="border-right: 3px solid #466289;">
                        <h5 class="font-weight-bold">Admin Dashboard</h5>
                        <span class="mt-2"> Welcome, <span class="font-weight-bold">{{ auth.name }}</span>! </span><br>
                        <span>Today is <span class="font-weight-bold">{{ date_today }}</span></span><br><br>
                        <span>This is your overview of this month. </span>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="font-weight-bold"> Upcoming Reservation</h6>
                                <span> No. of Upcoming Reservation: {{ res_upcoming.length }}</span><br>
                            </div>
                            <div class="col-md-6">
                                <h6 class="font-weight-bold"> Checked-In </h6>
                                <span> No. of Checked-In: {{ res_ongoing.length }}</span>
                            </div>
                        </div>
                        <div class="row mt-3 mb-2">
                            <div class="col-md-6">
                                <h6 class="font-weight-bold"> Active Reservation </h6>
                                <span> No. of reservation made for this month: {{ res_this_month.length }}</span>
                            </div>
                            <div class="col-md-6">
                                <h6 class="font-weight-bold"> Total Profit </h6>
                                <span> Profit for the month: {{ formatNumber(total_profit) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-md-12 text-center">
                <h5 class="font-weight-bold"> Booking Summary for Today</h5>
            </div>
            <div class="row col-md-12 text-center mt-3">
                <div class="col-md-4">
                    <div class="card border-curve" style="background-color: #7366FF">
                        <div class="card-body text-center">
                            <div class="row">
                                <div class="col-md-4">
                                    <i class="fas fa-hotel text-white fa-4x"></i>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-white"> Total Rooms </h6>
                                    <span class="font-weight-bold font-xl text-white">21</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-curve" style="background-color: #51BB25">
                        <div class="card-body text-center">
                            <div class="row">
                                <div class="col-md-4">
                                    <i class="far fa-check-circle text-white fa-4x"></i>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-white"> Available Rooms </h6>
                                    <span class="font-weight-bold font-xl text-white"> {{ available_count }} </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><div class="col-md-4">
                <div class="card border-curve" style="background-color: #F73164">
                    <div class="card-body text-center">
                        <div class="row">
                            <div class="col-md-4">
                                <i class="far fa-times-circle text-white fa-4x"></i>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-white"> Unavailable Rooms </h6>
                                <span class="font-weight-bold font-xl text-white"> {{ unavailable_count }} </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-md-12 text-center mb-3">
                <h5 class="font-weight-bold"> Statistics </h5>
                <h6 class="text-center">For the month of <span class="font-weight-bold">{{ current_month }}</span></h6>
            </div>
            <div class="col-md-6">
                <div class="card border shadow">
                    <div class="card-body">
                        <h6 class="font-weight-bold">Most Recent Client: </h6>
                        <hr style="width:15%; border-top:3px solid #68A6BF;" class="m-0 mb-3">
                        <ul v-for="recent in res_recent_clients">
                            <li>
                                <span> Name: <span class="font-weight-bold">{{ recent.first_name }} {{ recent.last_name }}</span> </span><br>
                                <span> Email Address: <span class="font-weight-bold">{{ recent.email }}</span> </span><br>
                                <span> Contact Number: <span class="font-weight-bold">{{ recent.contact_no }}</span> </span><br>
                                <span> Date: <span class="font-weight-bold">{{ formatDate(recent.created_at) }}</span> </span>
                            </li>
                            <hr>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border shadow">
                    <div class="card-body">
                        <h6 class="font-weight-bold"> Profit Summary: </h6>
                        <hr style="width:15%; border-top:3px solid #68A6BF;" class="m-0 mb-3">
                        <div class="mb-2"> Collected Profit: <span class="font-weight-bold">{{ formatNumber(total_profit) }}</span></div>
                        <div class="mb-2"> Uncollected Profit: <span class="font-weight-bold">{{ formatNumber(uncollected_profit) }}</span></div>
                        <div class="mb-2"> Projected Profit: <span class="font-weight-bold">{{ formatNumber(all_profit) }}</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Chart from 'chart.js';

    export default {
        props: ['auth'],
        data() {
            return{
                dashboard:'',
                date_today: '',
                current_month: '',
                available_count: 0,
                unavailable_count: 0,
                total_profit: 0,
                uncollected_profit: 0,
                all_profit: 0,
                res_upcoming: [],
                res_ongoing: [],
                res_active: [],
                res_this_month: [],
                res_recent_clients: [],
                res_expired: [],
            }
        },
        methods: {
            getMostRecentClient() {
                axios.get('api/reservation/getMostRecentClient')
                .then(response => {
                    this.res_recent_clients = response.data.recent_clients;
                })
            },
            getReservationThisMonth() {
                axios.get('api/reservation/getReservationThisMonth')
                .then(response => {
                    this.res_this_month = response.data;

                    for(let i = 0; i < this.res_this_month.length; i++) {
                        this.all_profit += parseFloat(this.res_this_month[i].amount);
                        for(let j = 0; j < this.res_this_month[i].deposits.length; j++) {
                            if(this.res_this_month[i].deposits[j].isAcknowledged == 1) {
                                this.total_profit += parseFloat(this.res_this_month[i].deposits[j].amount);
                            }
                        }
                    }
                    this.uncollected_profit = this.all_profit - this.total_profit;
                })
            },
            getReservationActive() {
                axios.get('api/reservation/getReservationActive')
                .then(response => {
                    this.res_active = response.data;
                    for(let i = 0; i < this.res_active.length; i++) {
                        for(let j = 0; j < this.res_active[i].reservation_details.length; j++) {
                            this.unavailable_count++;
                        }
                    }
                    this.available_count = 21 - parseFloat(this.unavailable_count);
                });
            },
            getReservationUpcoming() {
                axios.get('api/reservation/getReservationUpcoming')
                    .then(response => {
                        for(let i = 0; i < response.data.length; i++) {
                            this.res_upcoming.push(response.data[i]);
                        }
                    });
            },
            getReservationOngoing() {
                axios.get('api/reservation/getReservationOngoing')
                    .then(response => {
                        for(let i = 0; i < response.data.length; i++)
                        {
                            this.res_ongoing.push(response.data[i]);
                        }
                    });
            },
            checkExpiredReservation() {
                axios.get('api/reservation/getReservationExpired')
                .then(response => {
                    this.res_expired = response.data;
                });
            },
            formatNumber(num) {
                return '₱ ' + parseFloat(num).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
            },
            formatDate(value) {
                return moment(value).format('MMM. DD, YYYY')
            }
        },
        computed: {
            getMonth(){
                this.date_today = moment().format('MMM. DD, YYYY')
                var month = moment().month();

                if(month == 0) {
                    this.current_month = 'January';
                } else if (month == 1) {
                    this.current_month = 'February';
                } else if (month == 2) {
                    this.current_month = 'March';
                } else if (month == 3) {
                    this.current_month = 'April';
                } else if (month == 4) {
                    this.current_month = 'May';
                } else if (month == 5) {
                    this.current_month = 'June';
                } else if (month == 6) {
                    this.current_month = 'July';
                } else if (month == 7) {
                    this.current_month = 'August';
                } else if (month == 8) {
                    this.current_month = 'September';
                } else if (month == 9) {
                    this.current_month = 'October';
                } else if (month == 10) {
                    this.current_month = 'November';
                } else {
                    this.current_month = 'December';
                }
            },
        },
        created() {
            this.getMonth;
            this.getReservationActive();
            this.checkExpiredReservation();
            this.getReservationOngoing();
            this.getReservationUpcoming();
            this.getReservationThisMonth();
            this.getMostRecentClient();
        }
    }

</script>
