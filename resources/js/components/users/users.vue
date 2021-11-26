<template>
    <div class="col-md-12">
        <div class="card mb-5 mt-2 border shadow">
            <div class="col-md-12 p-4">
                <div class="row mb-4 d-flex align-items-center">
                    <h5 class="mr-2"> Users </h5>
                    <button type="button" class="btn btn-primary ml-2 text-white" data-toggle="modal" data-target="#addUser"><i class="fas fa-plus"></i></button>
                </div>
            
                <div class="col-md-12 border mt-2" v-for="user in receptionists" :key="user.id">
                    <div class="row">
                        <div class="col-md-9">
                            {{ user.name }}
                        </div>
                        <div class="col-md-3 text-center">
                            <button
                                class="btn btn-success btn-sm"
                                @click="toggleStatus(user)"
                                v-if="user.is_enabled == 1"
                            >
                                Enabled
                            </button>
                            <button
                                class="btn btn-warning btn-sm"
                                @click="toggleStatus(user)"
                                v-else
                            >
                                Disabled
                            </button>
                            <button
                                class="btn btn-danger btn-sm w-25"
                                @click="deleteUser(user.id)"
                            >
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="addUserLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addUserLabel"> Add Receptionist </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="formId" @submit.prevent="addUser" autocomplete="off">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label class="font-weight-bold"> Name </label>
                                    <input type="text" class="form-control" placeholder="Receptionist Name" autocomplete="off" v-model="form.name" required>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold"> Email </label>
                                    <input type="email" class="form-control" placeholder="Receptionist Email" autocomplete="off" v-model="form.recep_email" required />
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold"> Password </label>
                                    <input type="password" class="form-control" placeholder="********" autocomplete="new-password" v-model="form.recep_password" required />
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
    </div>
</template>

<script>
    export default {
        props: ['auth'],
        data() {
            return {
                receptionists: [],
                status: '1',
                form: {
                    name: '',
                    recep_password: '',
                    recep_email: ''
                },
                something: '',
                lol: '',             
            }
        },
        methods: {
            addUser() {
                axios.post('api/users/addUser' ,{
                    form: this.form
                })
                .then(response => {
                    this.getReceptionist();
                    document.getElementById("formId").reset();
                    Swal.fire(
                        'Success!',
                        'New User is added.',
                        'success'
                    )
                    $('#addUser').modal('hide')
                }); 
            },
            toggleStatus(value) {
                axios.post('api/users/toggleStatus' ,{
                    user: value
                })
                .then(response => {
                    this.getReceptionist();
                });
            },
            deleteUser(id) {
                Swal.fire({
                    title: 'Delete this User?' ,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Confirm'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.post('api/users/deleteUser', {
                            id: id
                        }).then(response => {
                            Swal.fire(
                                'Success!',
                                'User was deleted.',
                                'success'
                            )
                            this.getRooms();
                        })
                    }
                });
            },
            getReceptionist() {
                this.receptionists = [];
                axios.get('api/users/getReceptionist')
                .then(response => {
                    for(let i = 0; i < response.data.length; i++)
                    {
                        this.receptionists.push(response.data[i]);
                    }
                });
            },
            validateEmail(email) {
                const re = /\S+@\S+\.\S+/
                return re.test(email)
            },
        },
        created() {
            this.getReceptionist();
        }
    }
</script>
