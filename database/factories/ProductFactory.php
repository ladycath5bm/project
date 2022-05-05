<?php

namespace Database\Factories;

use App\Constants\ProductStatus;
use App\Models\Category;
use App\Models\Image;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'code' => $this->faker->numberBetween($int1 = 100000, $int2 = 999999),
            'price' => $this->faker->numberBetween(1000, 999999),
            'description' => $this->faker->sentence(),
            'discount' => $this->faker->numberBetween(0, 100),
            'stock' => $this->faker->numberBetween(0, 10000),
            'status' => $this->faker->randomElement(ProductStatus::toArray()),
            'user_id' => 1,
        ];
    }
}
