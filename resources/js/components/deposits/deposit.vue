<template>
    <div class="col-md-12">
        <div class="card mb-5 mt-2 border shadow">
            <div class="card-body">
                <div class="row d-flex justify-content-between">
                    <div class="mt-2 ml-2">
                        <h4 class="font-weight-bold" v-if="d_slip == 'Pending'"> Pending Deposit Slips </h4>
                        <h4 class="font-weight-bold" v-else-if="d_slip == 'Approved' "> Approved Deposit Slips </h4>
                        <h4 class="font-weight-bold" v-else> Disapproved Deposit Slips </h4>
                    </div>
                    <div class="mt-2 mr-2">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="d_slip_pending" id="Pen" value="Pending" v-model="d_slip">
                            <label class="form-check-label" for="Pen">Pending</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="d_slip_approved" id="App" value="Approved" v-model="d_slip">
                            <label class="form-check-label" for="App">Approved</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="d_slip_disapproved" id="Dis" value="Dispproved" v-model="d_slip">
                            <label class="form-check-label" for="Dis">Disapproved</label>
                        </div>
                    </div>
                </div>
                <div class="row mt-2 text-center">
                    <div class="col-md-4">
                        <h6 class="font-weight-bold"> Reservation Number </h6>
                        <hr style="width:25%; margin-top:3px; border-top:3px solid #68A6BF; margin-top:20px !important" class="m-auto">
                    </div>
                    <div class="col-md-4">
                        <h6 class="font-weight-bold"> Amount </h6>
                        <hr style="width:25%; margin-top:3px; border-top:3px solid #68A6BF; margin-top:20px !important" class="m-auto">
                    </div>
                    <div class="col-md-4">
                        <h6 class="font-weight-bold"> Action </h6>
                        <hr style="width:25%; margin-top:3px; border-top:3px solid #68A6BF; margin-top:20px !important" class="m-auto">
                    </div>
                </div>

                <div class="row mt-3 d-flex align-items-center text-center" v-if="d_slip == 'Pending'">
                    <div class="col-md-12 text-center" v-if="deposits.length == 0">
                        None
                    </div>
                    <div class="col-md-12" v-for="slip in deposits" v-else>
                        <div class="row">
                            <div class="col-md-4">
                                {{ slip.reservation.reservation_no }}
                            </div>
                            <div class="col-md-4">
                                {{ slip.amount }}
                            </div>
                            <div class="col-md-4">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#viewDeposit" @click="viewSlip(slip)"><i class="fas fa-eye text-white"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-3 d-flex align-items-center text-center" v-else-if="d_slip == 'Approved'">
                    <div class="col-md-12 text-center" v-if="approved_deposits.length == 0">
                        None
                    </div>
                    <div class="col-md-12" v-for="slips in approved_deposits" v-else>
                        <div class="row">
                            <div class="col-md-4">
                                {{ slips.reservation.reservation_no }}
                            </div>
                            <div class="col-md-4">
                                {{ slips.amount }}
                            </div>
                            <div class="col-md-4">
                                <button type="button" class="btn btn-danger" @click="revertSlip(slips)"><i class="text-white fas fa-history"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-3 d-flex align-items-center text-center" v-else>
                    <div class="col-md-12 text-center" v-if="disapproved_deposits.length == 0">
                        None
                    </div>
                    <div class="col-md-12" v-for="slips in disapproved_deposits" v-else>
                        <div class="row">
                            <div class="col-md-4">
                                {{ slips.reservation.reservation_no }}
                            </div>
                            <div class="col-md-4">
                                {{ slips.amount }}
                            </div>
                            <div class="col-md-4">
                                <button type="button" class="btn btn-danger" @click="revertDisapprove(slips)"><i class="text-white fas fa-history"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="viewDeposit" tabindex="-1" role="dialog" aria-labelledby="viewDepositLabel" aria-hidden="true" v-if="this.selected.length != 0">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> Reservation #{{ selected.reservation.reservation_no }} </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row text-center">
                            <div class="col-md-3">
                                <label class="font-weight-bold"> Bank: </label>
                                <span>{{ selected.bank }}</span>
                            </div>
                            <div class="col-md-6">
                                <label class="font-weight-bold"> Time Deposited: </label>
                                <span>{{ selected.time_deposited }}</span><br>
                            </div>
                            <div class="col-md-3">
                                <label class="font-weight-bold"> Amount: </label>
                                <span>{{ selected.amount }}</span>
                            </div>
                        </div>
                        <hr>
                        <div class="text-center">
                            <img :src="selected.deposit_img" alt="Deposit Image" style="height:100%; width:100%">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary text-white" data-dismiss="modal"> Close </button>
                        <button type="button" class="btn btn-danger text-white" @click="disapprove()"> Disapprove Payment </button>
                        <button type="button" class="btn btn-primary text-white" @click="approve()"> Approve Payment </button>
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
                deposits: [],
                approved_deposits: [],
                disapproved_deposits: [],
                selected: [],
                d_slip: 'Pending',
            }
        },
        methods: {
            revertDisapprove(slip) {
                Swal.fire({
                    title: 'Revert Disapprovement?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Confirm'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let loader = this.$loading.show();
                        axios.post('api/deposits/revertDisapprove', {
                            selected: slip,
                        }).then(() => {
                            setTimeout(() => {
                                loader.hide()
                            },10)
                            Swal.fire(
                                'Success',
                                'Disapprovement Reverted',
                                'success'
                            )

                            const index = async function () {
                                await new Promise(resolve => {
                                    setTimeout(resolve, 1500)
                                })
                                location.reload();
                            }
                            index();
                        })
                    }
                });
            },
            revertSlip(slip) {
                Swal.fire({
                    title: 'Revert Payment?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Confirm'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let loader = this.$loading.show();
                        axios.post('api/deposits/revertPayment', {
                            selected: slip,
                        }).then(() => {
                            setTimeout(() => {
                                loader.hide()
                            },10)
                            Swal.fire(
                                'Success',
                                'Payment Reverted',
                                'success'
                            )

                            const index = async function () {
                                await new Promise(resolve => {
                                    setTimeout(resolve, 1500)
                                })
                                location.reload();
                            }
                            index();
                        });
                    }
                });
            },
            disapprove() {
                Swal.fire({
                    title: 'Disapprove Payment?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Confirm'
                }).then((result) => {
                    if (result.isConfirmed) {
                            let loader = this.$loading.show();
                        axios.post('api/deposits/disapprovePayment', {
                            selected: this.selected,
                        }).then(() => {
                            setTimeout(() => {
                                loader.hide()
                            },10)
                            Swal.fire(
                                'Success',
                                'Payment Disapproved',
                                'success'
                            )

                            const index = async function () {
                                await new Promise(resolve => {
                                    setTimeout(resolve, 1500)
                                })
                                location.reload();
                            }
                            index();
                        });
                    }
                });
            },
            approve() {
                Swal.fire({
                    title: 'Approve Payment?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Confirm'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let loader = this.$loading.show();
                        axios.post('api/deposits/approvePayment', {
                            selected: this.selected,
                        }).then(() => {
                            setTimeout(() => {
                                loader.hide()
                            },10)
                            Swal.fire(
                                'Success!',
                                'Payment Approved',
                                'success'
                            )

                            const index = async function () {
                                await new Promise(resolve => {
                                    setTimeout(resolve, 1500)
                                })
                                location.reload();
                            }
                            index();
                        })
                    }
                });
            },
            viewSlip(value)
            {
                this.selected = value;
                console.log(this.selected);
            },
            checkExpiredReservation() {
                console.log(moment(Date.now()).format('YYYY-MM-DD HH:mm:ss'));
                axios.post('api/reservation/checkExpiredReservation', {
                    datetime: moment(Date.now()).format('YYYY-MM-DD HH:mm:ss')
                }).then(response => {

                })
            },
        },
        computed: {
            getDeposit() {
                axios.get('api/deposits/getDeposit')
                    .then(response => {
                        for (let i = 0; i < response.data.length; i++) {
                            this.deposits.push(response.data[i]);
                        }
                    });
            },
            getApprovedDeposit() {
                axios.get('api/deposits/getApprovedDeposit')
                    .then(response => {
                        for (let i = 0; i < response.data.length; i++) {
                            this.approved_deposits.push(response.data[i]);
                        }
                    });
            },
            getDisapprovedDeposit() {
                axios.get('api/deposits/getDisapprovedDeposit')
                    .then(response => {
                        for (let i = 0; i < response.data.length; i++) {
                            this.disapproved_deposits.push(response.data[i]);
                        }
                    });
            }
        },
        created() {
            this.checkExpiredReservation();
            this.getDeposit;
            this.getApprovedDeposit;
            this.getDisapprovedDeposit;
        }
    }
</script>
