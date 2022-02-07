<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Leidy',
            'email' => 'leidy@gmail.com',
            'password' => bcrypt('leidy123'),
        ]);
        
        User::factory(10)->create();
    }
}
