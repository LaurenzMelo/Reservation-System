<template>
    <div>
        <div class="mt-4">
            <form-wizard title="Room Reservation" @on-complete="createReservation" shape="circle" subtitle="Reserve a room for your trip!" color="#68A6BF" error-color="#ff4949">
                <tab-content title="Find A Room" :before-change="firstValidation">
                    <div class="row mb-2">
                        <div class="col-md-12" v-if="booked.length != 0">
                            <h3 class="font-weight-bold font-oswald">Chosen Rooms</h3>
                            <hr style="width:5%; margin-top:3px; border-top:3px solid #68A6BF">
                            <div class="row">
                                <div class="col-md-6" v-for="book in booked">
                                    <div class="col-md-12 border shadow p-4">
                                        <div class="row">
                                            <div class="col-md-8" style="border-right: 3px solid #68A6BF">
                                                <h5 class="font-weight-bold mb-2">{{ book.name }}</h5>
                                                <div class="ml-1 mb-1">
                                                    ⎇ <span class="font-weight-bold"> Amenities: </span> {{ JSON.parse(book.amenities) }}
                                                </div>
                                                <div class="ml-1">
                                                    ⎇ <span class="font-weight-bold"> Capacity: </span> {{ book.capacity }} Person(s)
                                                </div>
                                            </div>
                                            <div class="col-md-4 pt-0 pr-0">
                                                <div class="text-right mb-2"><button type="button" class="btn btn-sm btn-danger font-white m-0" @click="removeRoom(book)"><i class="fas fa-minus"></i></button></div>
                                                <div class="d-flex justify-content-between">
                                                    Price Per Night: <span class="font-weight-bold mr-2"> {{ formatNumber(book.amount - (book.amount * 0.12)) }} </span>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    Tax & Fees: <span class="font-weight-bold mr-2"> {{ formatNumber(book.amount * 0.12) }} </span>
                                                </div>
                                                <hr>
                                                <div class="d-flex justify-content-between">
                                                    Total Amount: <span class="font-weight-bold mr-2"> {{ formatNumber(book.amount) }} </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="col-md-12 border p-4 shadow">
                                <h4 class="font-weight-bold text-center mb-4 font-oswald"> Initial Information </h4>
                                <v-date-picker
                                    v-model="check_date"
                                    is-range
                                    :masks="masks"
                                    color="blue"
                                    is-dark
                                    class="mt-1"
                                >
                                    <template v-slot="{ inputValue, inputEvents }">
                                        <div class="form-group">
                                            <label class="font-weight-bold"> Check In Date: </label>
                                            <input
                                                :value="inputValue.start"
                                                v-on="inputEvents.start"
                                                class="border p-2 rounded focus:outline-none focus:border-indigo-300 form-control"
                                                placeholder="Check In"
                                                :min-date="new Date()"
                                            />
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold"> Check Out Date: </label>
                                            <input
                                                :value="inputValue.end"
                                                v-on="inputEvents.end"
                                                class="border p-2 rounded focus:outline-none focus:border-indigo-300 form-control"
                                                placeholder="Check Out"
                                                :min-date="new Date()"
                                            />
                                        </div>
                                    </template>
                                </v-date-picker>
                                <!--<div class="form-group">
                                    <label class="font-weight-bold"> No. Of Room(s): </label>
                                    <select class="p-1 rounded border p-2 form-control" v-model="rooms_no">
                                        <option value="" disabled selected hidden>No. Of Room(s)</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>-->
                                <div class="form-group">
                                    <label class="font-weight-bold"> No. Of Guest(s): </label>
                                    <select class="p-1 rounded font-montserrat border p-2 form-control" v-model="guests_no">
                                        <option value="" disabled selected hidden>No. Of Guest(s)</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>

                                    </select>
                                </div>
                                <div class="text-center">
                                    <button type="button" @click="getVacantRooms()" class="btn btn-lg mt-2 text-center font-weight-bold text-white" style="background-color: #68A6BF"> Apply </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="col-md-12">
                                <div v-for="room in filtered_rooms">
                                    <div class="row border shadow" style="margin-bottom:2rem">
                                        <div class="col-md-4 font-small">
                                            <div v-if="room.image != null">
                                                <img class="room-img" :src="room.image" style="max-width: 100%; max-height:100%">
                                            </div>
                                            <div v-else class="text-center">
                                                <img class="product-img" src="images/rooms/placeholder.png" style="max-width: 100%; max-height:100%">
                                            </div>
                                        </div>
                                        <div class="col-md-4 font-small">
                                            <h5 class="font-weight-bold mt-2">{{ room.name }}</h5>
                                            <p class="text-indent-sentence text-justify">{{ room.description }}</p>
                                            <h6 class="mt-2"><span class="font-weight-bold">Room Capacity: </span> {{ room.capacity }}</h6>
                                        </div>
                                        <div class="col-md-4">
                                            <h5 class="font-weight-bold mt-2 text-center">Amenities & Inclusions</h5>
                                            <ul class="ml-5">
                                                <li v-for="text in JSON.parse(room.amenities)">
                                                    {{ text }}
                                                </li>
                                            </ul>
                                            <hr class="w-75 m-auto">
                                            <h5 class="font-weight-bold mt-2 text-center">Rate Per Night</h5>
                                            <p class="text-center font-weight-bold font-med">{{ formatNumber(room.amount) }}</p>
                                            <p class="text-center">{{ formatNumber(room.amount - (room.amount * 0.12)) }} + {{ formatNumber(room.amount * 0.12) }} (Tax & Fees)</p>
                                            <button type="button" class="btn btn-success text-white w-100" @click="bookRoom(room)"> Book </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </tab-content>
                <tab-content title="Fill Up Information">
                    <div class="container mb-2">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="col-md-12 shadow">
                                    <h4 class="font-weight-bold font-oswald">Tell us your particulars</h4>
                                    <hr style="width:10%; margin-top:3px; border-top:3px solid #68A6BF">
                                    <div class="user-forms mt-4">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Full Name <span v-if="form.name == ''" class="font-weight-bold" style="color:red">*</span></label>
                                            <input type="text" class="form-control" placeholder="e.g. Juan L. Dela Cruz" v-model="form.name" name="name">
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Email <span v-if="form.email == ''" class="font-weight-bold" style="color:red">*</span></label>
                                            <input type="email" class="form-control" placeholder="e.g. juandelacruz@email.com" v-model="form.email" name="email">
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Retype Email <span v-if="form.retype_email == ''" class="font-weight-bold" style="color:red">*</span></label>
                                            <input type="email" class="form-control" placeholder="e.g. juandelacruz@email.com" v-model="form.retype_email" name="retype_email">
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Contact Number <span v-if="form.contact_no == ''" class="font-weight-bold" style="color:red">*</span></label>
                                            <input type="text" class="form-control" placeholder="e.g. 09123456789" v-model="form.contact_no" name="contact_no">
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Date of Arrival & Other Requests <span v-if="form.requests == ''" class="font-weight-bold" style="color:red">*</span></label>
                                            <textarea class="form-control" rows="4" v-model="form.requests" placeholder="Date of Arrival & Other Requests" name="requests"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="col-md-12 shadow">
                                    <h5 class="font-weight-bold text-center mt-2 mb-3"> {{ check_in }} <span class="ml-2 mr-2">to</span> {{ check_out }}
                                        <br> {{ nights_stay }} <span v-if="nights_stay == 1">Night</span><span v-else>Nights</span>
                                    </h5>
                                    <hr>
                                    <div class="mb-3" v-for="book in booked">
                                        <h6>⤐ <span class="font-weight-bold mr-2">{{ book.name }}:</span> {{ formatNumber(book.amount) }}</h6>
                                        <span> (Per Night) {{ formatNumber(book.amount - (book.amount * 0.12)) }} + (Tax & Fee) {{ formatNumber(book.amount * 0.12) }}</span>
                                    </div>
                                    <hr>
                                    <div>
                                        <i class="fas fa-user-friends mr-2"></i> {{ guests_no }} <span v-if="guests_no == 1">Guest</span><span v-else>Guests</span>
                                    </div>
                                    <div>
                                        <i class="fas fa-hotel mr-2"></i> {{ booked.length }} <span v-if="booked.length == 1">Room</span><span v-else>Rooms</span>
                                    </div>
                                    <hr>
                                    <h6 class="text-center font-weight-bold"> Total Amount: {{ formatNumber(total_amount) }} </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </tab-content>
                <tab-content title="Confirmation" :before-change="secondValidation">
                    <div class="container mb-2 border shadow">
                        <h3 class="font-weight-bold font-oswald text-center mt-4">Reservation Summary</h3>
                        <hr class="m-auto w-25" style="border-top:3px solid #68A6BF">
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <h5 class="text-center font-weight-bold">Booking </h5>
                                    <hr class="m-auto" style="border-top:3px solid #68A6BF; width: 5%">
                                    <div class="mt-3"><span class="font-weight-bold">Date :</span> {{ check_in }} to {{ check_out }}</div>
                                    <div><span class="font-weight-bold">Night(s) of Stay :</span> {{ nights_stay }}</div>
                                    <hr>
                                    <div>
                                        <i class="fas fa-user-friends mr-2"></i> {{ guests_no }} <span v-if="guests_no == 1">Guest</span><span v-else>Guests</span>
                                    </div>
                                    <div>
                                        <i class="fas fa-hotel mr-2"></i> {{ booked.length }} <span v-if="booked.length == 1">Room</span><span v-else>Rooms</span>
                                    </div>
                                    <hr>
                                    <div class="mb-3" v-for="book in booked">
                                        <h6>⤐ <span class="font-weight-bold mr-2">{{ book.name }}:</span> {{ formatNumber(book.amount) }} * {{ nights_stay }} (<span class="font-weight-bold">Price per Night * Night(s) of Stay</span>)</h6>
                                        <span> {{ formatNumber(book.amount - (book.amount * 0.12)) }} + (Tax & Fee) {{ formatNumber(book.amount * 0.12) }}</span>
                                    </div>
                                    <hr>
                                    <h6 class="text-center font-weight-bold"> Total Amount: {{ formatNumber(total_amount) }} </h6>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <h5 class="text-center font-weight-bold">Personal Details</h5>
                                    <hr class="m-auto" style="border-top:3px solid #68A6BF; width: 5%">
                                    <div><span class="font-weight-bold">Full Name:</span> {{ form.name }}</div>
                                    <div><span class="font-weight-bold">Email Address:</span> {{ form.email }}</div>
                                    <div><span class="font-weight-bold">Contact Number:</span> {{ form.contact_no }}</div>
                                    <hr>
                                    <div>
                                        <span class="font-weight-bold"> Arrival Time & Other Requests: </span>
                                        <p class="text-justify text-indent-sentence">{{ form.requests }} </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </tab-content>
            </form-wizard>
        </div>
    </div>
