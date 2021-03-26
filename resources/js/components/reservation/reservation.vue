<template>
    <div class="col-md-12">
        <div class="card mb-5 mt-2 border shadow">
            <div class="card-body">
                <div class="row d-flex justify-content-end mb-4">
                    <div class="mt-2 mr-2">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="upcoming" id="Pen" value="Upcoming" v-model="res_option">
                            <label class="form-check-label">Upcoming</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name=ongoing id="App" value="On Going" v-model="res_option">
                            <label class="form-check-label">Checked In</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" v-if="res_option == 'Upcoming'">
                    <v-card>
                        <v-card-title>
                            Reservation List
                            <v-spacer></v-spacer>
                            <v-text-field
                                v-model="search"
                                append-icon="mdi-magnify"
                                label="Search"
                                single-line
                                hide-details
                            >
                            </v-text-field>
                        </v-card-title>
                        <v-data-table
                            :headers="headers"
                            :items="res_upcoming"
                            :search="search"
                            class="elevation-1 mt-4 border shadow text-center"
                        >
                            <template v-slot:item.remaining="{ item }">
                                {{ formatNumber(item.amount - item.payment) }}
                            </template>
                            <template v-slot:item.amount="{ item }">
                                {{ formatNumber(item.amount) }}
                            </template>
                            <template v-slot:item.payment="{ item }">
                                {{ formatNumber(item.payment) }}
                            </template>
                            <template v-slot:item.is_paid="{ item }">
                                <div v-if="item.is_paid == 0">
                                    Unpaid
                                </div>
                                <div v-else>
                                    Paid
                                </div>
                            </template>
                            <template v-slot:item.actions="{ item }">
                                <button
                                    class="btn btn-success btn-sm"
                                    @click="checkIn(item)"
                                >
                                    <i class="fas fa-door-open"></i>
                                </button>
                                <button
                                    class="btn btn-primary btn-sm"
                                    data-toggle="modal"
                                    data-target="#viewReservation"
                                    @click="viewUpcomingRes(item)"
                                >
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button
                                    class="btn btn-danger btn-sm"
                                    @click="deleteReservation(item)"
                                >
                                    <i class="fas fa-times"></i>
                                </button>
                            </template>
                        </v-data-table>
                    </v-card>
                </div>
                <div class="col-md-12" v-else>
                    <v-card>
                        <v-card-title>
                            Reservation List
                            <v-spacer></v-spacer>
                            <v-text-field
                                v-model="search"
                                append-icon="mdi-magnify"
                                label="Search"
                                single-line
                                hide-details
                            >
                            </v-text-field>
                        </v-card-title>
                        <v-data-table
                            :headers="headers"
                            :items="res_ongoing"
                            :search="search"
                            class="elevation-1 mt-4 border shadow text-center"
                        >
                            <template v-slot:item.is_paid="{ item }">
                                <div v-if="item.is_paid == 0">
                                    Unpaid
                                </div>
                                <div v-else>
                                    Paid
                                </div>
                            </template>
                            <template v-slot:item.actions="{ item }">
                                <button
                                    class="btn btn-danger btn-sm"
                                    @click="checkOut(item.id)"
                                >
                                    <i class="fas fa-door-closed"></i>
                                </button>
                                <button
                                    class="btn btn-primary btn-sm"
                                >
                                    <i class="fas fa-eye"></i>
                                </button>
                            </template>
                        </v-data-table>
                    </v-card>
                </div>
            </div>
        </div>

        <div class="modal fade" id="viewReservation" tabindex="-1" role="dialog" aria-labelledby="viewReservationLabel" aria-hidden="true" v-if="selected != []">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> Reservation #{{ selected.reservation_no }} </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="font-weight-bold text-center"> Personal Info </h5>
                                <hr class="m-auto" style="border-top:3px solid #68A6BF; width: 5%">
                                <div class="form-group ml-4">
                                    <label class="font-weight-bold"> Name </label>
                                    <p class="text-indent-sentence">{{ selected.first_name }} {{ selected.last_name }}</p>
                                </div>
                                <div class="form-group ml-4">
                                    <label class="font-weight-bold"> No. Of Guests </label>
                                    <p class="text-indent-sentence">{{ selected.guest_no }}</p>
                                </div>
                                <div class="form-group ml-4">
                                    <label class="font-weight-bold"> Email </label>
                                    <p class="text-indent-sentence">{{ selected.email }}</p>
                                </div>
                                <div class="form-group ml-4">
                                    <label class="font-weight-bold"> Contact Number </label>
                                    <p class="text-indent-sentence">{{ selected.contact_no }}</p>
                                </div>
                                <div class="form-group ml-4">
                                    <label class="font-weight-bold"> Arrival Time & Requests </label>
                                    <p class="text-indent-sentence">{{ selected.requests }}</p>
                                </div>
                                <hr>
                                <div class="form-group ml-4">
                                    <label class="font-weight-bold"> Date Of Reservation </label>
                                    <p class="text-indent-sentence"> <span class="font-weight-bold">{{ start_date }}</span> to <span class="font-weight-bold">{{ end_date }}</span> </p>
                                </div>
                                <div class="form-group ml-4">
                                    <label class="font-weight-bold"> Night(s) of Stay </label>
                                    <p class="text-indent-sentence"> {{ nights_stay }} </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h5 class="font-weight-bold text-center"> Booking </h5>
                                <hr class="m-auto" style="border-top:3px solid #68A6BF; width: 5%">
                                <div class="form-group ml-4">
                                    <label class="font-weight-bold"> Rooms </label>
                                    <div v-for="rooms in selected.reservation_details">
                                        <p class="text-indent-sentence">{{ rooms.rooms.name }} - {{ formatNumber(rooms.rooms.amount) }} * {{ nights_stay }} (Nights of Stay)</p>
                                    </div>
                                </div>
                                <div class="form-group ml-4 d-flex justify-content-around">
                                    <div>
                                        <label class="font-weight-bold"> Total Amount </label>
                                        <p> {{ formatNumber(selected.amount) }} </p>
                                    </div>
                                    <div>
                                        <label class="font-weight-bold"> Balance </label>
                                        <p> {{ formatNumber(selected.amount - total_payment) }} </p>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group ml-4">
                                    <label class="font-weight-bold"> Payments Made </label>
                                    <div v-for="payments in selected.deposits">
                                        <p class="text-indent-sentence">Reference No: {{ payments.reference_no }} </p>
                                        <p class="text-indent-sentence">
                                            {{ payments.bank }} - {{ payments.time_deposited }} - {{ formatNumber(payments.amount) }} -
                                            <span v-if="payments.isAcknowledged == 0"> Unpaid </span> <span v-else> Paid </span>
                                        </p>
                                        <hr class="w-50" style="border-top:2px solid #68A6BF;">
                                    </div>
                                </div>
                                <div class="form-group ml-4 text-center">
                                    <label class="font-weight-bold"> Total Approved Amount</label>
                                    <p>{{ formatNumber(total_payment) }}</p>
                                </div>
                                <div class="form-group ml-4">
                                    <label class="font-weight-bold"> Make Payment (In Cash) </label>
                                    <div class="text-center mt-2" v-if="pay_trigger == true && selected.is_paid == 0">
                                        <label>Payment</label>
                                        <input type="number" min="0" v-model="payment_cash" class="form-control">
                                        <div class="row d-flex justify-content-center mt-2">
                                            <button type="button" class="btn btn-success btn-lg text-white w-25 mr-2" @click="pay()">Submit</button>
                                            <button type="button" class="btn btn-danger btn-lg text-white w-25" @click="cancelClick()">Cancel</button>
                                        </div>
                                    </div>
                                    <div class="text-center mt-2" v-else-if="pay_trigger == false && selected.is_paid == 0">
                                        <button type="button" class="btn btn-success btn-lg text-white w-50" @click="payClick()">Pay</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary text-white" data-dismiss="modal" @click="cancelClick()"> Close </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['auth'],
        data() {
            return {
                headers: [
                    { text: 'Reservation Number', value: 'reservation_no', class: 'text-center'},
                    { text: 'Amount', value: 'amount', class: 'text-center' },
                    { text: 'Payment', value: 'payment', class: 'text-center' },
                    { text: 'Remaining', value: 'remaining', class: 'text-center' },
                    { text: 'Status', value: 'is_paid', class: 'text-center' },
                    { text: 'Action', value: 'actions', class: 'text-center' },
                ],
                res_upcoming: [],
                res_ongoing: [],
                selected: [],
                start_date: '',
                end_date: '',
                res_option: 'Upcoming',
                search: '',
                nights_stay: 0,
                total_payment: 0,
                payment_cash: 0,
                pay_trigger: false,
            }
        },
        methods: {
            cancelClick() {
                this.pay_trigger = false;
                this.payment_cash = 0;
            },
            pay() {
                if(this.payment_cash > (this.selected.amount - this.selected.payment)) {
                    Swal.fire(
                        'Error',
                        'Payment Exceeded the Total Balance.',
                        'error'
                    )
                } else if(this.payment_cash <= 0) {
                    Swal.fire(
                        'Error',
                        'Payment cannot be negative or zero.',
                        'error'
                    )
                } else {
                    Swal.fire({
                        title: 'Pay ' + this.formatNumber(this.payment_cash) + ' in cash?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes'
                    }).then((result) => {
                        if (result.value) {
                            axios.post('api/reservation/payCash', {
                                id: this.selected.id,
                                payment_cash: this.payment_cash
                            }).then(response => {
                                Swal.fire(
                                    'Complete!',
                                    'Payment Successful',
                                    'success'
                                )

                                location.reload();
                            });
                        }
                    });
                }
            },
            payClick() {
                this.pay_trigger = true;
            },
            checkOut(id) {
                Swal.fire({
                    title: 'Check Out?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.value) {
                        axios.post('api/reservation/checkOut', {
                            id: id,
                        }).then(response => {
                            Swal.fire(
                                'Complete!',
                                'Payment Successful',
                                'success'
                            )
                            this.getReservationOngoing();
                        })
                    }
                });
            },
            checkIn(item) {
                var date_now = moment(Date.now()).format('YYYY-MM-DD 00:00:00');
                var date_only = moment(item.reservation_details[0].start_date).format('YYYY-MM-DD');
                var date_with_time = moment(date_only).format('YYYY-MM-DD 00:00:00');

                if(item.is_paid == 0) {
                    Swal.fire(
                        'Unable to Check In',
                        'Please pay the remaining amount first.',
                        'error'
                    )
                } else if(date_now != date_with_time) {
                    Swal.fire(
                        'Unable to Check In',
                        'The Date of Check In is not met.',
                        'error'
                    )
                } else {
                    Swal.fire({
                        title: 'Check In?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes'
                    }).then((result) => {
                        if (result.value) {
                            axios.post('api/reservation/checkIn', {
                                id: item.id,
                            }).then(response => {
                                Swal.fire(
                                    'Check In Successful',
                                    'Complete!',
                                    'success'
                                )
                                this.getReservationUpcoming();
                            })
                        }
                    });
                }
            },
            deleteReservation(item) {
                Swal.fire({
                    title: 'Delete Reservation?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.value) {
                        axios.post('api/reservation/deleteReservation', {
                            selected: item,
                        }).then(response => {
                            Swal.fire(
                                'Reservation Was Deleted.',
                                'Complete!',
                                'success'
                            )
                            this.getReservationUpcoming();
                        });
                    }
                });
            },
            viewUpcomingRes(value) {
                this.selected = value;
                this.start_date = this.formatDate(this.selected.reservation_details[0].start_date);
                this.end_date = this.formatDate(this.selected.reservation_details[0].end_date);
                this.total_payment = 0;
                for(let i = 0; i < this.selected.deposits.length; i++) {
                    if(this.selected.deposits[i].isAcknowledged == 1) {
                        this.total_payment += parseFloat(this.selected.deposits[i].amount);
                    }
                }

                //nights of stay
                let start_date = moment(this.selected.reservation_details[0].start_date).format('YYYY-MM-DD 00:00:00');
                let end_date = moment(this.selected.reservation_details[0].end_date).format('YYYY-MM-DD 00:00:00');

                let date1 = moment(start_date);
                let date2 = moment(end_date);
                this.nights_stay = date2.diff(date1, 'days');
            },
            getReservationUpcoming() {
                this.res_upcoming = [];

                axios.get('api/reservation/getReservationUpcoming')
                    .then(response => {
                        for(let i = 0; i < response.data.length; i++)
                        {
                            this.res_upcoming.push(response.data[i]);
                        }
                    });
            },
            getReservationOngoing() {
                this.res_ongoing = [];

                axios.get('api/reservation/getReservationOngoing')
                    .then(response => {
                        for(let i = 0; i < response.data.length; i++)
                        {
                            this.res_ongoing.push(response.data[i]);
                        }
                    });
            },
            formatNumber(num) {
                return '₱' + parseFloat(num).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
            },
            formatDate(value) {
                return moment(value).format('MMM. DD, YYYY')
            }
        },
        computed: {

        },
        created() {
            this.getReservationOngoing();
            this.getReservationUpcoming();
        }
    }
</script>
