<?php

namespace Database\Factories;

use App\Models\Tag;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Author;
use App\Models\Editor;
use App\Models\EditionType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Edition>
 */
class EditionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'edition_date' => fake()->date(),
            'page_number' => fake()->randomNumber(3, true),
            'book_id' => Book::factory()                    
                ->hasAttached(Author::factory(), ['writing_date' => now()])
                ->has(Genre::factory(2))
                ->has(Tag::factory(3)),
            'editor_id' => Editor::factory(),
            'edition_type_id' => EditionType::factory()
        ];
    }
}
