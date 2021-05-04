<template>
    <div class="col-md-12">
        <div class="card mb-5 mt-2 border shadow">
            <div class="card-body">
                <v-card>
                    <v-card-title>
                        Rooms <button type="button" class="btn btn-primary ml-2 text-white" data-toggle="modal" data-target="#addRoom"><i class="fas fa-plus"></i></button>
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
                        :items="rooms"
                        :search="search"
                        class="elevation-1 mt-4 border shadow"
                    >
                        <template v-slot:item.actions="{ item }">
                            <button
                                class="btn btn-success btn-sm"
                                @click="editRoom(item)"
                                data-toggle="modal"
                                data-target="#editRoom"
                            >
                                <i class="fas fa-edit"></i>
                            </button>
                            <button
                                class="btn btn-danger btn-sm"
                                @click="deleteRoom(item)"
                            >
                                <i class="fas fa-times"></i>
                            </button>
                        </template>
                    </v-data-table>
                </v-card>
            </div>
        </div>

        <div class="modal fade" id="addRoom" tabindex="-1" role="dialog" aria-labelledby="addRoomLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addRoomLabel"> Add Room </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="addRoom">
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="font-weight-bold"> Name </label>
                                <input type="text" class="form-control" placeholder="Room Name" v-model="form.name">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold"> Description </label>
                                <textarea class="form-control" rows="5" v-model="form.desc" placeholder="Room Description"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold"> Amount </label>
                                <input type="number" class="form-control" min="100" v-model="form.amount">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold"> Capacity </label>
                                <input type="number" class="form-control" min="1" v-model="form.capacity">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold"> Room Image </label>
                                <input type="file" class="form-control" name="room_img" id="room_img_id" accept="image/png, image/jpeg" @change="imageChange">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold"> Amenities </label>
                                <textarea class="form-control" rows="5" v-model="form.amenities" placeholder="Room Amenities"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary text-white" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary text-white">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="editRoom" tabindex="-1" role="dialog" aria-labelledby="editRoomLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editRoomLabel"> Edit Room </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editRoomsSubmit()">
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="font-weight-bold"> Name </label>
                                <input type="text" class="form-control" placeholder="Room Name" v-model="edit.name">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold"> Description </label>
                                <textarea class="form-control" rows="5" v-model="edit.desc" placeholder="Room Description"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold"> Amount </label>
                                <input type="number" class="form-control" min="100" v-model="edit.amount">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold"> Capacity </label>
                                <input type="number" class="form-control" min="1" v-model="edit.capacity">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold"> Room Image </label>
                                <input type="file" class="form-control" name="edit_room_img" id="edit_room_img_id" accept="image/png, image/jpeg" @change="imageChangeEdit">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold"> Amenities </label>
                                <textarea class="form-control" rows="5" v-model="edit.amenities" placeholder="Room Amenities"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary text-white" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary text-white">Save changes</button>
                        </div>
                    </form>
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
                    { text: 'Room Name', value: 'name' },
                    { text: 'Description', value: 'description' },
                    { text: 'Capacity', value: 'capacity' },
                    { text: 'Amount', value: 'amount' },
                    { text: 'Action', value: 'actions', width:120},
                ],
                rooms: [],
                search: '',
                form: {
                    name: '',
                    desc: '',
                    amount: 0,
                    capacity: 0,
                    amenities: '',
                },
                edit: {
                    id: '',
                    name: '',
                    desc: '',
                    amount: 0,
                    capacity: 0,
                    amenities: '',
                }
            }
        },
        methods: {
            editRoomsSubmit() {
                Swal.fire({
                    title: 'Edit Room?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Confirm'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let loader = this.$loading.show();
                        let formData = new FormData()

                        var img = document.querySelector('#edit_room_img_id');
                        formData.append('room_img', img.files[0]);
                        formData.append('id', this.edit.id);
                        formData.append('name', this.edit.name);
                        formData.append('desc', this.edit.desc);
                        formData.append('amount', this.edit.amount);
                        formData.append('capacity', this.edit.capacity);
                        formData.append('amenities', this.edit.amenities);

                        axios.post('api/rooms/editRooms', formData)
                            .then(response => {
                                setTimeout(() => {
                                    loader.hide()
                                },10)
                                Swal.fire(
                                    'Success!',
                                    'Room was edited.',
                                    'success'
                                )
                                this.edit.name = '';
                                this.edit.desc = '';
                                this.edit.amount = 0;
                                this.edit.capacity = 0;
                                this.edit.amenities = '';
                                document.getElementById("edit_room_img_id").value = null;
                                this.getRooms();
                            })
                    }
                });
            },
            editRoom(room) {
                this.edit.name = room.name;
                this.edit.desc = room.description;
                this.edit.amount = room.amount;
                this.edit.capacity = room.capacity;
                this.edit.amenities = JSON.parse(room.amenities);
                this.edit.id = room.id;
            },
            deleteRoom(room) {
                Swal.fire({
                    title: 'Delete ' + room.name + '?' ,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Confirm'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.post('api/rooms/deleteRooms', {
                            id: room.id
                        }).then(response => {
                            this.getRooms();
                        })
                    }
                });

            },
            addRoom(){
                Swal.fire({
                    title: 'Add Room?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Confirm'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let loader = this.$loading.show();
                        let formData = new FormData()

                        var img = document.querySelector('#room_img_id');
                        formData.append('room_img', img.files[0]);
                        formData.append('name', this.form.name);
                        formData.append('desc', this.form.desc);
                        formData.append('amount', this.form.amount);
                        formData.append('capacity', this.form.capacity);
                        formData.append('amenities', this.form.amenities);

                        axios.post('api/rooms/addRooms', formData)
                        .then(response => {
                            setTimeout(() => {
                                loader.hide()
                            },10)
                            Swal.fire(
                                'Success!',
                                'Room was added.',
                                'success'
                            )
                            this.form.name = '';
                            this.form.desc = '';
                            this.form.amount = 0;
                            this.form.capacity = 0;
                            this.form.amenities = '';
                            document.getElementById("room_img_id").value = null;
                            this.getRooms();
                        })
                    }
                });
            },
            imageChangeEdit(e) {
                let img = e.target.files[0];
                if (img['size'] > 2111775) {
                    document.getElementById("edit_room_img_id").value = null;
                    Swal.fire(
                        'Error',
                        'Room image must not exceed 2MB.',
                        'error'
                    )
                } else if (img['type'] != 'image/png' && img['type'] != 'image/jpeg') {
                    document.getElementById("room_img_id").value = null;
                    Swal.fire(
                        'Error',
                        'Room Image should be in .png or .jpeg file format.',
                        'error'
                    )
                } else {
                    Swal.fire(
                        'Success',
                        'Room Image is accepted.',
                        'success'
                    )
                }
            },
            imageChange(e) {
                let img = e.target.files[0];
                if (img['size'] > 2111775) {
                    document.getElementById("room_img_id").value = null;
                    Swal.fire(
                        'Error',
                        'Room image must not exceed 2MB.',
                        'error'
                    )
                } else if (img['type'] != 'image/png' && img['type'] != 'image/jpeg') {
                    document.getElementById("room_img_id").value = null;
                    Swal.fire(
                        'Error',
                        'Room Image should be in .png or .jpeg file format.',
                        'error'
                    )
                } else {
                    Swal.fire(
                        'Success',
                        'Room Image is accepted.',
                        'success'
                    )
                }
            },
            checkExpiredReservation() {
                console.log(moment(Date.now()).format('YYYY-MM-DD HH:mm:ss'));
                axios.post('api/reservation/checkExpiredReservation', {
                    datetime: moment(Date.now()).format('YYYY-MM-DD HH:mm:ss')
                }).then(response => {

                })
            },
            getRooms(){
                this.rooms = [];
                axios.get('api/rooms/getRooms')
                    .then(response => {
                        for(let i = 0; i < response.data.length; i++)
                        {
                            this.rooms.push(response.data[i]);
                        }
                    });
            }
        },
        created() {
            this.checkExpiredReservation();
            this.getRooms();
        }
    }
</script>
