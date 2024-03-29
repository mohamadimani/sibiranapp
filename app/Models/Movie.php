<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Redis;

class Movie extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'year', 'rank', 'description'];

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'genre_movie', 'movie_id', 'genre_id');
    }

    public function crews()
    {
        return $this->belongsToMany(Crew::class, 'crew_movie', 'movie_id', 'crew_id');
    }
}
