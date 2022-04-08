<?php

namespace Database\Factories;

use App\Models\User;
use App\Constants\OrderStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'customerName' => $this->faker->name(),
            'customerEmail' => $this->faker->email(),
            'customerDocument' => (string)$this->faker->randomNumber(6),
            'customerPhone' => $this->faker->phoneNumber(),
            'customerAddress' => $this->faker->address(),
            'total' => $this->faker->numberBetween(10000, 999999),
            'status' => OrderStatus::CREATED,
            'reference' => $this->faker->numberBetween(000000, 999999),
            'description' => $this->faker->sentence(),
            'customer_id' => User::factory()->create(),
        ];
    }
}
