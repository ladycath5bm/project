<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->firstName(),
            'code' => $this->faker->numberBetween($int1 = 1, $int2 = 9999999),
            'price' => $this->faker->numberBetween(100, 999),
            'discount' => $this->faker->numberBetween(0,100),
            'stock' => $this->faker->numberBetween(0,10000),
            'category_id' => Category::all()->random()->id,
        ];
    }
}
