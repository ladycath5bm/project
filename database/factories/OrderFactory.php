<?php

namespace Database\Factories;

use App\Constants\OrderStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'customer_name' => $this->faker->name(),
            'customer_document' => (string)$this->faker->randomNumber(6),
            'customer_email' => $this->faker->email(),
            'customer_phone' => $this->faker->phoneNumber(),
            'customer_address' => $this->faker->address(),
            'total' => $this->faker->numberBetween(10000, 999999),
            'status' => OrderStatus::CREATED,
            'reference' => $this->faker->numberBetween(000000, 999999),
            'description' => $this->faker->sentence(),
            'customer_id' => User::factory()->create()->assignRole('custom'),
        ];
    }
}
