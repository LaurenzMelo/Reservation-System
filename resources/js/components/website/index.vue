<template>
    <div>
        <img src="images/resort.jpg" style="margin-top:-100px; width:100%" class="cover-image">
        <div class="book-now-container text-center p-4">
            <h5 class="font-weight-bold font-white mb-4">Looking for a great place to stay?</h5>
            <a :href="'/booking'" style="text-decoration: none; color: black !important">
                <button type="button" class="btn btn-primary w-75 ml-1 button-book font-weight-bold" style="font-size: 14px !important; background-color: white"> BOOK NOW </button>
            </a>
        </div>

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

        <div class="modal fade" id="openModal" tabindex="-1" role="dialog" aria-labelledby="openModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body p-4">
                        <h4 class="font-weight-bold"> GUEST ADVISORY - COVID-19 </h4>
                        <hr style="width:20%; margin-top:3px; border-top:3px solid #68A6BF; margin-top:20px !important" class="m-0">
                        <h6 class="font-weight-bold mt-2 text-center"> YOUR HEALTH AND SAFETY - OUR TOP PRIORITY </h6>
                        <p class="text-justify text-indent-sentence">
                            To ensure that you have a safe and pleaseant to stay with us, our team has put in place safe practices to protect your
                            well-being. Across our properties, we are adhering to the directives and recommendations of the relevant government and
                            public health authorities. Our team is committed to maintaining high hygiene standards and have implemented additional
                            precautionary measures as part of our enhanced cleaning protocols.
                        </p>
                        <p> The management is keen on complying the guidelines set by the Department of Health, to wit Hotel Guests are: </p>
                        <ul class="ml-4">
                            <li>
                                required to wear a face mask in the public areas of the hotel;
                            </li>
                            <li>
                                required to submit themselves to a body temperature check upon entering hotel premises;
                            </li>
                            <li>
                                advised to observe special distancing of at least one (1) meter;
                            </li>
                            <li>
                                advised to frequently wash their hands and follow proper cough etiquette.
                            </li>
                        </ul>
                        <p> We have imposed additional precautionary measures to keep Sand Bar Beach Resort COVID-19 free. </p>
                        <ul class="ml-4">
                            <li>
                                Hotel staff are required to strictly follow the same guidelines mentioned above;
                            </li>
                            <li>
                                The Management distributes personal protective equipment for all employess daily; and
                            </li>
                            <li>
                                Hotel roms are deeply sanitized and disinfected every check-out.
                            </li>
                        </ul>
                        <p class="text-justify text-indent-sentence">
                            The health and safety of our guests and team members remain a priority for us. We are staying vigilant
                            and are ready to adopt all appropriate measures as the Covid-19 situation evolves. We are doing everything
                            we can to ensure you have peace of mind when you stay with us. Thank you for choosing Sand Bar Beach Resort
                            as your preferred host at accommodation in Nasugbu, Batangas. Stay Safe!
                        </p>
                        <p> Should you have any concerns or queries, please email us at sandbarbeachresort@gmail.com.</p>
                        <hr style="width:80%; margin-top:3px; border-top:3px solid #68A6BF; margin-top:20px !important" class="m-auto">
                        <div class="text-center mt-4">
                            <button type="button" class="btn btn-danger text-white w-25" data-dismiss="modal">Close</button>
                        </div>
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
            openModalCovid()
            {
                $('#openModal').modal('show');
            }
        },
        mounted() {
            this.current_date = moment().format()
            this.openModalCovid();
        }
    }
</script>
