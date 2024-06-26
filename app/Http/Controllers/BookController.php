<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Book;
use Inertia\Inertia;
use App\Models\Genre;
use Inertia\Response;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use PhpParser\Node\Expr\Cast\Array_;

class BookController extends Controller
{
    // Returns the vue to add a book into the database.
    public function create(): Response
    {
        $authors = Author::get();
        return Inertia::render('Books/Add', [
            'authors' => $authors
        ]);
    }

    // Saves a book and redirects to the view of this book.
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:64',
            'summary' => 'string|max:255',
            'author' => 'required|integer'
        ]);

        $author = Author::find($request->author);

        $book = Book::create([
            'title' => $request->title,
            'summary' => $request->summary,
            'author' => $author
        ]);

        return redirect(route('book.get', ["id" => $book->id]));
    }

    public function get(Request $request, $id): Response
    {
        $book = Book::where('id', $id)
        ->with('authors', 'genres', 'tags')
        ->first();

        $tags = Tag::all();
        $genres = Genre::all();
        return Inertia::render('Books/Get', [
            'book' => $book,
            'all_genres' => $genres,
            'all_tags' => $tags
        ]);
    }

    public function getAll(): Response
    {
        $books = Book::with('authors')
        ->get();
        return Inertia::render('Books/GetAll', [
            'books' => $books
        ]);
    }

    public function addTags(Request $request, $id)
    {
        $request->validate([
            'tags' => 'required|array',
        ]);
        $tags_array = [];

        foreach($request->tags as $tag) {
            array_push($tags_array, Tag::firstOrCreate(['name' => $tag['name']]));
        }

        $book = Book::where('id', $id)
            ->with('tags','genres','authors')
            ->first();

        $book->tags()->sync(collect($tags_array)->pluck('id'));

        return $book->refresh();
    }
}
