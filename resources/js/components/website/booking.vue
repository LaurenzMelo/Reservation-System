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
                                    :min-date="new Date()"
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
                                <div class="text-center">
                                    <button type="button" @click="getVacantRooms()" class="btn btn-lg mt-2 text-center font-weight-bold text-white" style="background-color: #68A6BF"> Apply </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="col-md-12">
                                <div v-for="room in filtered_rooms" style="margin-bottom:2rem">
                                    <div class="row border shadow">
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
                                            <button type="button" class="btn btn-primary text-white w-100" data-toggle="modal" data-target="#guestModal" @click="toggleGuest(room)"> Book </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="guestModal" tabindex="-1" role="dialog" aria-labelledby="guestModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"> Book {{ selected_toggle.name }} </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form @submit.prevent="bookRoom(selected_toggle)">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <div class="font-weight-bold"> Please Enter Number of Guest: </div>
                                                <input type="number" class="form-control" v-model="specific_guests_no" placeholder="No. Of Guest(s)" required>
                                                <div style="color:red; font-size: 10px"> Maximum of {{ selected_toggle.capacity }} </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger text-white" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success text-white"> Book </button>
                                        </div>
                                    </form>
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
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="font-weight-bold">First Name <span v-if="form.first_name == ''" class="font-weight-bold" style="color:red">*</span></label>
                                                    <input type="text" class="form-control" placeholder="e.g. Juan" v-model="form.first_name" name="first_name">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="font-weight-bold">Last Name <span v-if="form.last_name == ''" class="font-weight-bold" style="color:red">*</span></label>
                                                    <input type="text" class="form-control" placeholder="e.g. Dela Cruz" v-model="form.last_name" name="first_name">
                                                </div>
                                            </div>
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
                                            <label class="font-weight-bold"> Time of Arrival <span v-if="form.requests == ''" class="font-weight-bold" style="color:red">*</span></label>
                                            <textarea class="form-control" rows="4" v-model="form.requests" placeholder="Time of Arrival & other requests" name="requests"></textarea>
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
                                        <div> <span class="font-weight-bold mr-2">Room Price Breakdown:</span> {{ formatNumber(book.amount - (book.amount * 0.12)) }} + (Tax & Fee) {{ formatNumber(book.amount * 0.12) }}</div>
                                    </div>
                                    <hr>
                                    <h6 class="text-center font-weight-bold"> Total Amount: {{ formatNumber(total_amount) }} </h6>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <h5 class="text-center font-weight-bold">Personal Details</h5>
                                    <hr class="m-auto" style="border-top:3px solid #68A6BF; width: 5%">
                                    <div><span class="font-weight-bold">Full Name:</span> {{ form.first_name }} {{ form.last_name }}</div>
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
    import 'vue-loading-overlay/dist/vue-loading.css';

    export default {
        data() {
            return {
                check_date: [],
                vacant_rooms: [],
                filtered_rooms: [],
                booked: [],
                selected_toggle: [],
                check_in: '',
                check_out: '',
                rooms_no: '',
                specific_guests_no: '',
                guests_no: 0,
                nights_stay: 0,
                total_amount: 0,
                isLoading: false,
                form: {
                    first_name: '',
                    last_name: '',
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
                this.check_out = moment(this.check_date['end']).format('MMM. DD, YYYY')

                if(this.check_in == this.check_out) {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: "Can't pick same day.",
                        showConfirmButton: false,
                        timer: 1500
                    })
                }

                var date1 = moment(this.check_date['start']);
                var date2 = moment(this.check_date['end']);
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
            toggleGuest(room) {
                this.selected_toggle = room;
            },
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
                        let loader = this.$loading.show();
                        axios.post('//' + window.location.host + '/booking/createReservation', {
                            first_name: this.form.first_name,
                            last_name: this.form.last_name,
                            email: this.form.email,
                            contact_no: this.form.contact_no,
                            requests: this.form.requests,
                            check_in: moment(this.check_date['start']).format('YYYY-MM-DD 14:00:00'),
                            check_out: moment(this.check_date['end']).format('YYYY-MM-DD 12:00:00'),
                            amount: this.total_amount,
                            guest_no: this.guests_no,
                            rooms: this.booked,
                        }).then(response => {
                            setTimeout(() => {
                                loader.hide()
                            },10)
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
                if(room.capacity < parseFloat(this.specific_guests_no)) {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'No. of guest(s) cannot exceed maximum capacity of the room',
                        text: 'Maximum Capacity: ' + room.capacity,
                        showConfirmButton: false,
                        timer: 2000
                    })
                    this.specific_guests_no = '';
                } else if(parseFloat(this.specific_guests_no) == 0) {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'No. of guest(s) cannot be zero (0)',
                        showConfirmButton: false,
                        timer: 2000
                    })
                } else {
                    this.guests_no += parseFloat(this.specific_guests_no);
                    this.booked.push(room);
                    this.filtered_rooms = this.filtered_rooms.filter(function(filter) {
                        return filter.id != room.id;
                    })
                    this.total_amount += parseFloat(room.amount * this.nights_stay);
                    this.specific_guests_no = '';
                    $('#guestModal').modal('hide');
                }
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
                    /*var numberOfCapacity = 0;
                    for(let i = 0; i < this.booked.length; i++) {
                        numberOfCapacity += parseFloat(this.booked[i].capacity)
                    }
                    if(this.guests_no > numberOfCapacity) {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Room Capacity cannot accommodate your number of guest(s).',
                            showConfirmButton: false,
                            timer: 2500
                        })
                        return false;
                    } else {
                        return true;
                    }*/
                    return true;
                }
            },
            secondValidation() {
                return true;
            },
            getVacantRooms() {
                if(this.check_in == this.check_out) {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: "Check in and Check out date must not be the same date.",
                        showConfirmButton: false,
                        timer: 1500
                    })
                } else {
                    axios.post('//' + window.location.host + '/booking/getVacantRooms', {
                        check_date: this.check_date,
                        rooms_no: this.rooms_no,
                        guests_no: this.guests_no,
                    }).then(response => {
                        this.filtered_rooms = response.data.vacant_rooms;
                    })
                }
            },
            formatNumber(num) {
                return '₱' + parseFloat(num).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
            },
        },
        mounted() {

        }
    }
</script>
