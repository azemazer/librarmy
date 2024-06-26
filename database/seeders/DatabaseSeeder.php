<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Book;
use App\Models\User;
use App\Models\Genre;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Author;
use App\Models\Edition;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::factory(10)
            ->hasAttached(Edition::factory(3), [
                'acquisition_date' => now()
            ])
            ->has(
                Book::factory(5)
                    ->hasAttached(Author::factory(), ['writing_date' => now()])
                    ->has(Genre::factory(2))
                    ->has(Tag::factory(3))
            , 'wishlisted_books')
            ->create();
    }
}
