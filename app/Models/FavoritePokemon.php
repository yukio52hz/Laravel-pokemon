<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavoritePokemon extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'pokemon_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
