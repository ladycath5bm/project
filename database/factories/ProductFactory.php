<?php

namespace Database\Factories;

use App\Constants\ProductStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'code' => $this->faker->numberBetween(100000, 999999),
            'price' => $this->faker->numberBetween(1000, 999999),
            'description' => $this->faker->sentence(),
            'discount' => $this->faker->numberBetween(0, 100),
            'stock' => $this->faker->numberBetween(0, 10000),
            'status' => $this->faker->randomElement(ProductStatus::toArray()),
        ];
    }
}
