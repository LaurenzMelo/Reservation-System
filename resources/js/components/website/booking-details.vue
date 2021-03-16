<template>
    <div style="min-height: 51vh">
        <div class="mt-4 mb-4">
            <div class="container-fluid">
                <div class="text-center">
                    <h1 class="font-oswald">Already have a booking?</h1>
                </div>
                <div class="row mt-4">
                    <div class="col-md-6" style="border-right: 3px solid #68A6BF">
                        <div class="col-md-12 mb-2">
                            <h4 class="text-center">Check Your Booking</h4>
                            <button type="button" class="btn btn-primary w-100 text-white font-weight-bold mt-2" @click="buttonOption(a='Check')">Check Booking</button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-12 mb-2">
                            <h4 class="text-center">Upload Payment Receipt</h4>
                            <button type="button" class="btn btn-primary w-100 text-white font-weight-bold mt-2" @click="buttonOption(a='Upload')">Upload Payment</button>
                        </div>
                    </div>
                </div>
                <div class="row" v-if="but_option != ''">
                    <div class="col-md-12 text-center mt-2">
                        <h4 class="font-weight-bold">{{ but_option }}</h4>
                    </div>
                    <div class="col-md-12 text-center">
                        <div v-if="but_option == 'Check Your Booking'">
                            <form @submit.prevent="checkRes()">
                                <input type="text" class="form-control w-50 m-auto" placeholder="Input Your Reservation Number Here" name="res_num" v-model="res_no" required>
                                <button type="submit" class="btn btn-success w-25 text-white font-weight-bold mt-2">Submit</button>
                            </form>
                        </div>
                        <div v-else>
                            <form @submit.prevent="sendPayment()">
                                <div class="row mb-2">
                                    <div class="col-md-3 offset-md-3">
                                        <label class="font-weight-bold"> Bank Name </label>
                                        <input type="text" class="form-control w-100 m-auto" placeholder="Bank Name" name="res_num" v-model="bank_name" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="font-weight-bold"> Time Deposited </label>
                                        <input type="text" class="form-control w-100 m-auto" placeholder="Time Deposited" name="res_num" v-model="time_deposited" required>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-3 offset-md-3">
                                        <label class="font-weight-bold">Reservation Number</label>
                                        <input type="text" class="form-control w-100 m-auto" placeholder="Input Your Reservation Number Here" name="res_num" v-model="res_no" required>
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <label class="font-weight-bold">Payment Slip</label>
                                        <div class="d-flex align-items-center">
                                            <input type="file" class="form-control" name="payment_slip" id="payment_slip_id" accept="image/png, image/jpeg, .xlsx, .docx, .pdf">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success w-25 text-white font-weight-bold mt-2">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" v-if="res_details != ''">
                    <hr style="width:75%; margin-top:3px; border-top:3px solid #68A6BF; margin-top:20px !important" class="m-auto">
                    <h3 class="font-weight-bold font-oswald text-center mt-4">Reservation Summary</h3>
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <div class="col-md-12 text-center">
                                <h5 class="text-center font-weight-bold">Booking </h5>
                                <hr class="m-auto" style="border-top:3px solid #68A6BF; width: 5%">
                                <div class="mt-3"><span class="font-weight-bold">Date :</span> {{ formatDate(res_details.reservation_details[0].start_date) }} to {{ formatDate(res_details.reservation_details[0].end_date) }}</div>
                                <div>
                                    <span class="font-weight-bold">Night(s) of Stay :</span> {{ nights_stay }}
                                </div>
                                <hr>
                                <div>
                                    <i class="fas fa-user-friends mr-2"></i> {{ res_details.guest_no }} <span v-if="res_details.guest_no == 1">Guest</span><span v-else>Guests</span>
                                </div>
                                <div>
                                    <i class="fas fa-hotel mr-2"></i> {{ res_details.reservation_details.length }} <span v-if="res_details.reservation_details.length == 1">Room</span><span v-else>Rooms</span>
                                </div>
                                <hr>
                                <h6 class="text-center font-weight-bold"> Total Amount: {{ formatNumber(res_details.amount) }} </h6>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="col-md-12">
                                <h5 class="text-center font-weight-bold">Personal Details</h5>
                                <hr class="m-auto" style="border-top:3px solid #68A6BF; width: 5%">
                                <div><span class="font-weight-bold">Full Name:</span> {{ res_details.name }}</div>
                                <div><span class="font-weight-bold">Email Address:</span> {{ res_details.email }}</div>
                                <div><span class="font-weight-bold">Contact Number:</span> {{ res_details.contact_no }}</div>
                                <div>
                                    <span class="font-weight-bold"> Arrival Time & Other Requests: </span>
                                    <p class="text-justify text-indent-sentence">{{ res_details.requests }} </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="col-md-12">
                                <h5 class="text-center font-weight-bold">Rooms</h5>
                                <hr class="m-auto" style="border-top:3px solid #68A6BF; width: 5%">
                                <div v-for="rooms in res_details.reservation_details">
                                    <div class="font-weight-bold"> {{ rooms.rooms.name }} </div>
                                    <p class="text-justify text-indent-sentence"> Capacity: {{ rooms.rooms.capacity }} </p>
                                    <p class="text-justify text-indent-sentence"> Amenities: {{ JSON.parse(rooms.rooms.amenities) }} </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    let moment = require('moment');

    export default {
        data() {
            return {
                but_option: '',
                res_no: '',
                nights_stay: 0,
                res_details: [],
                bank_name: '',
                time_deposited: '',
            }
        },
        methods: {
            sendPayment() {
                let formData = new FormData()

                var payment = document.querySelector('#payment_slip_id');
                formData.append('payment_slip', payment.files[0]);
                formData.append('bank_name', this.bank_name);
                formData.append('time_deposited', this.time_deposited);
                formData.append('res_no', this.res_no);

                axios.post('//' + window.location.host + '/booking/savePayment', formData)
                .then(() => {

                });
            },
            buttonOption(a)
            {
                if (a == 'Upload') {
                    this.res_details = [];
                    this.but_option = 'Upload Your Payment Receipt';
                } else {
                    this.res_details = [];
                    this.but_option = 'Check Your Booking';
                }
            },
            checkRes() {
                axios.post('//' + window.location.host + '/booking/checkReservation', {
                    res_no: this.res_no,
                }).then(response => {
                    this.res_details = response.data.details;

                    let start_date = moment(this.res_details.reservation_details[0].start_date).format('YYYY-MM-DD 00:00:00');
                    let end_date = moment(this.res_details.reservation_details[0].end_date).format('YYYY-MM-DD 00:00:00');

                    let date1 = moment(start_date);
                    let date2 = moment(end_date);
                    this.nights_stay = date2.diff(date1, 'days');
                });
            },
            formatNumber(num) {
                return '₱' + parseFloat(num).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
            },
            formatDate(value) {
                return moment(value).format('MMM. DD, YYYY')
            }
        },
        mounted() {

        }
    }
</script>
