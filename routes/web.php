<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/add_book', [BookController::class, 'create'])->name('book.create');
Route::get('/book/{id}', [BookController::class, 'get'])->name('book.get');
Route::get('/books', [BookController::class, 'getAll'])->name('book.get_all');
Route::post('/create_book', [BookController::class, 'store'])->name('book.store');

Route::post('book/{id}/add_tags', [BookController::class, 'addTags'])->name('book.add_tags');

require __DIR__.'/auth.php';
