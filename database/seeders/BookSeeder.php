<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryNames = [
            'Classic Literature',
            'Historical Fiction',
            'Mystery',
            'Science Fiction',
            'Fantasy',
            'Biography',
            'Philosophy',
            'History',
        ];

        $categories = collect($categoryNames)->map(function (string $name) {
            return Category::firstOrCreate(['name' => $name]);
        });

        foreach ($categories as $category) {
            Book::factory()->count(fake()->numberBetween(4, 10))->create([
                'category_id' => $category->id,
            ]);
        }
    }
}
