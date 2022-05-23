<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::factory(30)->create()
            ->each(function (Product $product) {
                Image::factory()->count(4)->create([
                    'product_id' => $product->id,
                ]);
                $product->category()
                    ->associate(
                        Category::inRandomOrder()
                        ->first()
                        ->id
                    );
                $product->user()
                    ->associate(1);
                $product->save();
            });
    }
}
