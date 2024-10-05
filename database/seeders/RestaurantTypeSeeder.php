<?php

namespace Database\Seeders;

use App\Models\RestaurantType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RestaurantTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $types = ['Pizzeria', 'Tacos', 'Sandwicherie', 'Asiatique', 'Burger', 'Italien', 'Mexicain', 'Indien', 'Végétarien', 'Fast-food'];
        foreach ($types as $type) {
            RestaurantType::create(['name' => $type]);
        }
    }
}
