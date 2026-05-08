<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
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
        $publishedDate = fake()->optional(0.85)->dateTimeBetween('-80 years', 'now');
        $isbn = fake()->boolean(90)
            ? fake()->unique()->numerify('978##########')
            : null;

        return [
            'title' => fake()->sentence(3),
            'author' => fake()->name(),
            'category_id' => Category::factory(),
            'isbn' => $isbn,
            'published_date' => $publishedDate ? $publishedDate->format('Y-m-d') : null,
            'description' => fake()->optional(0.75)->paragraph(3),
        ];
    }
}
