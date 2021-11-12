<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;
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
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur suscipit neque diam, et pretium lorem maximus a. Curabitur ultricies, dolor et fringilla ultrices, arcu turpis rutrum dolor, vitae posuere metus elit vel turpis.',
            'amount' => '13000.00',
            'capacity' => '20',
            'capacity_extend' => '2',
            'is_occupied' => '0',
            'image' => 'images/rooms/room.jpg',
            'amenities' => '["Hot Showers, Airconditioned Room"]',
            'created_at' => '2021-04-24 13:08:00',
            'updated_at' => '2021-04-24 13:08:00'
        ]);

        $room2 = Room::create([
            'name' => 'Villa Family Room',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur suscipit neque diam, et pretium lorem maximus a. Curabitur ultricies, dolor et fringilla ultrices, arcu turpis rutrum dolor, vitae posuere metus elit vel turpis.',
            'amount' => '8000.00',
            'capacity' => '10',
            'capacity_extend' => '2',
            'is_occupied' => '0',
            'image' => 'images/rooms/room.jpg',
            'amenities' => '["Hot Showers, Airconditioned Room"]',
            'created_at' => '2021-04-24 13:08:00',
            'updated_at' => '2021-04-24 13:08:00'
        ]);

        $room3 = Room::create([
            'name' => 'Villa Family Room 2',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur suscipit neque diam, et pretium lorem maximus a. Curabitur ultricies, dolor et fringilla ultrices, arcu turpis rutrum dolor, vitae posuere metus elit vel turpis.',
            'amount' => '8000.00',
            'capacity' => '10',
            'capacity_extend' => '2',
            'is_occupied' => '0',
            'image' => 'images/rooms/room.jpg',
            'amenities' => '["Hot Showers, Airconditioned Room"]',
            'created_at' => '2021-04-24 13:08:00',
            'updated_at' => '2021-04-24 13:08:00'
        ]);

        $room4 = Room::create([
            'name' => 'Family Deluxe Room',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur suscipit neque diam, et pretium lorem maximus a. Curabitur ultricies, dolor et fringilla ultrices, arcu turpis rutrum dolor, vitae posuere metus elit vel turpis.',
            'amount' => '5200.00',
            'capacity' => '6',
            'capacity_extend' => '2',
            'is_occupied' => '0',
            'image' => 'images/rooms/room.jpg',
            'amenities' => '["Hot Showers, Airconditioned Room"]',
            'created_at' => '2021-04-24 13:08:00',
            'updated_at' => '2021-04-24 13:08:00'
        ]);

        $room5 = Room::create([
            'name' => 'Family Deluxe Room 2',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur suscipit neque diam, et pretium lorem maximus a. Curabitur ultricies, dolor et fringilla ultrices, arcu turpis rutrum dolor, vitae posuere metus elit vel turpis.',
            'amount' => '5200.00',
            'capacity' => '6',
            'capacity_extend' => '2',
            'is_occupied' => '0',
            'image' => 'images/rooms/room.jpg',
            'amenities' => '["Hot Showers, Airconditioned Room"]',
            'created_at' => '2021-04-24 13:08:00',
            'updated_at' => '2021-04-24 13:08:00'
        ]);

        $room6 = Room::create([
            'name' => 'Family Deluxe Room 3',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur suscipit neque diam, et pretium lorem maximus a. Curabitur ultricies, dolor et fringilla ultrices, arcu turpis rutrum dolor, vitae posuere metus elit vel turpis.',
            'amount' => '5200.00',
            'capacity' => '6',
            'capacity_extend' => '2',
            'is_occupied' => '0',
            'image' => 'images/rooms/room.jpg',
            'amenities' => '["Hot Showers, Airconditioned Room"]',
            'created_at' => '2021-04-24 13:08:00',
            'updated_at' => '2021-04-24 13:08:00'
        ]);

        $room7 = Room::create([
            'name' => 'Family Deluxe Room 4',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur suscipit neque diam, et pretium lorem maximus a. Curabitur ultricies, dolor et fringilla ultrices, arcu turpis rutrum dolor, vitae posuere metus elit vel turpis.',
            'amount' => '5200.00',
            'capacity' => '6',
            'capacity_extend' => '2',
            'is_occupied' => '0',
            'image' => 'images/rooms/room.jpg',
            'amenities' => '["Hot Showers, Airconditioned Room"]',
            'created_at' => '2021-04-24 13:08:00',
            'updated_at' => '2021-04-24 13:08:00'
        ]);

        $room8 = Room::create([
            'name' => 'Family Regular Room',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur suscipit neque diam, et pretium lorem maximus a. Curabitur ultricies, dolor et fringilla ultrices, arcu turpis rutrum dolor, vitae posuere metus elit vel turpis.',
            'amount' => '5200.00',
            'capacity' => '6',
            'capacity_extend' => '2',
            'is_occupied' => '0',
            'image' => 'images/rooms/room.jpg',
            'amenities' => '["Hot Showers, Airconditioned Room"]',
            'created_at' => '2021-04-24 13:08:00',
            'updated_at' => '2021-04-24 13:08:00'
        ]);

        $room9 = Room::create([
            'name' => 'Family Regular Room 2',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur suscipit neque diam, et pretium lorem maximus a. Curabitur ultricies, dolor et fringilla ultrices, arcu turpis rutrum dolor, vitae posuere metus elit vel turpis.',
            'amount' => '5200.00',
            'capacity' => '6',
            'capacity_extend' => '2',
            'is_occupied' => '0',
            'image' => 'images/rooms/room.jpg',
            'amenities' => '["Hot Showers, Airconditioned Room"]',
            'created_at' => '2021-04-24 13:08:00',
            'updated_at' => '2021-04-24 13:08:00'
        ]);

        $room10 = Room::create([
            'name' => 'Standard Room',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur suscipit neque diam, et pretium lorem maximus a. Curabitur ultricies, dolor et fringilla ultrices, arcu turpis rutrum dolor, vitae posuere metus elit vel turpis.',
            'amount' => '3500.00',
            'capacity' => '4',
            'capacity_extend' => '2',
            'is_occupied' => '0',
            'image' => 'images/rooms/room.jpg',
            'amenities' => '["Hot Showers, Airconditioned Room"]',
            'created_at' => '2021-04-24 13:08:00',
            'updated_at' => '2021-04-24 13:08:00'
        ]);

        $room11 = Room::create([
            'name' => 'Standard Room 2',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur suscipit neque diam, et pretium lorem maximus a. Curabitur ultricies, dolor et fringilla ultrices, arcu turpis rutrum dolor, vitae posuere metus elit vel turpis.',
            'amount' => '3500.00',
            'capacity' => '4',
            'capacity_extend' => '2',
            'is_occupied' => '0',
            'image' => 'images/rooms/room.jpg',
            'amenities' => '["Hot Showers, Airconditioned Room"]',
            'created_at' => '2021-04-24 13:08:00',
            'updated_at' => '2021-04-24 13:08:00'
        ]);

        $room12 = Room::create([
            'name' => 'Standard Room 3',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur suscipit neque diam, et pretium lorem maximus a. Curabitur ultricies, dolor et fringilla ultrices, arcu turpis rutrum dolor, vitae posuere metus elit vel turpis.',
            'amount' => '3500.00',
            'capacity' => '4',
            'capacity_extend' => '2',
            'is_occupied' => '0',
            'image' => 'images/rooms/room.jpg',
            'amenities' => '["Hot Showers, Airconditioned Room"]',
            'created_at' => '2021-04-24 13:08:00',
            'updated_at' => '2021-04-24 13:08:00'
        ]);

        $room13 = Room::create([
            'name' => 'Standard Room 4',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur suscipit neque diam, et pretium lorem maximus a. Curabitur ultricies, dolor et fringilla ultrices, arcu turpis rutrum dolor, vitae posuere metus elit vel turpis.',
            'amount' => '3500.00',
            'capacity' => '4',
            'capacity_extend' => '2',
            'is_occupied' => '0',
            'image' => 'images/rooms/room.jpg',
            'amenities' => '["Hot Showers, Airconditioned Room"]',
            'created_at' => '2021-04-24 13:08:00',
            'updated_at' => '2021-04-24 13:08:00'
        ]);

        $room14 = Room::create([
            'name' => 'Standard Room 5',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur suscipit neque diam, et pretium lorem maximus a. Curabitur ultricies, dolor et fringilla ultrices, arcu turpis rutrum dolor, vitae posuere metus elit vel turpis.',
            'amount' => '3500.00',
            'capacity' => '4',
            'capacity_extend' => '2',
            'is_occupied' => '0',
            'image' => 'images/rooms/room.jpg',
            'amenities' => '["Hot Showers, Airconditioned Room"]',
            'created_at' => '2021-04-24 13:08:00',
            'updated_at' => '2021-04-24 13:08:00'
        ]);

        $room15 = Room::create([
            'name' => 'Standard Room 6',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur suscipit neque diam, et pretium lorem maximus a. Curabitur ultricies, dolor et fringilla ultrices, arcu turpis rutrum dolor, vitae posuere metus elit vel turpis.',
            'amount' => '3500.00',
            'capacity' => '4',
            'capacity_extend' => '2',
            'is_occupied' => '0',
            'image' => 'images/rooms/room.jpg',
            'amenities' => '["Hot Showers, Airconditioned Room"]',
            'created_at' => '2021-04-24 13:08:00',
            'updated_at' => '2021-04-24 13:08:00'
        ]);

        $room16 = Room::create([
            'name' => 'Standard Room 7',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur suscipit neque diam, et pretium lorem maximus a. Curabitur ultricies, dolor et fringilla ultrices, arcu turpis rutrum dolor, vitae posuere metus elit vel turpis.',
            'amount' => '3500.00',
            'capacity' => '4',
            'capacity_extend' => '2',
            'is_occupied' => '0',
            'image' => 'images/rooms/room.jpg',
            'amenities' => '["Hot Showers, Airconditioned Room"]',
            'created_at' => '2021-04-24 13:08:00',
            'updated_at' => '2021-04-24 13:08:00'
        ]);

        $room17 = Room::create([
            'name' => 'Standard Room 8',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur suscipit neque diam, et pretium lorem maximus a. Curabitur ultricies, dolor et fringilla ultrices, arcu turpis rutrum dolor, vitae posuere metus elit vel turpis.',
            'amount' => '3500.00',
            'capacity' => '4',
            'capacity_extend' => '2',
            'is_occupied' => '0',
            'image' => 'images/rooms/room.jpg',
            'amenities' => '["Hot Showers, Airconditioned Room"]',
            'created_at' => '2021-04-24 13:08:00',
            'updated_at' => '2021-04-24 13:08:00'
        ]);

        $room18 = Room::create([
            'name' => 'Twin Room',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur suscipit neque diam, et pretium lorem maximus a. Curabitur ultricies, dolor et fringilla ultrices, arcu turpis rutrum dolor, vitae posuere metus elit vel turpis.',
            'amount' => '2800.00',
            'capacity' => '2',
            'capacity_extend' => '2',
            'is_occupied' => '0',
            'image' => 'images/rooms/room.jpg',
            'amenities' => '["Hot Showers, Airconditioned Room"]',
            'created_at' => '2021-04-24 13:08:00',
            'updated_at' => '2021-04-24 13:08:00'
        ]);

        $room19 = Room::create([
            'name' => 'Twin Room 2',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur suscipit neque diam, et pretium lorem maximus a. Curabitur ultricies, dolor et fringilla ultrices, arcu turpis rutrum dolor, vitae posuere metus elit vel turpis.',
            'amount' => '2800.00',
            'capacity' => '2',
            'capacity_extend' => '2',
            'is_occupied' => '0',
            'image' => 'images/rooms/room.jpg',
            'amenities' => '["Hot Showers, Airconditioned Room"]',
            'created_at' => '2021-04-24 13:08:00',
            'updated_at' => '2021-04-24 13:08:00'
        ]);

        $room20 = Room::create([
            'name' => 'Tree House',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur suscipit neque diam, et pretium lorem maximus a. Curabitur ultricies, dolor et fringilla ultrices, arcu turpis rutrum dolor, vitae posuere metus elit vel turpis.',
            'amount' => '3000.00',
            'capacity' => '2',
            'capacity_extend' => '2',
            'is_occupied' => '0',
            'image' => 'images/rooms/room.jpg',
            'amenities' => '["Hot Showers, Airconditioned Room"]',
            'created_at' => '2021-04-24 13:08:00',
            'updated_at' => '2021-04-24 13:08:00'
        ]);

        $room21 = Room::create([
            'name' => 'Couple Room',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur suscipit neque diam, et pretium lorem maximus a. Curabitur ultricies, dolor et fringilla ultrices, arcu turpis rutrum dolor, vitae posuere metus elit vel turpis.',
            'amount' => '3500.00',
            'capacity' => '2',
            'capacity_extend' => '2',
            'is_occupied' => '0',
            'image' => 'images/rooms/room.jpg',
            'amenities' => '["Hot Showers, Airconditioned Room"]',
            'created_at' => '2021-04-24 13:08:00',
            'updated_at' => '2021-04-24 13:08:00'
        ]);
    }
}
