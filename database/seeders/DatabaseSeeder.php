<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Image;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Storage::deleteDirectory('products');
        Storage::makeDirectory('products');
        
        $this->call(UserSeeder::class);
        //Image::factory(100)->create(); 
        //Category::factory(4)->create();
        Category::factory(10)->create();
        $this->call(ProductSeeder::class);
    }
}
