<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Job;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->jobTitle,
            'company' => $this->faker->company,
            'description' => $this->faker->paragraph,
            'location' => $this->faker->city . ', ' . $this->faker->stateAbbr,
            'type' => $this->faker->randomElement(['Full-time', 'Part-time', 'Contract']),
            'salary' => $this->faker->numberBetween(50000, 150000),
            'application_deadline' => $this->faker->dateTimeBetween('now', '+1 year'),
        ];
    }
}
