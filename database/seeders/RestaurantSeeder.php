<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $restaurants = [
            ['name' => 'Restaurant 1', 'address' => '123 Main St', 'phone' => '123-456-7890'],
            ['name' => 'Restaurant 2', 'address' => '456 Elm St', 'phone' => '987-654-3210'],
            // Add more predefined restaurants if needed
        ];

        for ($i = 3; $i <= 10; $i++) {
            Restaurant::create([
                'name' => "Restaurant $i",
                'address' => "$i Some Street",
                'phone' => "555-000-$i",
            ]);
        }

    }
}
