<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::factory(200)->create();

        foreach ($products as $product) {
            Image::factory(1)->create([
                'imageable_id' => $product->id, 
                'imageable_type' => Product::class]);
        }
    }
}
