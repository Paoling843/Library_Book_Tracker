<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $fallback = 1;

        $names = [
            'Classic Literature',
            'Historical Fiction',
            'Mystery',
            'Science Fiction',
            'Fantasy',
            'Biography',
            'Philosophy',
            'History',
            'Poetry',
            'Psychology',
            'Religion',
            'Travel Writing',
        ];

        $pool = array_merge($names, ["Collection {$fallback}"]);
        $fallback++;

        return [
            'name' => fake()->unique()->randomElement($pool),
        ];
    }
}
