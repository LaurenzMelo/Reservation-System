<template>
    <div>
        <img src="images/rooms-web.jpg" style="margin-top:-100px; width:100%" class="cover-image">
        <div class="bg-text">
            <span class="font-weight-bold font-oswald" style="font-size: 3rem;">ROOMS</span>
            <hr style="border-top: 2px solid white; width: 20%; margin:auto; margin-top:20px; margin-bottom:20px">
            <span style="font-size: 1.2rem">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                Aliquam quis sem sit amet libero vulputate convallis.
                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                Aliquam quis sem sit amet libero vulputate convallis.
            </span>
        </div>
        <div class="container pt-5">
            <div class="row mb-4">
                <div class="col-md-3 offset-md-4 font-weight-bold pb-0 mb-0 font-med">
                    Description
                    <hr style="width:15%; margin-top:3px; border-top:3px solid #68A6BF">
                </div>
                <div class="col-md-3 font-weight-bold pb-0 mb-0 font-med">
                    More Info
                    <hr style="width:15%; margin-top:3px; border-top:3px solid #68A6BF">
                </div>
                <div class="col-md-2 font-weight-bold pb-0 mb-0 font-med">
                    Amount
                    <hr style="width:20%; margin-top:3px; border-top:3px solid #68A6BF">
                </div>
            </div>

            <div v-for="room in rooms">
                <div class="row" style="margin-bottom:5rem">
                    <div class="col-md-4 font-small p-0" style="border-bottom: 5px solid #68A6BF">
                        <div v-if="room.image != null">
                            <img class="room-img" :src="room.image" style="max-width: 100%; max-height:100%">
                        </div>
                        <div v-else class="text-center">
                            <img class="product-img" src="images/rooms/placeholder.png" style="max-width: 100%; max-height:100%">
                        </div>
                    </div>
                    <div class="col-md-3 font-small" style="border-bottom: 5px solid #68A6BF">
                        <h6 class="font-weight-bold">{{ room.name }}</h6>
                        <p class="text-indent-sentence text-justify">{{ room.description }}</p>
                    </div>
                    <div class="col-md-3 font-small" style="border-bottom: 5px solid #68A6BF">
                        <h6 class="font-weight-bold text-center">Amenities</h6>
                        <ul class="ml-5">
                            <li v-for="text in JSON.parse(room.amenities)">
                                {{ text }}
                            </li>
                        </ul>
                        <h6 class="font-weight-bold text-center">Capacity</h6>
                        <p class="text-center">Up to <span class="font-weight-bold">{{ room.capacity }}</span> Guests</p>
                    </div>
                    <div class="col-md-2 font-xl text-center font-weight-bold" style="border-bottom: 5px solid #68A6BF; padding-top:5rem">
                        {{ formatNumber(room.amount) }}
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
                rooms: [],
                unique_rooms: [],
                masks: {
                    input: 'MMM DD YYYY',
                },
                amenities: ['Shower','No Smoking', 'Aircon']
            }
        },
        methods: {
            getRooms() {
                axios.get('//' + window.location.host + '/getRoomsWebsite')
                .then(response => {
                    for(let i = 0; i < response.data.length; i++) {
                        if (response.data[i].name != 'Villa Family Room 2' ||
                            response.data[i].name != 'Family Deluxe Room 2' || response.data[i].name != 'Family Deluxe Room 3' ||
                            response.data[i].name != 'Family Deluxe Room 4' ||response.data[i].name != 'Family Regular Room 2' ||
                            response.data[i].name != 'Standard Room 2' || response.data[i].name != 'Standard Room 3' ||
                            response.data[i].name != 'Standard Room 4' || response.data[i].name != 'Standard Room 5' ||
                            response.data[i].name != 'Standard Room 6' || response.data[i].name != 'Standard Room 7' ||
                            response.data[i].name != 'Standard Room 8' || response.data[i].name != 'Twin Room 2')
                        {
                            this.rooms.push(response.data[i]);
                        }
                    }
                     console.log(this.rooms);
                })
            },
            formatNumber(num) {
                return '₱ ' + num.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
            },
        },
        mounted() {
            this.current_date = moment().format();
            this.getRooms();
        }
    }
</script>
