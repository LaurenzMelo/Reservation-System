<template>
    <div class="col-md-12">
        <div class="card mb-5 mt-2 border shadow">
            <div class="col-md-12 p-4">
                <h5> Reports </h5>
                <div class="col-md-12 mt-4">
                    <div class="row">
                        <div class="col-md-4">
                            <h6 class="mt-2 font-weight-bold"> Reservation Details <span class="text-red">*</span> </h6>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="amount" id="amount" v-model="res.amount">
                                <label class="form-check-label" for="contact_no">
                                    Amount
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="contact_no" id="contact_no" v-model="res.contact_no">
                                <label class="form-check-label" for="contact_no">
                                    Contact No.
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="email" id="email" v-model="res.email">
                                <label class="form-check-label" for="email">
                                    Email
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="full_name" id="full_name" v-model="res.full_name">
                                <label class="form-check-label" for="full_name">
                                    Full Name
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="res_no" id="res_no" v-model="res.res_no">
                                <label class="form-check-label" for="res_no">
                                    Reservation No.
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h6 class="mt-2 font-weight-bold"> Reservation Status <span class="text-red">*</span> </h6>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="upcoming" id="res_up" v-model="status.upcoming">
                                <label class="form-check-label" for="res_up">
                                    Upcoming
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="active" id="res_act" v-model="status.active">
                                <label class="form-check-label" for="es_act">
                                    Active/Checked In
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="done" id="res_done" v-model="status.done">
                                <label class="form-check-label" for="res_done">
                                    Done
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="expired" id="res_ex" v-model="status.expired">
                                <label class="form-check-label" for="res_ex">
                                    Expired
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h6 class="mt-2 font-weight-bold"> Profit </h6>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="collected" id="col" v-model="profit.collected">
                                <label class="form-check-label" for="col">
                                    Collected Profit
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="projected" id="proj" v-model="profit.projected">
                                <label class="form-check-label" for="proj">
                                    Projected Profit
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="uncollected" id="uncol" v-model="profit.uncollected">
                                <label class="form-check-label" for="uncol">
                                    Uncollected Profit
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <h6 class="mt-2 font-weight-bold"> Reservation Date </h6>
                    <v-date-picker
                        v-model="date_range"
                        is-range
                        :masks="masks"
                        color="blue"
                        is-dark
                        class="mt-1"
                    >
                        <template v-slot="{ inputValue, inputEvents }">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <input
                                            :value="inputValue.start"
                                            v-on="inputEvents.start"
                                            class="border p-2 rounded focus:outline-none focus:border-indigo-300 form-control"
                                            placeholder="Start Date"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-1 text-center">
                                    <i class="fas fa-long-arrow-alt-right fa-2x"></i>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input
                                            :value="inputValue.end"
                                            v-on="inputEvents.end"
                                            class="border p-2 rounded focus:outline-none focus:border-indigo-300 form-control"
                                            placeholder="End Date"
                                            :min-date="new Date()"
                                        />
                                    </div>
                                </div>
                            </div>
                        </template>
                    </v-date-picker>
                </div>
                <div class="col-md-12 text-center mt-2">
                    <button type="button" class="btn btn-success" @click="printReport()"> Download Report </button>
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
                date_range: '',
                profit: {
                    collected: '',
                    uncollected: '',
                    projected: '',
                },
                res: {
                    amount: '',
                    contact_no: '',
                    email: '',
                    full_name: '',
                    res_no: ''
                },
                status: {
                    upcoming: '',
                    done: '',
                    active: '',
                    expired: '',
                },
                masks: {
                    input: 'MMM DD YYYY',
                },
            }
        },
        methods: {
            printReport() {
                // if (this.res.amount === '') {
                //     console.log('empty')
                // } else {
                //     console.log(this.res.amount)
                // }
                console.log(this.res)
                console.log(this.profit)
                console.log(this.status)
                // if(this.date_range == '') {
                //     Swal.fire(
                //         'Unable to Download Report',
                //         'Please input the Reservation Date Range',
                //         'error'
                //     )
                // } else {
                //     Swal.fire({
                //     title: 'Download Report?',
                //     icon: 'question',
                //     showCancelButton: true,
                //     confirmButtonColor: '#3085d6',
                //     cancelButtonColor: '#d33',
                //     confirmButtonText: 'Yes'
                //     }).then((result) => {
                //         if (result.value) {
                //             let loader = this.$loading.show();
                //             axios.post('api/report/download', {
                //                 profit: this.profit,
                //                 res: this.res,
                //                 date: this.date_range
                //             }).then(response => {
                //                 setTimeout(() => {
                //                     loader.hide()
                //                 },10)
                //                 Swal.fire(
                //                     'Complete!',
                //                     'Downloaded Successfully',
                //                     'success'
                //                 )
                //             })
                //         }
                //     });
                // }
            }
        },
        created() {
        }
    }
</script>
