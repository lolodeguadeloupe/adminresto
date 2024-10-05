<?php

namespace Database\Seeders;

use App\Models\MenuCategory;
use App\Models\MenuItem;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $menuCategories = MenuCategory::all();

        foreach ($menuCategories as $category) {
            $numItems = rand(3, 8);
            MenuItem::factory()->count($numItems)->create([
                'restaurant_id' => $category->restaurant_id,
                'menu_category_id' => $category->id,
            ]);
        }
    }
}
