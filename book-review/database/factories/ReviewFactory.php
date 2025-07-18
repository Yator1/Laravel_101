<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \App\Models\Book;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'book_id' => Book::factory(),
            'review' => $this->faker->paragraph(),
            'rating' => $this->faker->numberBetween(1, 5),
            'created_at' => fake()->dateTimeBetween('-2 year', 'now'),
            'updated_at' => fake()->dateTimeBetween('created_at', 'now'),
        ];
    }

    public function good(){
        return $this->state(function (array $attributes) {
            return [
                'rating' => $this->faker->numberBetween(4, 5),
            ];
        });
    }

    public function average(){
        return $this->state(function (array $attributes) {
            return [
                'rating' => $this->faker->numberBetween(3, 4),
            ];
        });
    }

    public function bad(){
        return $this->state(function (array $attributes) {
            return [
                'rating' => $this->faker->numberBetween(1, 2),
            ];
        });
    }
}
