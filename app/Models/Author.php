<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use App\Models\Book;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Author extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'surname',
        'nickname'
    ];

    protected $appends = ['formatted_name'];

    /**
     * The roles that belong to the Author
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class);
    }

    /**
     * Compound of all name elements available
     *
     * @return String
     */
    public function formattedName()
    {
        $name = $this->name;
        $surname = $this->surname;
        $nick = $this->nickname;

        if (!$nick || $nick === ""){
            if ((!$name || $name === "") && (!$surname || $surname === "")){
                return 'Unknown';
            }
            else if (!$name || $name === ""){return $surname;}
            else if (!$surname || $surname === ""){return $name;}
            else {return $name . ' ' . $surname;}
        }
        else {
            if ((!$name || $name === "") && (!$surname || $surname === "")){
                return $nick;
            }
            else if (!$name || $name === ""){
                return '"' . $nick . '" ' . $surname;
            }
            else if (!$surname || $surname === ""){
                return $name . ' "' . $nick . '"';
            }
            else {return $name . ' "' . $nick . '" ' . $surname;}
        }
    }

    public function getFormattedNameAttribute() {
        return $this->formattedName();
    }

    // public function otherFormattedName(): Attribute {
    //     return new Attribute(
    //         get: fn() => $this->formattedName(),
    //     );
    // }
}
