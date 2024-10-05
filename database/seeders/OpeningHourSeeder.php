<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use App\Models\OpeningHour;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OpeningHourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $restaurants = Restaurant::all();

        foreach ($restaurants as $restaurant) {
            for ($day = 0; $day < 7; $day++) {
                // 80% de chance que le restaurant soit ouvert ce jour-là
                if (rand(1, 100) <= 80) {
                    $openTime = rand(6, 11) . ':00:00';  // Ouverture entre 6h et 11h
                    $closeTime = rand(18, 23) . ':00:00';  // Fermeture entre 18h et 23h

                    OpeningHour::create([
                        'restaurant_id' => $restaurant->id,
                        'day_of_week' => $day,
                        'open_time' => $openTime,
                        'close_time' => $closeTime,
                    ]);
                }
            }
        }
    }
}
