<template>
    <div class="col-md-12">
        <div class="card mb-5 mt-2 border shadow">
            <div class="col-md-12 p-4">
                <h5> Reports </h5>
                <div class="col-md-12 mt-4">
                    <div class="col-md-12">
                        <h6 class="mt-2 font-weight-bold"> Reservation Details <span class="text-red">*</span> </h6>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="reservation_no" id="reservation_no" v-model="res" disabled>
                                    <label class="form-check-label" for="reservation_no">
                                        Reservation No.
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="full_name" id="full_name" v-model="res" disabled>
                                    <label class="form-check-label" for="full_name">
                                        Full Name
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="email" id="email" v-model="res">
                                    <label class="form-check-label" for="email">
                                        Email
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="contact_no" id="contact_no" v-model="res">
                                    <label class="form-check-label" for="contact_no">
                                        Contact No.
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="start_date" id="start_date" v-model="res">
                                    <label class="form-check-label" for="start_date">
                                        Start Date
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="end_date" id="end_date" v-model="res">
                                    <label class="form-check-label" for="end_date">
                                        End Date
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input v-if="auth.role != 'receptionist'" class="form-check-input" type="checkbox" value="amount" id="amount" v-model="res">
                                    <input v-else class="form-check-input" type="checkbox" value="amount" id="amount" v-model="res" disabled>
                                    <label class="form-check-label" for="contact_no">
                                        Amount
                                    </label>
                                </div>
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
                    <button type="button" class="btn btn-success" @click="printReport()" target="_blank"> Download Report </button>
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
                profit: [],
                res: ['reservation_no', 'full_name'],
                status: [],
                masks: {
                    input: 'MMM DD YYYY',
                }
            }
        },
        methods: {
            printReport() {
                console.log(this.res)
                if(this.date_range == '') {
                    Swal.fire(
                        'Unable to Download Report',
                        'Please input the Reservation Date Range',
                        'error'
                    )
                } else if(this.res.length <= 2) {
                    Swal.fire(
                        'Unable to Download Report',
                        'Please select atleast 3 Reservation Details',
                        'error'
                    )
                } else {
                    const fileName = 'Report-' + moment(Date.now()).format('YYYY-MM-DD') + '.csv'
                    Swal.fire({
                    title: 'Download Report?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                    }).then((result) => {
                        if (result.value) {
                            let loader = this.$loading.show();
                            axios.post('api/report/download', {
                                profit: this.profit,
                                res: this.res,
                                date: this.date_range
                            }).then(response => {
                                const url = window.URL.createObjectURL(new Blob([response.data]));
                                const link = document.createElement('a');
                                link.href = url;
                                link.setAttribute('download', fileName);
                                document.body.appendChild(link);
                                link.click();

                                setTimeout(() => {
                                    loader.hide()
                                },10)
                                Swal.fire(
                                    'Complete!',
                                    'Downloaded Successfully',
                                    'success'
                                )
                            })
                        }
                    });
                }
            },
        },
        created() {
        }
    }
</script>
