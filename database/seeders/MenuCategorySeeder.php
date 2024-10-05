<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use App\Models\MenuCategory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MenuCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $restaurants = Restaurant::all();
        $categories = ['Entrées', 'Plats principaux', 'Desserts', 'Boissons', 'Spécialités', 'Menu enfant'];

        foreach ($restaurants as $restaurant) {
            foreach ($categories as $category) {
                MenuCategory::create([
                    'restaurant_id' => $restaurant->id,
                    'name' => $category,
                ]);
            }
        }
    }
}
