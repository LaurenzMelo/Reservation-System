<template>
    <div class="col-md-12">
        <div class="card mb-5 mt-2 border shadow">
            <div class="card-body">
                <v-card>
                    <v-card-title>
                        Rooms
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
                    ></v-data-table>
                </v-card>
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
                    { text: 'Image', value: 'image'},
                    { text: 'Room Name', value: 'name' },
                    { text: 'Description', value: 'description' },
                    { text: 'Capacity', value: 'capacity' },
                    { text: 'Amount', value: 'amount' },
                    { text: 'Action', value: 'actions' },
                ],
                rooms: [],
                search: '',
            }
        },
        methods: {

        },
        computed:{
            /*...mapGetters({
                token: 'authentication/token'
            }),*/

            getRooms(){
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
            this.getRooms;
        }
    }
</script>
