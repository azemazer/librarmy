<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use App\Models\Edition;

class EditionType extends Model
{
    use HasFactory;

    protected $fillable = [
        'label'
    ];

    /**
     * The editions that belong to the EditionType
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function editions(): BelongsToMany
    {
        return $this->belongsToMany(Edition::class);
    }
}
