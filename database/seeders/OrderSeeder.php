<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Image;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        Order::factory(10)->create()
            ->each(function (Order $order) {
                $product = Product::factory()->create();

                Image::factory()->create([
                    'product_id' => $product->id,
                ]);
                $product->category()
                    ->associate(
                        Category::inRandomOrder()
                        ->first()
                        ->id
                    );
                $product->user()
                    ->associate(
                        User::inRandomOrder()
                        ->first()
                        ->id
                    );
                $product->save();

                $order->products()->attach($product->id, [
                    'quantity' => 2,
                    'price' => $product->price,
                    'subtotal' => $product->price * 2,
                ]);
            });
    }
}
