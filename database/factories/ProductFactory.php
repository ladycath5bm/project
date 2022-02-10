<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'code' => $this->faker->numberBetween($int1 = 1, $int2 = 9999999),
            'price' => $this->faker->numberBetween(100, 999),
            'discount' => $this->faker->numberBetween(0,100),
            'stock' => $this->faker->numberBetween(0,10000),
            'status' => $this->faker->randomElement([false, true]),
            'category_id' => Category::factory()->create()->id,
            'image_id' => Image::factory()->create()->id,
            'user_id' => User::factory()->create()->id,
            
        ];
    }
}
