<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use App\Models\Book;
use App\Models\User;
use App\Models\Editor;
use App\Models\EditionType;

class Edition extends Model
{
    use HasFactory;

    protected $fillable = [
        'edition_date',
        'page_number'
    ];

    /**
     * Get the edition_type associated with the Edition
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function edition_type(): BelongsTo
    {
        return $this->belongsTo(EditionType::class);
    }

    /**
     * Get the editor associated with the Edition
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function editor(): HasOne
    {
        return $this->hasOne(Editor::class);
    }

    /**
     * Get the book associated with the Edition
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * The users that belong to the Edition
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
