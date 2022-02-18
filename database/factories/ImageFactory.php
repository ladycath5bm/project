<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    
    public function definition(): array
    {
        return [
            'url' => 'products/' . $this->faker->image('public/storage/products', 640, 480, null, false),
            'product_id' => Product::inRandomOrder()->first()->id,
        ];
    }
}
