<?php

namespace Database\Factories;

use App\Enums\BookStatus;
use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->company(),
            'author' => fake()->name(),
            'page_count' => fake()->numberBetween(50, 2000),
            'release' => fake()->date(),
            'status' => BookStatus::Available
        ];
    }
}
