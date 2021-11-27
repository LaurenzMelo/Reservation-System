<template>
    <div>
        <img src="images/rooms-web.jpg" style="margin-top:-100px; width:100%" class="cover-image">
        <div class="bg-text">
            <span class="font-weight-bold font-oswald room-header">ROOMS</span>
            <hr style="border-top: 2px solid white; width: 20%; margin:auto; margin-top:20px; margin-bottom:20px">
            <span class="room-desc">
                Here are the list of rooms that Sand Bar Beach Resort offers.
                Please take a look and choose what lavishes you!
            </span>
        </div>
        <div class="container pt-5">
            <div class="col-md-12 mb-5">
                <h5 class="text-center font-weight-bold mb-4"> Check Available Dates Here </h5>
                <v-date-picker
                    v-model="check_date"
                    is-range
                    :masks="masks"
                    color="blue"
                    is-dark
                    :min-date="add_date"
                    class="mt-1"
                >
                    <template v-slot="{ inputValue, inputEvents }">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="font-weight-bold"> Check In Date: </label>
                                    <input
                                        :value="inputValue.start"
                                        v-on="inputEvents.start"
                                        class="border p-2 rounded focus:outline-none focus:border-indigo-300 form-control"
                                        placeholder="Check In"
                                    />
                                </div>
                            </div>
                            <div class="col-md-5">
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
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-success sub-but-rooms font-white" @click="checkDate"> Submit </button>
                            </div>
                        </div>
                    </template>
                </v-date-picker>
            </div>
            <div class="row mb-4 mobile-remove">
                <div class="col-md-3 offset-md-4 font-weight-bold pb-0 mb-0 font-med">
                    Description
                    <hr style="width:15%; margin-top:3px; border-top:3px solid #68A6BF">
                </div>
                <div class="col-md-3 font-weight-bold pb-0 mb-0 font-med">
                    More Info
                    <hr style="width:15%; margin-top:3px; border-top:3px solid #68A6BF">
                </div>
                <div class="col-md-2 font-weight-bold pb-0 mb-0 font-med">
                    Amount
                    <hr style="width:20%; margin-top:3px; border-top:3px solid #68A6BF">
                </div>
            </div>

            <div v-for="room in rooms" :key="room.id">
                <div class="row" style="margin-bottom:5rem">
                    <div class="col-md-4 font-small p-0" style="border-bottom: 5px solid #68A6BF">
                        <div v-if="room.image != null">
                            <img class="room-img" :src="room.image" style="max-width: 100%; max-height:100%">
                        </div>
                        <div v-else class="text-center">
                            <img class="product-img" src="images/rooms/placeholder.png" style="max-width: 100%; max-height:100%">
                        </div>
                    </div>
                    <div class="col-md-3 font-small" style="border-bottom: 5px solid #68A6BF">
                        <h6 class="font-weight-bold">{{ room.name }}</h6>
                        <p class="text-indent-sentence text-justify">{{ room.description }}</p>
                    </div>
                    <div class="col-md-3 font-small" style="border-bottom: 5px solid #68A6BF">
                        <h6 class="font-weight-bold text-center">Inclusions</h6>
                        <ul class="ml-5">
                            <li v-for="text in JSON.parse(room.amenities)">
                                {{ text }}
                            </li>
                        </ul>
                        <h6 class="font-weight-bold text-center">Capacity</h6>
                        <p class="text-center">Up to <span class="font-weight-bold">{{ room.capacity }}</span> Guests</p>
                    </div>
                    <div class="col-md-2 font-xl text-center font-weight-bold remove-top" style="border-bottom: 5px solid #68A6BF; padding-top:5rem">
                        {{ formatNumber(room.amount) }}
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
                rooms: [],
                unique_rooms: [],
                masks: {
                    input: 'MMM DD YYYY',
                },
                check_date: '',
                add_date: new Date().getTime() + 172800000,
                amenities: ['Shower','No Smoking', 'Aircon']
            }
        },
        methods: {
            checkDate() {
                const check_in = moment(this.check_date['start']).format('MMM. DD, YYYY')
                const check_out = moment(this.check_date['end']).format('MMM. DD, YYYY')

                if(this.check_date === '') {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: "Please select a date.",
                        showConfirmButton: false,
                        timer: 1500
                    })
                } else if (check_in == check_out) {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: "Can't pick same day.",
                        showConfirmButton: false,
                        timer: 1500
                    })
                } else {
                    window.location.replace('/booking?' + JSON.stringify(this.check_date));
                }
                
            },
            getRooms() {
                axios.get('//' + window.location.host + '/getRoomsWebsite')
                .then(response => {
                    for(let i = 0; i < response.data.length; i++) {
                        if (response.data[i].name != 'Villa Family Room 2' &&
                            response.data[i].name != 'Family Deluxe Room 2' && response.data[i].name != 'Family Deluxe Room 3' &&
                            response.data[i].name != 'Family Deluxe Room 4' && response.data[i].name != 'Family Regular Room 2' &&
                            response.data[i].name != 'Standard Room 2' && response.data[i].name != 'Standard Room 3' &&
                            response.data[i].name != 'Standard Room 4' && response.data[i].name != 'Standard Room 5' &&
                            response.data[i].name != 'Standard Room 6' && response.data[i].name != 'Standard Room 7' &&
                            response.data[i].name != 'Standard Room 8' && response.data[i].name != 'Twin Room 2')
                        {
                            this.rooms.push(response.data[i]);
                        }
                    }
                })
            },
            formatNumber(num) {
                return '₱ ' + num.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
            },
        },
        mounted() {
            this.current_date = moment().format();
            this.getRooms();
        }
    }
</script>
