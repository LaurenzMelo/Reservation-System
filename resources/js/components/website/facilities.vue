<template>
    <div>
        <img src="images/facilities-bg.jpg" style="margin-top:-100px; width:100%" class="cover-image">
        <div class="container-facilities font-oswald">
            Facilities <br>& Services
        </div>
        <div class="container mt-5 mb-5">
            <h4 class="font-oswald font-weight-bold">Food</h4>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <img class="card-img-top" src="images/placeholder-3.jpg" alt="Card image cap">
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
                        <img class="card-img-top" src="images/placeholder-3.jpg" alt="Card image cap">
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
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    Donec lectus turpis, auctor in eleifend sed, maximus at erat.
                    Duis sed sapien vehicula, consequat ipsum vel, aliquam orci.
                    Maecenas efficitur euismod accumsan.
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
                        Karaoke is worth ₱ 100/hr. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Aliquam quis sem sit amet libero vulputate convallis. In libero felis, lobortis in neque id,
                        porttitor aliquet tellus. Vivamus ut sapien in erat vulputate sollicitudin quis ac purus.
                    </p>
                </div>
                <div class="col-md-4 pl-4 pr-4">
                    <img src="images/kitchen.svg" style="height:100px; width: 100px">
                    <br><span class="font-weight-bold">Common Kitchen</span>
                    <p class="text-justify pt-3 text-indent-sentence">
                        Common Kitchen is worth ₱ 500. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Aliquam quis sem sit amet libero vulputate convallis. In libero felis, lobortis in neque id,
                        porttitor aliquet tellus. Vivamus ut sapien in erat vulputate sollicitudin quis ac purus.
                    </p>
                </div>
                <div class="col-md-4 pl-4 pr-4">
                    <img src="images/room-key.svg" style="height:100px; width: 100px">
                    <br><span class="font-weight-bold">Room Service</span>
                    <p class="text-justify pt-3 text-indent-sentence">
                        Sand Bar Beach Resort offers Room Services so you don't have to worry about going out.
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Aliquam quis sem sit amet libero vulputate convallis. In libero felis, lobortis in neque id,
                        porttitor aliquet tellus. Vivamus ut sapien in erat.
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
