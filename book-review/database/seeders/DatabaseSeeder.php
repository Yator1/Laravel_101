<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::factory(33)->create()->each(function (Book $book) {
            $numReviews = random_int(5, 30);

            Review::factory()->count($numReviews)
            ->good()
            ->for($book)
            ->create();
        });

        Book::factory(34)->create()->each(function (Book $book) {
            $numReviews = random_int(5, 30);

            Review::factory()->count($numReviews)
                ->average()
                ->for($book)
                ->create();
        });

        Book::factory(33)->create()->each(function (Book $book) {
            $numReviews = random_int(5, 30);

            Review::factory()->count($numReviews)
                ->bad()
                ->for($book)
                ->create();
        });
    }
}
