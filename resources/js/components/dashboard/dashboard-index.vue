<template>
    <div class="col-md-12">
        <div class="card mb-5 mt-2 border shadow">
            <div class="card-body">
                <div class="row col-md-12">
                    <div class="col-md-4" style="border-right: 3px solid #466289;">
                        <h5 class="font-weight-bold">Admin Dashboard</h5>
                        <span class="mt-2"> Welcome, <span class="font-weight-bold">{{ auth.name }}</span>! </span><br>
                        <span>Today is <span class="font-weight-bold">{{date_today}}</span></span><br><br>
                        <span>This is your overview of this month. </span>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="font-weight-bold"> Bookings Made </h6>
                                <span>Number of Bookings Made: </span><br>
                            </div>
                            <div class="col-md-6">
                                <h6 class="font-weight-bold"> Lorem Ipsum </h6>
                                <span>Lorem Ipsum dolor sit amet: </span>
                            </div>
                        </div>
                        <div class="row mt-3 mb-2">
                            <div class="col-md-6">
                                <h6 class="font-weight-bold"> Lorem Ipsum </h6>
                                <span>Lorem Ipsum dolor sit amet: </span>
                            </div>
                            <div class="col-md-6">

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
                                    <i class="fas fa-calendar-week text-white fa-4x"></i>
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
                                    <i class="fas fa-calendar-week text-white fa-4x"></i>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-white"> Available </h6>
                                    <span class="font-weight-bold font-xl text-white">8</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><div class="col-md-4">
                <div class="card border-curve" style="background-color: #F73164">
                    <div class="card-body text-center">
                        <div class="row">
                            <div class="col-md-4">
                                <i class="fas fa-calendar-week text-white fa-4x"></i>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-white"> Unavailable </h6>
                                <span class="font-weight-bold font-xl text-white">13</span>
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
                        <p class="font-weight-bold">Most Recent Client: </p>
                        <ul>
                            <li>
                                <span>Name: </span><br>
                                <span>Email Address: </span><br>
                                <span>Date: </span>
                            </li>
                            <hr>
                            <li>
                                <span>Name: </span><br>
                                <span>Email Address: </span><br>
                                <span>Date: </span>
                            </li>
                            <hr>
                            <li>
                                <span>Name: </span><br>
                                <span>Email Address: </span><br>
                                <span>Date: </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border shadow">
                    <div class="card-body">
                        <p class="font-weight-bold">Number of Booked Rooms: </p>
                        <!--<ul>
                            <li><span> Family Room: <span class="font-weight-bold">32</span> bookings made </span></li>
                            <li><span> Deluxe Room: <span class="font-weight-bold">15</span> bookings made </span></li>
                            <li><span> Villa Room 1: <span class="font-weight-bold">7</span> bookings made </span></li>
                        </ul>-->
                        <canvas id="myChart" width="10" height="10"></canvas>
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
            }
        },
        methods: {
            createChart()
            {
                let ctx = document.getElementById('myChart');
                let myChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: ['Family Room', 'Deluxe Room', 'Villa Room 1'],
                        datasets: [{
                            label: '# of Bookings Made',
                            data: [32, 15, 7],
                            backgroundColor: [
                                'rgba(115,102,255,.8)',
                                'rgba(247,49,100,.8)',
                                'rgba(81,187,37,.8)',
                            ],
                            borderWidth: 3
                        }]
                    },
                    options: {
                        responsive: true,
                    }
                });
            }
        },
        mounted() {
            this.createChart();
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
        }
    }

</script>
