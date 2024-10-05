<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Restaurant;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $users = User::where('is_restaurateur', false)->get();
        $restaurants = Restaurant::all();

        // Générer entre 200 et 500 commandes
        $orderCount = rand(200, 500);

        for ($i = 0; $i < $orderCount; $i++) {
            $user = $users->random();
            $restaurant = $restaurants->random();
            $menuItems = $restaurant->menuItems;

            $order = Order::create([
                'user_id' => $user->id,
                'restaurant_id' => $restaurant->id,
                'status' => $this->getRandomStatus(),
                'total_amount' => 0,  // Sera calculé plus tard
                'pickup_time' => $this->getRandomPickupTime(),
            ]);

            // Générer entre 1 et 5 articles pour chaque commande
            $itemCount = rand(1, 5);
            $totalAmount = 0;

            for ($j = 0; $j < $itemCount; $j++) {
                $menuItem = $menuItems->random();
                $quantity = rand(1, 3);

                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_item_id' => $menuItem->id,
                    'quantity' => $quantity,
                    'price' => $menuItem->price,
                ]);

                $totalAmount += $menuItem->price * $quantity;
            }

            $order->update(['total_amount' => $totalAmount]);
        }
    }

    private function getRandomStatus()
    {
        $statuses = ['pending', 'preparing', 'ready', 'completed', 'cancelled'];
        return $statuses[array_rand($statuses)];
    }

    private function getRandomPickupTime()
    {
        return now()->addMinutes(rand(15, 120));
    }
}
