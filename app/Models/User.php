<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Models\Book;
use App\Models\Edition;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get all of the editions for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function editions(): BelongsToMany
    {
        return $this
        ->belongsToMany(Edition::class)
        ->withPivot([
            'acquisition_date', 'quantity', 'reading_status'
        ])
        ->withTimestamps();
    }

    /**
     * Get all of the wanted books for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function wishlisted_books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class);
    }
}
