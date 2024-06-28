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
    Route::get('/profile/librarmy', [ProfileController::class, 'editEdition'])->name('profile.edit_edition');
    Route::post('/profile/add_edition/{id}', [ProfileController::class, 'addEdition'])->name('profile.add_edition');
    Route::delete('/profile/delete_edition/{id}', [ProfileController::class, 'deleteEdition'])->name('profile.delete_edition');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/book/{id}/wishlist', [BookController::class, 'addToWishlist'])->name('book.add_wishlist');
    Route::delete('/book/{id}/wishlist', [BookController::class, 'deleteFromWishlist'])->name('book.delete_wishlist');
});

Route::get('/add_book', [BookController::class, 'create'])->name('book.create');
Route::get('/book/{id}', [BookController::class, 'get'])->name('book.get');
Route::get('/books', [BookController::class, 'getAll'])->name('book.get_all');
Route::post('/create_book', [BookController::class, 'store'])->name('book.store');

Route::post('book/{id}/add_tags', [BookController::class, 'addTags'])->name('book.add_tags');

require __DIR__.'/auth.php';
