<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Restaurant;
use App\Models\RestaurantType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $restaurateurs = User::where('is_restaurateur', true)->get();
        $types = RestaurantType::all();

        foreach ($restaurateurs as $restaurateur) {
            $numRestaurants = rand(1, 5);
            for ($i = 0; $i < $numRestaurants; $i++) {
                Restaurant::factory()->create([
                    'user_id' => $restaurateur->id,
                    'restaurant_type_id' => $types->random()->id,
                ]);
            }
        }
    }
}
