<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(50)->create();

        // Créer 30 restaurateurs
        User::factory()->count(30)->create(['is_restaurateur' => true]);
    }
}
