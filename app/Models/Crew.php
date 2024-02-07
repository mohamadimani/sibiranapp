<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crew extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'family', 'role', 'birthdate'];

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'crew_movie', 'crew_id', 'movie_id');
    }
}
