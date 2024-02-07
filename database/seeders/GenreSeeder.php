<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{

    private $genres = [
        'Action Genre',
        'Animation Genre',
        'Comedy Genre',
        'Crime Genre',
        'Drama Genre',
        'Experimental Genre',
        'Fantasy Genre',
        'Historical Genre',
        'Horror Genre',
        'Romance Genre',
        'Science Fiction Genre',
        'Thriller Genre',
        'Western Genre',
        'Other Genres',
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->genres as $genre) {
            Genre::create(['title' => $genre]);
        }
    }
}
