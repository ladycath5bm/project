<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'total' => $this->faker->numberBetween(10000, 999999),
            'status' => $this->faker->randomElement(['pending', 'complete']),
            'description' => $this->faker->sentence(),
        ];
    }
}
