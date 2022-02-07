<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Image;
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
        
        //User::factory(10)->create();

        $users = User::factory(10)->create();

        foreach ($users as $user) {
            Image::factory(1)->create([
                'imageable_id' => $user->id, 
                'imageable_type' => User::class]);
        }
    }
}
