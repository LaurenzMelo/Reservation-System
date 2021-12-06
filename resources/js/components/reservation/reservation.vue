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
                            <input class="form-check-input" type="radio" name="ongoing" id="App" value="On Going" v-model="res_option">
                            <label class="form-check-label">Checked In</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="expired" id="Exp" value="Expired" v-model="res_option">
                            <label class="form-check-label">Expired</label>
                        </div>
                    </div>
                </div>

                <!-- Upcoming Reservations -->
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
                            <template v-slot:item.reservation_details[0].start_date="{ item }">
                                {{ formatDate(item.reservation_details[0].start_date) }}
                            </template>
                            <template v-slot:item.reservation_details[0].end_date="{ item }">
                                {{ formatDate(item.reservation_details[0].end_date) }}
                            </template>
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
                                <div v-if="item.is_paid == 0 && item.payment == 0">
                                    Unpaid
                                </div>
                                <div v-else-if="item.is_paid == 0 && item.payment != 0">
                                    Incomplete
                                </div>
                                <div v-else-if="item.is_paid == 0 && item.payment > 0">
                                    Needs refund
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

                <!-- On Going Reservations -->
                <div class="col-md-12" v-else-if="res_option == 'On Going'">
                    <v-card>
                        <v-card-title>
                            Checked in Reservation List
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
                            <template v-slot:item.reservation_details[0].start_date="{ item }">
                                {{ formatDate(item.reservation_details[0].start_date) }}
                            </template>
                            <template v-slot:item.reservation_details[0].end_date="{ item }">
                                {{ formatDate(item.reservation_details[0].end_date) }}
                            </template>
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
                                <div v-if="item.is_paid == 0  && item.payment == 0">
                                    Unpaid
                                </div>
                                <div v-else-if="item.is_paid == 0 && item.payment != 0">
                                    Incomplete
                                </div>
                                <div v-else-if="item.is_paid == 0 && item.payment > 0">
                                    Needs refund
                                </div>
                                <div v-else>
                                    Paid
                                </div>
                            </template>
                            <template v-slot:item.actions="{ item }">
                                <button
                                    class="btn btn-success btn-sm"
                                    v-if="item.amenities == null"
                                    data-toggle="modal"
                                    data-target="#addAmenities"
                                    @click="selectedRes(item)"
                                >
                                    <i class="fas fa-plus"></i>
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
                                    @click="checkOut(item)"
                                >
                                    <i class="fas fa-door-closed"></i>
                                </button>
                                <button class="btn btn-info btn-sm"
                                        @click="printReceipt(item)">
                                    T
                                </button>
                            </template>
                        </v-data-table>
                    </v-card>
                </div>

                <!-- Expired Reservations -->
                <div class="col-md-12" v-else>
                    <v-card>
                        <v-card-title>
                            Expired Reservation List
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
                            :items="res_expired"
                            :search="search"
                            class="elevation-1 mt-4 border shadow text-center"
                        >
                            <template v-slot:item.reservation_details[0].start_date="{ item }">
                                {{ formatDate(item.reservation_details[0].start_date) }}
                            </template>
                            <template v-slot:item.reservation_details[0].end_date="{ item }">
                                {{ formatDate(item.reservation_details[0].end_date) }}
                            </template>
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
                                <div class="form-group ml-4">
                                    <div class="row">
                                         <div class="col-md-6 text-center">
                                            <label class="font-weight-bold"> Total Amount </label>
                                            <p> {{ formatNumber(selected.amount) }} </p>
                                        </div>
                                        <div class="col-md-6 text-center">
                                            <label class="font-weight-bold"> Balance </label>
                                            <p> {{ formatNumber(selected.amount - total_payment) }} </p>
                                            <span v-if="selected.amount < total_payment" style="color: red; font-size: 13px"> Negative Balance means that we have to refund it. </span>
                                        </div>
                                    </div>
                                   
                                </div>
                                <hr>
                                <div class="form-group ml-4">
                                    <label class="font-weight-bold"> Payments Made </label>
                                    <div v-for="payments in selected.deposits">
                                        <p class="text-indent-sentence" v-if="payments.deposit_img == 'Cash'"> Cash </p>
                                        <p class="text-indent-sentence" v-else> Online </p>
                                        <p class="text-indent-sentence">
                                            {{ payments.bank }} - {{ payments.time_deposited }} - {{ formatNumber(payments.amount) }} -
                                            <span v-if="payments.isAcknowledged == 0"> <b>Not</b> Acknowledged </span> <span v-else> Acknowledged </span>
                                        </p>
                                        <hr class="w-50" style="border-top:2px solid #68A6BF;">
                                    </div>
                                </div>
                                <div class="form-group ml-4 text-center">
                                    <label class="font-weight-bold"> Total Approved Amount</label>
                                    <p>{{ formatNumber(total_payment) }}</p>
                                </div>
                                <div class="form-group ml-4">
                                    <label class="font-weight-bold" v-if="selected.is_checked_in != 1"> Make Payment (In Cash) </label>
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

        <div class="modal fade" id="addAmenities" tabindex="-1" role="dialog" aria-labelledby="addAmenitiesLabel" aria-hidden="true" v-if="selected != []">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addAmenitiesLabel"> <b>Add Amenities</b> for Reservation {{ selected.reservation_no }} </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" value="bed_1" id="bed1" v-model="amenities">
                            <label class="form-check-label" for="bed1">
                                Bed 1 - ₱250
                            </label>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" value="bed_2" id="bed2" v-model="amenities">
                            <label class="form-check-label" for="bed2">
                                Bed 2 - ₱250
                            </label>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" value="person_1" id="person1" v-model="amenities">
                            <label class="form-check-label" for="person1">
                                Person 1 - ₱250
                            </label>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" value="person_2" id="person2" v-model="amenities">
                            <label class="form-check-label" for="person2">
                                Person 2 - ₱250
                            </label>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" value="karaoke" id="karaoke" v-model="amenities">
                            <label class="form-check-label" for="karaoke">
                                Karaoke - ₱100/hr
                            </label>
                            <input type="number" v-if="amenities.includes('karaoke')" v-model="karaoke_hrs" class="form-control">
                            <span v-if="amenities.includes('karaoke')" class="font-weight-bold" style="font-size: 13px"> Karaoke Hours is up to 14 hours only. </span>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" value="common_kitchen" id="kitchen" v-model="amenities">
                            <label class="form-check-label" for="kitchen">
                                Common Kitchen - ₱500
                            </label>
                        </div>
                        <hr>
                        <div>
                            Total: <b>₱{{ total_amount }}</b>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary text-white" @click="confirm()"> Confirm </button>
                        <button type="button" class="btn btn-secondary text-white" data-dismiss="modal" @click="cancelClick()"> Close </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-none">
            <table class="table table-striped room-list" id="this_is_id" v-if="click_checkOut === true">
                <thead>
                <tr>
                    <th class="font-weight-bold text-center" scope="col">Date</th>
                    <th class="font-weight-bold text-center" scope="col">Description</th>
                    <th class="font-weight-bold text-center" scope="col">Quantity</th>
                    <th class="font-weight-bold text-center" scope="col">Amount</th>
                </tr>
                </thead>
                <tbody>
                    <tr v-for="c in checkOut_select.reservation_details" :key="c.id">
                        <td>
                            {{ formatDate(c.created_at) }}
                        </td>
                        <td>
                            Room Charge - {{ c.rooms.name }}
                        </td>
                        <td>
                            1
                        </td>
                        <td>                           
                            {{ c.rooms.amount * stay }} 
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    import jsPDF from 'jspdf'
    import autoTable from 'jspdf-autotable'

    export default {
        props: ['auth'],
        data() {
            return {
                headers: [
                    { text: 'Reservation Number', value: 'reservation_no', class: 'text-center'},
                    { text: 'Check In', value: 'reservation_details[0].start_date', class: 'text-center' },
                    { text: 'Check Out', value: 'reservation_details[0].end_date', class: 'text-center' },
                    { text: 'Amount', value: 'amount', class: 'text-center' },
                    { text: 'Payment', value: 'payment', class: 'text-center' },
                    { text: 'Remaining', value: 'remaining', class: 'text-center' },
                    { text: 'Status', value: 'is_paid', class: 'text-center' },
                    { text: 'Action', value: 'actions', class: 'text-center w-15'},
                ],
                res_upcoming: [],
                res_ongoing: [],
                res_expired: [],
                selected: [],
                start_date: '',
                end_date: '',
                res_option: 'Upcoming',
                search: '',
                nights_stay: 0,
                total_payment: 0,
                payment_cash: 0,
                pay_trigger: false,
                amenities: [],
                total_amount: 0,
                karaoke_hrs: 0,
                karaoke_amount: 0,
                click_checkOut: false,
                checkOut_select: [],
                stay: 0,
            }
        },
        watch: {
            amenities: function (val) {
                this.total_amount = 0;
                for(let i = 0; i < val.length; i++) {
                    if (val[i] == 'bed_1' || val[i] == 'bed_2' || val[i] == 'person_1' || val[i] == 'person_2') {
                        this.total_amount += 250;
                    }
                    if(val[i] == 'karaoke' && this.karaoke_hrs != 0 ) {
                        this.total_amount += this.karaoke_hrs * 100
                    }
                    if(val[i] == 'common_kitchen') {
                        this.total_amount += 500;
                    }
                }
            },
            karaoke_hrs: function (val) {
                const indexAm = this.amenities.indexOf("karaoke")
                this.amenities.splice(indexAm, 1)
                this.amenities.push('karaoke')
            }
        },
        methods: {
            confirm() {
                if (this.amenities.length == 0) {
                    Swal.fire(
                        'Error',
                        'Please select amenities.',
                        'error'
                    )
                } else if (this.amenities.includes('karaoke') && this.karaoke_hrs <= 0 || this.karaoke_hrs > 14) {
                    Swal.fire(
                        'Error',
                        'Karaoke hours invalid.',
                        'error'
                    )
                } else {
                     Swal.fire({
                        title: 'Confirm Added Amenities?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes'
                    }).then((result) => {
                        if (result.value) {
                            let loader = this.$loading.show();
                            axios.post('api/reservation/addAmenities', {
                                id: this.selected.id,
                                amenities: this.amenities,
                                total_amount: this.total_amount
                            }).then(response => {
                                setTimeout(() => {
                                    loader.hide()
                                },500)
                                Swal.fire(
                                    'Complete!',
                                    'Amenities Added Successfully.',
                                    'success'
                                )

                                // location.reload();
                            });
                        }
                    });
                }
            },
            selectedRes(item) {
                this.selected = item
            },
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
                            let loader = this.$loading.show();
                            axios.post('api/reservation/payCash', {
                                id: this.selected.id,
                                payment_cash: this.payment_cash
                            }).then(response => {
                                setTimeout(() => {
                                    loader.hide()
                                },10)
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
            checkOut(val) {
                if(val.is_paid != 1) {
                    Swal.fire(
                        'Error',
                        'Please settle your payment for amenities first.',
                        'error'
                    )
                } else {
                    Swal.fire({
                        title: 'Check Out?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes'
                    }).then((result) => {
                        if (result.value) {
                            let loader = this.$loading.show();
                            axios.post('api/reservation/checkOut', {
                                id: val.id,
                            }).then(response => {
                                setTimeout(() => {
                                    loader.hide()
                                },500)
                                console.log(response.data)
                                Swal.fire(
                                    'Complete!',
                                    'Payment Successful',
                                    'success'
                                )

                                var this2 = this;
                                const f = async function () { 
                                    let start_date = moment(response.data.reservation_details[0].start_date).format('YYYY-MM-DD 00:00:00');
                                    let end_date = moment(response.data.reservation_details[0].end_date).format('YYYY-MM-DD 00:00:00');

                                    let date1 = moment(start_date);
                                    let date2 = moment(end_date);
                                    this2.stay = date2.diff(date1, 'days');
                                    this2.click_checkOut = true;
                                    this2.checkOut_select = response.data; 
                                    
                                    await new Promise(resolve => {
                                        setTimeout(resolve,100)
                                    })
                                    this2.printReceipt(this2.checkOut_select);
                                }
                                f();

                                this.getReservationUpcoming();
                                this.getReservationOngoing();
                            })
                        }
                    });
                }
            },
            printReceipt(res) {
                let date_today = moment(Date.now()).format('MMM. DD, YYYY')
                let arrival_date = moment(res.reservation_details[0].start_date).format('MMM. DD, YYYY')
                let dep_date = moment(res.reservation_details[0].end_date).format('MMM. DD, YYYY')

                let max = 999999;
                let min = 111111;
                let invoice_no = 'CN-' + String(Math.floor(Math.random() * (max - min + 1) + min));

                let balance_due = res.amount - res.payment;

                const doc = new jsPDF()
                const logo = new Image()
                logo.src = '/images/logo.png'
                
                doc.addImage(logo, 'PNG', 80, 5, 50, 50, 'left');

                doc.setFont('Courier', 'bold');
                doc.setFontSize(16);
                doc.text('Invoice', 90, 55);

                doc.setFont('Courier', 'normal');
                doc.setFontSize(12);
                doc.text('Date: ', 145, 65);
                doc.setFont('Courier', 'bold');
                doc.text(date_today, 160, 65);

                doc.setFont('Courier', 'normal');
                doc.text('Bill To:', 10, 85);
                doc.setFont('Courier', 'bold');
                doc.text(res.first_name + ' ' + res.last_name, 32, 85);

                doc.setFont('Courier', 'normal');
                doc.text('Invoice No.:', 10, 90);
                doc.setFont('Courier', 'bold');
                doc.text(invoice_no, 42, 90);

                doc.setFont('Courier', 'normal');
                doc.text('Arrival Date: ', 125, 105);
                doc.text('Departure Date: ', 120, 110);
                doc.setFont('Courier', 'bold');
                doc.text(arrival_date, 160, 105);
                doc.text(dep_date, 160, 110);

                doc.setFont('Courier', 'normal');
                doc.autoTable({ html: '#this_is_id',
                    headStyles:{ fillColor: [34, 35, 36], halign:'center'},
                    styles:{cellPadding: 2, fontSize:10,},
                    columnStyles: {
                        0: {cellWidth: 40, halign:'center'},
                        1: {cellWidth: 60, halign:'center'},
                        2: {cellWidth: 40, halign:'center'},
                        3: {cellWidth: 40, halign:'center'},
                    },
                    startY:130,
                });

                let finalY = doc.lastAutoTable.finalY + 40;
                
                doc.text('Total Amount:', 100, finalY);
                doc.setFont('Courier', 'bold');
                doc.text(this.withoutPeso(res.amount), 160, finalY)

                finalY += 5;

                doc.setFont('Courier', 'normal');
                doc.text('Payment Received:', 100, finalY);
                doc.setFont('Courier', 'bold');
                doc.text(this.withoutPeso(res.payment), 160, finalY)

                finalY += 5;

                doc.setFont('Courier', 'normal');
                doc.text('Balance Due:', 100, finalY);
                doc.setFont('Courier', 'bold');
                if(balance_due <= 0) {
                    doc.text(this.withoutPeso(0), 160, finalY)
                } else {
                    doc.text(this.withoutPeso(res.amount - res.payment), 160, finalY)
                }

                finalY += 30

                doc.setLineWidth(0.5);
                doc.line(125, finalY, 193, finalY);
                doc.line(20, finalY, 88, finalY);

                finalY += 5

                doc.setFont('Courier', 'bold');
                doc.text('Guest Signature', 140, finalY)
                doc.text('Admin Signature', 33, finalY)

                doc.save('Sample.pdf');
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
                            let loader = this.$loading.show();
                            axios.post('api/reservation/checkIn', {
                                id: item.id,
                            }).then(response => {
                                setTimeout(() => {
                                    loader.hide()
                                },10)
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

                // else if(date_now != date_with_time) {
                //     Swal.fire(
                //         'Unable to Check In',
                //         'The Date of Check In is not met.',
                //         'error'
                //     )
                // } 
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
            getReservationExpired() {
                this.res_expired = [];

                axios.get('api/reservation/getReservationExpired')
                    .then(response => {
                        for(let i = 0; i < response.data.length; i++)
                        {
                            this.res_expired.push(response.data[i]);
                        }
                    });
            },
            checkExpiredReservation() {
                axios.post('api/reservation/checkExpiredReservation', {
                    datetime: moment(Date.now()).format('YYYY-MM-DD HH:mm:ss')
                }).then(response => {

                })
            },
            formatNumber(num) {
                return '₱' + parseFloat(num).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
            },
            withoutPeso(num) {
                return parseFloat(num).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
            },
            formatDate(value) {
                return moment(value).format('MMM. DD, YYYY')
            }
        },
        created() {
            this.checkExpiredReservation();
            this.getReservationOngoing();
            this.getReservationUpcoming();
            this.getReservationExpired();
        }
    }
</script>
