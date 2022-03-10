<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Image;
use App\Models\Order;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Storage::deleteDirectory('products');
        Storage::makeDirectory('products');

        $this->call(RoleSeeder::class);
        
        $this->call(UserSeeder::class);
        
        Category::factory(10)->create();
        
        $this->call(ProductSeeder::class);

        Order::factory(10)->create();
        
    }
}
