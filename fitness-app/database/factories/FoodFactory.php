<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Food>
 */
class FoodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word,
            'protein' => $this->faker->randomFloat(1, 0, 50),
            'carbs' => $this->faker->randomFloat(1, 0, 100),
            'fat' => $this->faker->randomFloat(1, 0, 50),
            'grams' => $this->faker->randomFloat(1, 0, 500),
        ];
    }
}
