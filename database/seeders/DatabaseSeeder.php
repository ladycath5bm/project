<?php

namespace Database\Seeders;

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

        $this->call(CategorySeeder::class);

        $this->call(ProductSeeder::class);

        $this->call(OrderSeeder::class);
    }
}
