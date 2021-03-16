<template>
    <div>
        <img src="images/resort.jpg" style="margin-top:-100px; width:100%" class="cover-image">
        <div class="datepicker-long">
            <v-date-picker
                v-model="check_date"
                is-range
                :masks="masks"
                color="blue"
                is-dark
                class="mt-1"
            >
                <template v-slot="{ inputValue, inputEvents }">
                    <div class="mt-1 flex align-items-center justify-items-center ml-2">
                        <input
                            :value="inputValue.start"
                            v-on="inputEvents.start"
                            class="p-1 rounded font-montserrat font-white"
                            style="width: 18%;"
                            placeholder="Check In"
                            :min-date="new Date()"
                        />
                        <i class="far fa-calendar-minus font-white fa-lg mr-2"></i>
                        <input
                            :value="inputValue.end"
                            v-on="inputEvents.end"
                            class="p-1 rounded font-montserrat font-white"
                            style="width: 18%;"
                            placeholder="Check Out"
                            :min-date="new Date()"
                        />
                        <i class="far fa-calendar-minus fa-lg font-white mr-2"></i>
                        <select class="p-1 rounded font-montserrat font-white" style="width:18%">
                            <option value="" disabled selected hidden>No. Of Room(s)</option>
                            <option value="1" style="color:black !important">1</option>
                            <option value="2" style="color:black !important">2</option>
                            <option value="3" style="color:black !important">3</option>
                            <option value="4" style="color:black !important">4</option>
                            <option value="5" style="color:black !important">5</option>
                        </select>
                        <i class="fas fa-angle-down fa-lg font-white mr-3" style="margin-left: -25px"></i>
                        <select class="p-1 rounded font-montserrat font-white" style="width:18%">
                            <option value="" disabled selected hidden>No. Of Guest(s)</option>
                            <option value="1" style="color:black !important">1</option>
                            <option value="2" style="color:black !important">2</option>
                            <option value="3" style="color:black !important">3</option>
                            <option value="4" style="color:black !important">4</option>
                            <option value="5" style="color:black !important">5</option>
                        </select>
                        <i class="fas fa-angle-down fa-lg font-white mr-3" style="margin-left: -25px"></i>
                        <a :href="'/booking'" style="text-decoration: none; color: black !important"><button type="button" class="ml-1 button-book font-weight-bold" style="width: 17%; height: 46px; margin-top:-4px; font-size: 14px !important; background-color: white"> BOOK </button></a>
                    </div>
                </template>
            </v-date-picker>
        </div>

        <!--<div class="datepicker-form text-center">
            <h4 class="font-weight-bold font-white mt-2">Stay with us!</h4>
            <v-date-picker
                v-model="check_date"
                is-range
                :masks="masks"
                color="blue"
                is-dark
                class="mt-1"
            >
                <template v-slot="{ inputValue, inputEvents }">
                    <div class="mt-2">
                        <div class="d-flex align-items-center justify-content-center">
                            <input
                                :value="inputValue.start"
                                v-on="inputEvents.start"
                                class="border p-1 rounded focus:outline-none focus:border-blue-300 font-montserrat "
                                style="width: 65%; background-color: white"
                                placeholder="Check In"
                                :min-date="new Date()"
                            />
                            <i class="far fa-calendar-minus fa-2x font-white ml-2"></i>
                        </div>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <input
                                :value="inputValue.end"
                                v-on="inputEvents.end"
                                class="border p-1 rounded focus:outline-none focus:border-blue-300 font-montserrat"
                                style="width: 65%; background-color: white"
                                placeholder="Check Out"
                                :min-date="new Date()"
                            />
                            <i class="far fa-calendar-minus fa-2x font-white ml-2"></i>
                        </div>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <input
                                type="text"
                                class="border p-1 rounded focus:outline-none focus:border-blue-300 font-montserrat"
                                style="width: 65%; background-color: white"
                                placeholder="No. Of Guests"
                            />
                            <i class="fas fa-user-friends fa-lg font-white ml-2"></i>
                        </div>
                    </div>
                </template>
            </v-date-picker>
            <button type="button" class="btn btn-primary font-white mt-2" style="width: 77%; border-radius:20px"> BOOK NOW </button>
        </div>-->
        <div class="container mt-5 mb-5">
            <h4 class="font-weight-bold text-center"> ABOUT US </h4>
            <hr style="width: 50%; margin:auto;">
            <div class="row mt-4">
                <div class="col-md-3">
                    <div class="card">
                        <img class="card-img-top" src="images/placeholder-3.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <img class="card-img-top" src="images/placeholder-3.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <img class="card-img-top" src="images/placeholder-3.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <img class="card-img-top" src="images/placeholder-3.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <h4 class="font-weight-bold text-center"> OUR ROOMS </h4>
            <hr style="width: 50%; margin:auto">
            <div class="row mt-4">
                <div class="col-md-8 p-0">
                    <img src="images/placeholder.jpg" class="image-fit-md-8">
                </div>
                <div class="col-md-4 p-0">
                    <img src="images/placeholder-black.jpg" class="image-fit-md-4">
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 p-0">
                    <img src="images/placeholder-3.jpg" class="image-fit-md-4">
                </div>
                <div class="col-md-4 p-0">
                    <img src="images/placeholder-black.jpg" class="image-fit-md-4">
                </div>
                <div class="col-md-4 p-0">
                    <img src="images/placeholder-3.jpg" class="image-fit-md-4">
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 p-0">
                    <img src="images/placeholder-black.jpg" class="image-fit-md-4">
                </div>
                <div class="col-md-8 p-0">
                    <img src="images/placeholder.jpg" class="image-fit-md-8">
                </div>
            </div>
        </div>

        <div class="container mt-5 mb-5">
            <div class="col-md-12">
                <h4 class="font-weight-bold text-center"> WHY CHOOSE US? </h4>
                <hr style="width: 50%; margin:auto">
                <div class="row mt-4 text-center">
                    <div class="col-md-4 pl-4 pr-4">
                        <img src="images/healthcare.svg" style="height:100px; width: 100px">
                        <br><span class="font-weight-bold">Hospitable Staff</span>
                        <p class="text-justify pt-3 text-indent-sentence">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Aliquam quis sem sit amet libero vulputate convallis. In libero felis, lobortis in neque id,
                            porttitor aliquet tellus. Vivamus ut sapien in erat vulputate sollicitudin quis ac purus.</p>
                    </div>
                    <div class="col-md-4 pl-4 pr-4">
                        <img src="images/sunset.svg" style="height:100px; width: 100px">
                        <br><span class="font-weight-bold">Good Ambience</span>
                        <p class="text-justify pt-3 text-indent-sentence">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Aliquam quis sem sit amet libero vulputate convallis. In libero felis, lobortis in neque id,
                            porttitor aliquet tellus. Vivamus ut sapien in erat vulputate sollicitudin quis ac purus.</p>
                    </div>
                    <div class="col-md-4 pl-4 pr-4">
                        <img src="images/bio.svg" style="height:100px; width: 100px">
                        <br><span class="font-weight-bold">Eco-Friendly</span>
                        <p class="text-justify pt-3 text-indent-sentence">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Aliquam quis sem sit amet libero vulputate convallis. In libero felis, lobortis in neque id,
                            porttitor aliquet tellus. Vivamus ut sapien in erat vulputate sollicitudin quis ac purus.</p>
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
                check_date:'',
                current_date:'',
                masks: {
                    input: 'MMM DD YYYY',
                },
            }
        },
        methods: {

        },
        mounted() {
            this.current_date = moment().format()
        }
    }
</script>
