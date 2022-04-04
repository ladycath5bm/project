<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Support\Arrayable;

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


