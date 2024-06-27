<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Edition;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    public function editEdition(Request $request): Response
    {
        $editions = $request->user()
        ->editions()
        ->with(
            'book', 
            'book.authors', 
            'book.genres', 
            'book.tags', 
            'edition_type')
        ->get();

        $all_editions = Edition::with(
            'book', 
            'book.authors', 
            'book.genres', 
            'book.tags', 
            'edition_type')
        ->get();

        // dd($all_editions);

        return Inertia::render('Profile/EditEdition', [
            'editions' => $editions,
            'all_editions' => $all_editions
        ]);
    }

    public function addEdition(Request $request, $id)
    {
        $edition = Edition::with(
            'book', 
            'book.authors', 
            'book.genres', 
            'book.tags', 
            'edition_type')
        ->where('id', $id)
        ->first();
        // Attach pivot: how?
        $edition->acquisition_date = now();
        $request->user()->editions()->attach()
        ->save($edition);
        return $edition[0];
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
