<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void 
    {
        Product::factory(20)->create()
            ->each(function (Product $product) {
                Image::factory()->create([
                    'product_id' => $product->id,
                ]);
                $product->category_id = Category::inRandomOrder()->first()->id;
            });
    }
}
