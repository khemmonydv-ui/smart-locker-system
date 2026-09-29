<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        $locations = [
            ['name' => 'Central Library', 'address' => '123 Main Street, City Center', 'distance_km' => 1.2, 'available_slots' => 24, 'is_open' => true],
            ['name' => 'Riverside Branch', 'address' => '48 Riverside Ave, Old Town', 'distance_km' => 2.4, 'available_slots' => 12, 'is_open' => true],
            ['name' => 'Eastside Community Library', 'address' => '210 Elm Street, Eastside', 'distance_km' => 3.1, 'available_slots' => 0, 'is_open' => false],
            ['name' => 'North Hill Library', 'address' => '77 Hilltop Road, North Hill', 'distance_km' => 4.6, 'available_slots' => 8, 'is_open' => true],
            ['name' => 'Downtown Reading Room', 'address' => '5 Market Square, Downtown', 'distance_km' => 0.8, 'available_slots' => 3, 'is_open' => false],
        ];

        foreach ($locations as $location) {
            Location::create($location);
        }
    }
}
