<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use function PHPSTORM_META\map;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $room1 = Room::create([
            'name' => 'Dormitory',
            'description' => 'Our Dormitory Type is located at the upper level of the building for you to enjoy.',
            'amount' => '13000.00',
            'capacity' => '20',
            'capacity_extend' => '2',
            'is_occupied' => '0',
            'image' => 'images/rooms/dormitory.jpg',
            'amenities' => '["Airconditioned Room, Bathroom, Television, Water Dispenser, Towels"]',
            'created_at' => '2021-04-24 13:08:00',
            'updated_at' => '2021-04-24 13:08:00'
        ]);

        $room2 = Room::create([
            'name' => 'Villa Family Room',
            'description' => 'Our spacious Villa Family Room is the greatest choice among groups as it can house 10 person',
            'amount' => '8000.00',
            'capacity' => '10',
            'capacity_extend' => '2',
            'is_occupied' => '0',
            'image' => 'images/rooms/villa.jpg',
            'amenities' => '["Airconditioned Room, Kitchenware, Bathroom, Television, Refrigerator, Water Dispenser, Towels"]',
            'created_at' => '2021-04-24 13:08:00',
            'updated_at' => '2021-04-24 13:08:00'
        ]);

        $room3 = Room::create([
            'name' => 'Villa Family Room 2',
            'description' => 'Our spacious Villa Family Room is the greatest choice among groups as it can house 10 person',
            'amount' => '8000.00',
            'capacity' => '10',
            'capacity_extend' => '2',
            'is_occupied' => '0',
            'image' => 'images/rooms/villa.jpg',
            'amenities' => '["Airconditioned Room, Kitchenware, Bathroom, Television, Refrigerator, Water Dispenser, Towels"]',
            'created_at' => '2021-04-24 13:08:00',
            'updated_at' => '2021-04-24 13:08:00'
        ]);

        $room4 = Room::create([
            'name' => 'Family Deluxe Room',
            'description' => 'Our Family Deluxe Rooms are perfect - guess what? For family, as the title suggests. It can house 6 guests comfortably.',
            'amount' => '5200.00',
            'capacity' => '6',
            'capacity_extend' => '2',
            'is_occupied' => '0',
            'image' => 'images/rooms/family_deluxe.jpg',
            'amenities' => '["Airconditioned Room, Bathroom, Mini Refrigerator, Television, Electric Kettle, Towels"]',
            'created_at' => '2021-04-24 13:08:00',
            'updated_at' => '2021-04-24 13:08:00'
        ]);

        $room5 = Room::create([
            'name' => 'Family Deluxe Room 2',
            'description' => 'Our Family Deluxe Rooms are perfect - guess what? For family, as the title suggests. It can house 6 guests comfortably.',
            'amount' => '5200.00',
            'capacity' => '6',
            'capacity_extend' => '2',
            'is_occupied' => '0',
            'image' => 'images/rooms/family_deluxe.jpg',
            'amenities' => '["Airconditioned Room, Bathroom, Mini Refrigerator, Television, Electric Kettle, Towels"]',
            'created_at' => '2021-04-24 13:08:00',
            'updated_at' => '2021-04-24 13:08:00'
        ]);

        $room6 = Room::create([
            'name' => 'Family Deluxe Room 3',
            'description' => 'Our Family Deluxe Rooms are perfect - guess what? For family, as the title suggests. It can house 6 guests comfortably.',
            'amount' => '5200.00',
            'capacity' => '6',
            'capacity_extend' => '2',
            'is_occupied' => '0',
            'image' => 'images/rooms/family_deluxe.jpg',
            'amenities' => '["Airconditioned Room, Bathroom, Mini Refrigerator, Television, Electric Kettle, Towels"]',
            'created_at' => '2021-04-24 13:08:00',
            'updated_at' => '2021-04-24 13:08:00'
        ]);

        $room7 = Room::create([
            'name' => 'Family Deluxe Room 4',
            'description' => 'Our Family Deluxe Rooms are perfect - guess what? For family, as the title suggests. It can house 6 guests comfortably.',
            'amount' => '5200.00',
            'capacity' => '6',
            'capacity_extend' => '2',
            'is_occupied' => '0',
            'image' => 'images/rooms/family_deluxe.jpg',
            'amenities' => '["Airconditioned Room, Bathroom, Mini Refrigerator, Television, Electric Kettle, Towels"]',
            'created_at' => '2021-04-24 13:08:00',
            'updated_at' => '2021-04-24 13:08:00'
        ]);

        $room8 = Room::create([
            'name' => 'Family Regular Room',
            'description' => 'This extravagant room includes 2 Queen-sized Bed that can house 6 persons and is located at upper level.',
            'amount' => '5200.00',
            'capacity' => '6',
            'capacity_extend' => '2',
            'is_occupied' => '0',
            'image' => 'images/rooms/family.jpg',
            'amenities' => '["Airconditioned Room, Bathroom, Television, Towels"]',
            'created_at' => '2021-04-24 13:08:00',
            'updated_at' => '2021-04-24 13:08:00'
        ]);

        $room9 = Room::create([
            'name' => 'Family Regular Room 2',
            'description' => 'This extravagant room includes 2 Queen-sized Bed that can house 6 persons and is located at upper level.',
            'amount' => '5200.00',
            'capacity' => '6',
            'capacity_extend' => '2',
            'is_occupied' => '0',
            'image' => 'images/rooms/family.jpg',
            'amenities' => '["Airconditioned Room, Bathroom, Television, Towels"]',
            'created_at' => '2021-04-24 13:08:00',
            'updated_at' => '2021-04-24 13:08:00'
        ]);

        $room10 = Room::create([
            'name' => 'Standard Room',
            'description' => 'Good for 4 pax, our standard rooms contain 1 Queen-size Bed and 1 Single Bed with Pull-Out Bed',
            'amount' => '3500.00',
            'capacity' => '4',
            'capacity_extend' => '2',
            'is_occupied' => '0',
            'image' => 'images/rooms/standard.jpg',
            'amenities' => '["Airconditioned Room, Bathroom, Television, Towels"]',
            'created_at' => '2021-04-24 13:08:00',
            'updated_at' => '2021-04-24 13:08:00'
        ]);

        $room11 = Room::create([
            'name' => 'Standard Room 2',
            'description' => 'Good for 4 pax, our standard rooms contain 1 Queen-size Bed and 1 Single Bed with Pull-Out Bed',
            'amount' => '3500.00',
            'capacity' => '4',
            'capacity_extend' => '2',
            'is_occupied' => '0',
            'image' => 'images/rooms/standard.jpg',
            'amenities' => '["Airconditioned Room, Bathroom, Television, Towels"]',
            'created_at' => '2021-04-24 13:08:00',
            'updated_at' => '2021-04-24 13:08:00'
        ]);

        $room12 = Room::create([
            'name' => 'Standard Room 3',
            'description' => 'Good for 4 pax, our standard rooms contain 1 Queen-size Bed and 1 Single Bed with Pull-Out Bed',
            'amount' => '3500.00',
            'capacity' => '4',
            'capacity_extend' => '2',
            'is_occupied' => '0',
            'image' => 'images/rooms/standard.jpg',
            'amenities' => '["Airconditioned Room, Bathroom, Television, Towels"]',
            'created_at' => '2021-04-24 13:08:00',
            'updated_at' => '2021-04-24 13:08:00'
        ]);

        $room13 = Room::create([
            'name' => 'Standard Room 4',
            'description' => 'Good for 4 pax, our standard rooms contain 1 Queen-size Bed and 1 Single Bed with Pull-Out Bed',
            'amount' => '3500.00',
            'capacity' => '4',
            'capacity_extend' => '2',
            'is_occupied' => '0',
            'image' => 'images/rooms/standard.jpg',
            'amenities' => '["Airconditioned Room, Bathroom, Television, Towels"]',
            'created_at' => '2021-04-24 13:08:00',
            'updated_at' => '2021-04-24 13:08:00'
        ]);

        $room14 = Room::create([
            'name' => 'Standard Room 5',
            'description' => 'Good for 4 pax, our standard rooms contain 1 Queen-size Bed and 1 Single Bed with Pull-Out Bed',
            'amount' => '3500.00',
            'capacity' => '4',
            'capacity_extend' => '2',
            'is_occupied' => '0',
            'image' => 'images/rooms/standard.jpg',
            'amenities' => '["Airconditioned Room, Bathroom, Television, Towels"]',
            'created_at' => '2021-04-24 13:08:00',
            'updated_at' => '2021-04-24 13:08:00'
        ]);

        $room15 = Room::create([
            'name' => 'Standard Room 6',
            'description' => 'Good for 4 pax, our standard rooms contain 1 Queen-size Bed and 1 Single Bed with Pull-Out Bed',
            'amount' => '3500.00',
            'capacity' => '4',
            'capacity_extend' => '2',
            'is_occupied' => '0',
            'image' => 'images/rooms/standard.jpg',
            'amenities' => '["Airconditioned Room, Bathroom, Television, Towels"]',
            'created_at' => '2021-04-24 13:08:00',
            'updated_at' => '2021-04-24 13:08:00'
        ]);

        $room16 = Room::create([
            'name' => 'Standard Room 7',
            'description' => 'Good for 4 pax, our standard rooms contain 1 Queen-size Bed and 1 Single Bed with Pull-Out Bed',
            'amount' => '3500.00',
            'capacity' => '4',
            'capacity_extend' => '2',
            'is_occupied' => '0',
            'image' => 'images/rooms/standard.jpg',
            'amenities' => '["Airconditioned Room, Bathroom, Television, Towels"]',
            'created_at' => '2021-04-24 13:08:00',
            'updated_at' => '2021-04-24 13:08:00'
        ]);

        $room17 = Room::create([
            'name' => 'Standard Room 8',
            'description' => 'Good for 4 pax, our standard rooms contain 1 Queen-size Bed and 1 Single Bed with Pull-Out Bed',
            'amount' => '3500.00',
            'capacity' => '4',
            'capacity_extend' => '2',
            'is_occupied' => '0',
            'image' => 'images/rooms/standard.jpg',
            'amenities' => '["Airconditioned Room, Bathroom, Television, Towels"]',
            'created_at' => '2021-04-24 13:08:00',
            'updated_at' => '2021-04-24 13:08:00'
        ]);

        $room18 = Room::create([
            'name' => 'Twin Room',
            'description' => 'Twin Room is perfect for 2 persons that wants to relax as it is also located at the upper level.',
            'amount' => '2800.00',
            'capacity' => '2',
            'capacity_extend' => '2',
            'is_occupied' => '0',
            'image' => 'images/rooms/twin_room.jpg',
            'amenities' => '["Airconditioned Room, Bathroom, Mini Refrigerator, Television, Electric Kettle"]',
            'created_at' => '2021-04-24 13:08:00',
            'updated_at' => '2021-04-24 13:08:00'
        ]);

        $room19 = Room::create([
            'name' => 'Twin Room 2',
            'description' => 'Twin Room is perfect for 2 persons that wants to relax as it is also located at the upper level.',
            'amount' => '2800.00',
            'capacity' => '2',
            'capacity_extend' => '2',
            'is_occupied' => '0',
            'image' => 'images/rooms/twin_room.jpg',
            'amenities' => '["Airconditioned Room, Bathroom, Mini Refrigerator, Television, Electric Kettle"]',
            'created_at' => '2021-04-24 13:08:00',
            'updated_at' => '2021-04-24 13:08:00'
        ]);

        $room20 = Room::create([
            'name' => 'Tree House',
            'description' => 'Enjoy our Tree House that can house 2 people.',
            'amount' => '3000.00',
            'capacity' => '2',
            'capacity_extend' => '2',
            'is_occupied' => '0',
            'image' => 'images/rooms/tree_house.jpg',
            'amenities' => '["Airconditioned Room, Bathroom, Television, Electric Kettle, Towels"]',
            'created_at' => '2021-04-24 13:08:00',
            'updated_at' => '2021-04-24 13:08:00'
        ]);

        $room21 = Room::create([
            'name' => 'Couple Room',
            'description' => 'By the name itself, Couples enjoy our Couple Room the most!',
            'amount' => '3500.00',
            'capacity' => '2',
            'capacity_extend' => '2',
            'is_occupied' => '0',
            'image' => 'images/rooms/couple.jpg',
            'amenities' => '["Hot Showers, Airconditioned Room"]',
            'created_at' => '2021-04-24 13:08:00',
            'updated_at' => '2021-04-24 13:08:00'
        ]);
        
        $admin = User::create([
            'name' => 'Admin1',
            'email' => 'superadmin@email.com',
            'password' => Hash::make('sandbarbr'),
            'role' => 'admin',
            'created_at' => '2021-04-24 13:08:00',
            'updated_at' => '2021-04-24 13:08:00'
        ]);

        $receptionist = User::create([
            'name' => 'First Receptionist',
            'email' => 'receptionist@email.com',
            'password' => Hash::make('sandbarbrrecept'),
            'role' => 'receptionist',
            'created_at' => '2021-04-24 13:08:00',
            'updated_at' => '2021-04-24 13:08:00'
        ]);

        $receptionist2 = User::create([
            'name' => 'Second Receptionist',
            'email' => 'receptionist2@email.com',
            'password' => Hash::make('receptsandbarbr2'),
            'role' => 'receptionist',
            'created_at' => '2021-04-24 13:08:00',
            'updated_at' => '2021-04-24 13:08:00'
        ]);

    }
}
