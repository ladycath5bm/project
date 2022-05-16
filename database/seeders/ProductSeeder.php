<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void 
    {
        Product::factory(10)->create()
            ->each(function (Product $product) {
                Image::factory()->count(4)->create([
                    'product_id' => $product->id,
                ]);
                $product->category()
                    ->associate(Category::inRandomOrder()
                        ->first()
                        ->id
                    );
                $product->user()
                    ->associate(User::inRandomOrder()
                        ->first()
                        ->id
                    );
                $product->save();
            });
    }
}
