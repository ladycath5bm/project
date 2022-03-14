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
            'reference' => $this->faker->numberBetween(000000, 999999),
            'description' => $this->faker->sentence(),
        ];
    }
}
