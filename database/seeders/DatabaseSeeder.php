<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'is_admin' => true
        ]);

        $this->call([
            UserSeeder::class,
            RestaurantTypeSeeder::class,
            RestaurantSeeder::class,
            MenuCategorySeeder::class,
            MenuItemSeeder::class,
            OpeningHourSeeder::class,
            OrderSeeder::class,  // Ajout du nouveau seeder
        ]);
    }
}