</template>

<script>
    let moment = require('moment');

    export default {
        data() {
            return {
                check_date: [],
                vacant_rooms: [],
                filtered_rooms: [],
                booked: [],
                check_in: '',
                check_out: '',
                rooms_no: '',
                guests_no: '',
                nights_stay: 0,
                total_amount: 0,
                form: {
                    name: '',
                    email: '',
                    retype_email: '',
                    contact_no: '',
                    requests: '',
                },
                masks: {
                    input: 'MMM DD YYYY',
                },
            }
        },
        watch: {
            check_date: function (val) {
                //First computation of nights stay
                this.check_in = moment(this.check_date['start']).format('MMM. DD, YYYY');
                this.check_out = moment(this.check_date['end']).format('MMM. DD, YYYY');

                var date1 = moment(this.check_date['start']);
                var date2 = moment(this.check_date['end']);
                console.log(date1 + ' - ' + date2);
                console.log(date1);
                console.log(date2);
                this.nights_stay = date2.diff(date1, 'days');

                //After Changes
                this.total_amount = 0;
                var date1 = moment(val['start']);
                var date2 = moment(val['end']);
                var diff = date2.diff(date1, 'days');

                for (let i = 0; i < this.booked.length; i++) {
                    this.total_amount += parseFloat(this.booked[i].amount * diff);
                }
            }
        },
        methods: {
            createReservation() {
                Swal.fire({
                    title: 'Confirm Reservation?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Confirm'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.post('//' + window.location.host + '/booking/createReservation', {
                            name: this.form.name,
                            email: this.form.email,
                            contact_no: this.form.contact_no,
                            requests: this.form.requests,
                            check_in: moment(this.check_date['start']).format('YYYY-MM-DD 14:00:00'),
                            check_out: moment(this.check_date['end']).format('YYYY-MM-DD 12:00:00'),
                            amount: this.total_amount,
                            guest_no: this.guests_no,
                            rooms: this.booked,
                        }).then(response => {
                            Swal.fire(
                                'Success!',
                                'Your reservation is confirmed. Please check your email address for further details.',
                                'success'
                            )
                            const index = async function () {
                                await new Promise(resolve => {
                                    setTimeout(resolve, 5000)
                                })
                                window.location.replace('/');
                            }
                            index();
                        })
                    }
                })
            },
            bookRoom(room) {
                this.booked.push(room);
                this.filtered_rooms = this.filtered_rooms.filter(function(filter) {
                    return filter.id != room.id;
                })
                this.total_amount += parseFloat(room.amount * this.nights_stay);
            },
            removeRoom(room) {
                this.filtered_rooms.unshift(room);
                this.total_amount -= parseFloat(room.amount * this.nights_stay);

                for (let i = 0; i < this.booked.length; i++) {
                    if(this.booked[i].id == room.id) {
                        this.$delete(this.booked, i);
                    }
                }
            },
            firstValidation() {
                if (this.check_date.length == 0) {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Please fill up the check in & check out date',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    return false;
                } else if (this.guests_no == '') {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Please fill up the number of guest',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    return false;
                } else if(this.booked.length == 0) {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Choose a room first before proceeding to next step',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    return false;
                } else {
                    return true;
                }
            },
            secondValidation() {
                return true;
            },
            getVacantRooms() {
                axios.post('//' + window.location.host + '/booking/getVacantRooms', {
                    check_date: this.check_date,
                    rooms_no: this.rooms_no,
                    guests_no: this.guests_no,
                }).then(response => {
                    this.filtered_rooms = response.data.vacant_rooms;
                })
            },
            formatNumber(num) {
                return '₱' + parseFloat(num).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
            },
        },
        mounted() {

        }
    }
</script>
