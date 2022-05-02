<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        Order::factory(10)->create()
            ->each(function (Order $order) {
                $product = Product::factory()->create();

                $order->products()->attach($product->id, [
                    'quantity' => $this->faker->numberBetween(1,10),
                    'price' => $this->faker->numberBetween(10000, 999999),
                    'subtotal' => $this->faker->numberBetween(10000, 999999),
                ]);
            });
    }
}
