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
                        class="elevation-1 mt-4 border shadow"
                    >
                        <template v-slot:item.actions="{ item }">
                            <button
                                class="btn btn-success btn-sm"
                            >
                                <i class="fas fa-edit"></i>
                            </button>
                            <button
                                class="btn btn-primary btn-sm"
                            >
                                <i class="fas fa-eye"></i>
                            </button>
                        </template>
                    </v-data-table>
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
                    { text: 'Room Name', value: 'name' },
                    { text: 'Description', value: 'description' },
                    { text: 'Capacity', value: 'capacity' },
                    { text: 'Amount', value: 'amount' },
                    { text: 'Action', value: 'actions', width:120},
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
