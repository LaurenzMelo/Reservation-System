<template>
    <div class="col-md-12">
        <div class="card mb-5 mt-2 border shadow">
            <div class="col-md-12">
                <v-card>
                    <v-card-title>
                        Upcoming Reservation List
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
                                data-toggle="modal"
                                data-target="#changeRoom"
                                @click="changeRoomSelect(item)"
                            >
                                <i class="fas fa-exchange-alt"></i>
                            </button>
                        </template>
                    </v-data-table>
                </v-card>
            </div>
        </div>
        <div class="modal fade" id="changeRoom" tabindex="-1" role="dialog" aria-labelledby="changeRoomLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="changeRoomLabel"> Change Room </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h6 class="font-weight-bold"> Personal Details </h6>
                        <div class="col-md-6">
                            <h6> Name: {{ selected_all.first_name }} {{ selected_all.last_name }}</h6>
                            <h6> Total Amount: {{ selected_all.amount }} </h6>
                            <h6> Reserved Days: {{ formatDate(start_d) }} to {{ formatDate(end_d) }} </h6>
                            <h6> No. of Guests: {{ selected_all.guest_no }} </h6>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="font-weight-bold mt-3"> Reserved Room(s): </h6>
                                <div class="col-md-12" v-for="room in reserved">
                                    <div class="col-md-12 border shadow p-4 d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6> {{ room.rooms.name }} </h6>
                                        </div>
                                        <div>
                                            <h6> {{ room.rooms.amount }} </h6>
                                        </div>
                                        <div class="text-right mb-2">
                                            <button type="button" class="btn btn-sm btn-danger font-white m-0" @click="removeResRooms(room)"><i class="fas fa-minus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6 class="font-weight-bold mt-3"> Removed Room(s): </h6>
                                <div class="col-md-12" v-for="room in removed">
                                    <div class="col-md-12 border shadow p-4 d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6> {{ room.rooms.name }} </h6>
                                        </div>
                                        <div>
                                            <h6> {{ room.rooms.amount }} </h6>
                                        </div>
                                        <div class="text-right mb-2">
                                            <button type="button" class="btn btn-sm btn-danger font-white m-0" @click="removeRemRooms(room)"><i class="fas fa-minus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <h6 class="font-weight-bold mt-3 text-center"> Added Room(s): </h6>
                            <div class="row">
                                <div class="col-md-6" v-for="room in changed_room">
                                    <div class="col-md-12 border shadow p-4 d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6> {{ room.name }} </h6>
                                        </div>
                                        <div>
                                            <h6> {{ room.amount }} </h6>
                                        </div>
                                        <div class="text-right mb-2">
                                            <button type="button" class="btn btn-sm btn-danger font-white m-0" @click="removeChangedRooms(room)"><i class="fas fa-minus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h6 class="font-weight-bold mt-5"> Available Room(s): </h6>
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
                                        <button type="button" class="btn btn-primary text-white w-100" data-toggle="modal" data-target="#guestModal" @click="book(room)"> Book </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary text-white" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary text-white" @click="rebookRooms()">Save changes</button>
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
                    {text: 'Reservation Number', value: 'reservation_no', class: 'text-center'},
                    {text: 'Check In', value: 'reservation_details[0].start_date', class: 'text-center'},
                    {text: 'Check Out', value: 'reservation_details[0].end_date', class: 'text-center'},
                    {text: 'Amount', value: 'amount', class: 'text-center'},
                    {text: 'Payment', value: 'payment', class: 'text-center'},
                    {text: 'Remaining', value: 'remaining', class: 'text-center'},
                    {text: 'Status', value: 'is_paid', class: 'text-center'},
                    {text: 'Action', value: 'actions', class: 'text-center'},
                ],
                search: '',
                start_d: '',
                end_d: '',
                total_amount: 0,
                res_upcoming: [],
                reserved: [],
                removed: [],
                changed_room: [],
                selected: [],
                selected_all: [],
                filtered_rooms: [],
            }
        },
        methods: {
            rebookRooms() {
                Swal.fire({
                    title: 'Save Changes?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.value) {
                        let loader = this.$loading.show();
                        let res_room = 0;
                        let rem_room = 0;
                        let add_room = 0;
                        let nights_stay = 0;

                        for(let i = 0; i < this.reserved.length; i++) {
                            res_room += parseFloat(this.reserved[i].rooms.amount)
                        }
                        for(let i = 0; i < this.removed.length; i++) {
                            rem_room += parseFloat(this.removed[i].rooms.amount)
                        }
                        for(let i = 0; i < this.changed_room.length; i++) {
                            add_room += parseFloat(this.changed_room[i].amount)
                        }

                        let start_d = moment(this.selected[0].start_date).format('YYYY-MM-DD 00:00:00');
                        let end_d = moment(this.selected[0].end_date).format('YYYY-MM-DD 00:00:00');
                        let start = moment(start_d);
                        let end = moment(end_d);

                        nights_stay = end.diff(start, 'days');
                        this.total_amount = nights_stay * ((res_room - rem_room) + add_room);

                        axios.post('api/reservation/rebook', {
                            reservation_id: this.selected_all.id,
                            added_rooms: this.changed_room,
                            total_amount: this.total_amount,
                            delete_rooms: this.removed,
                            start_date:moment(this.selected[0].start_date).format('YYYY-MM-DD'),
                            end_date: moment(this.selected[0].end_date).format('YYYY-MM-DD'),
                        }).then(response => {
                            setTimeout(() => {
                                loader.hide()
                            },10)
                            Swal.fire(
                                'Complete!',
                                'Changed Successfully.',
                                'success'
                            )
                            const index = async function () {
                                await new Promise(resolve => {
                                    setTimeout(resolve, 2500)
                                })
                                location.reload();
                            }
                            index();
                        })
                    }
                });
            },
            book(room) {
                this.changed_room.push(room);

                for (let i = 0; i < this.filtered_rooms.length; i++) {
                    if(this.filtered_rooms[i].id == room.id) {
                        this.$delete(this.filtered_rooms, i);
                    }
                }
            },
            removeChangedRooms(room) {
                this.filtered_rooms.unshift(room);

                for (let i = 0; i < this.changed_room.length; i++) {
                    if(this.changed_room[i].id == room.id) {
                        this.$delete(this.changed_room, i);
                    }
                }
            },
            removeResRooms(room) {
                let increment = 0;
                for(let i = 0; i < this.removed.length; i++) {
                    if(this.removed[i].id == room.id) {
                        increment++;
                    }
                }
                if(increment >= 1) {
                    Swal.fire(
                        'Error',
                        'Room is already in the removed list',
                        'error'
                    )
                } else {
                    this.removed.unshift(room);
                }
            },
            removeRemRooms(room) {
                for (let i = 0; i < this.removed.length; i++) {
                    if(this.removed[i].id == room.id) {
                        this.$delete(this.removed, i);
                    }
                }
            },
            changeRoomSelect(value){
                this.selected = value.reservation_details;
                this.reserved = this.selected
                this.start_d = this.selected[0].start_date;
                this.end_d = this.selected[0].end_date;
                this.selected_all = value;
                console.log(this.selected_all);
                this.getVacantRooms();
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
            getVacantRooms() {
                axios.post('api/rooms/getVacantRoomsChange', {
                    check_in: this.selected[0].start_date,
                    check_out: this.selected[0].end_date,
                }).then(response => {
                    this.filtered_rooms = response.data.vacant_rooms;
                })
            },
            formatNumber(num) {
                return '₱' + parseFloat(num).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
            },
            formatDate(value) {
                return moment(value).format('MMM. DD, YYYY')
            }
        },
        created() {
            this.getReservationUpcoming();
        }
    }
</script>
