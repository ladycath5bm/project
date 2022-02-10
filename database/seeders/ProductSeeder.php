<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::factory(50)->create();
    }
}
