<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'description' => fake()->sentence(),
            'long_description' => fake()->paragraph(),
            // 'completed' => false,
            'completed' => fake()->boolean(), // Uncomment if you want random completion status
            // 'completed' => fake()->randomElement([true, false]), // Another way to randomize completion status
        ];
    }
}
