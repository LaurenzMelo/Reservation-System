<template>
    <div style="width: 100%">
        <img src="images/facilities-bg.jpg" style="margin-top:-100px; width:100%" class="cover-image">
        <div class="container-facilities font-oswald">
            Facilities <br>& Services
        </div>
        <div class="container mt-5 mb-5">
            <h4 class="font-oswald font-weight-bold">Food</h4>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <img class="card-img-top" src="images/buffet.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold"> Buffet for 3 Meals </h5>
                            <p class="card-text">
                                Our Buffet Meal comes with drinks and fruits/desserts for the costs of ₱ 1,100 per head
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <img class="card-img-top" src="images/restaurant.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold"> 2nd Restaurant </h5>
                            <p class="card-text">
                                We have our 2nd Restaurant only 5 minutes away from our resort. Prices vary.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Island Hopping -->
        <div class="row mt-5">
            <div class="parallax-island-hopping">
            </div>
        </div>
        <div class="container mt-3">
            <div>
                <h4 class="font-weight-bold font-oswald"> Island Hopping </h4>
                <p class="text-indent-sentence text-justify">
                    Our Island Hopping consists of Lorelei Island, Bituin Cove, and Cayraang Cove.
                    Many of our customers enjoyed this trip because of very unique and eye-catching
                    islands here. You will be surely delighted that you experienced this.
                </p>
            </div>
        </div>

        <div class="container mt-5 mb-5">
            <h4 class="font-oswald font-weight-bold">Other Services</h4>
            <div class="row mt-3 text-center">
                <div class="col-md-4 pl-4 pr-4">
                    <img src="images/karaoke.svg" style="height:100px; width: 100px">
                    <br><span class="font-weight-bold">Karaoke</span>
                    <p class="text-justify pt-3 text-indent-sentence">
                        Karaoke is worth ₱ 100/hr. But because of the pandemic and the rules mandated by
                        the Local Government, the karaoke hour can only be used from 8 AM to 10 PM.
                    </p>
                </div>
                <div class="col-md-4 pl-4 pr-4">
                    <img src="images/kitchen.svg" style="height:100px; width: 100px">
                    <br><span class="font-weight-bold">Common Kitchen</span>
                    <p class="text-justify pt-3 text-indent-sentence">
                        Common Kitchen is worth ₱ 500. Anyone that has access to this are free to use all of
                        the available tools and items. Please use this with care as there are still other customers
                        that will use this.
                    </p>
                </div>
                <div class="col-md-4 pl-4 pr-4">
                    <img src="images/room-key.svg" style="height:100px; width: 100px">
                    <br><span class="font-weight-bold">Room Service</span>
                    <p class="text-justify pt-3 text-indent-sentence">
                        Sand Bar Beach Resort offers Room Services so you don't have to worry about going out.
                        You just have to call us with the telephone found in your room.
                    </p>
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

            }
        },
        methods: {

        },
        mounted() {

        }
    }
</script>
