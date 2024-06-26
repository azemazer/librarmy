<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use App\Models\Edition;

class Editor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    /**
     * The editions that belong to the Editor
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function editions(): BelongsToMany
    {
        return $this->belongsToMany(Edition::class);
    }
}
