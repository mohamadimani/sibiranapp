<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Interfaces\MovieControllerInterface;
use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Http\Resources\MovieCollection;
use App\Http\Resources\MovieResource;
use App\Models\Movie;
use App\Repositories\Interfaces\MovieRepositoryInterface;
use Illuminate\Support\Facades\Redis;

class MovieController extends Controller implements MovieControllerInterface
{
    public function __construct(public MovieRepositoryInterface $movieRepository)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movies = [];
        if ($movies = Redis::get('movie_list')) {
            $movies = unserialize($movies);
        } else {
            $movies = $this->movieRepository->setMovieListInCatch();
        }
        return apiResponse()
            ->message(__('movie.messages.movies_list'))
            ->data(new MovieCollection($movies))
            ->send();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMovieRequest $request)
    {
        $movie = $this->movieRepository->create($request->only('title', 'description', 'year', 'rank'));
        $movie->genres()->attach($request->genres);
        $movie->crews()->attach($request->crews);


        return apiResponse()
            ->message(__('movie.messages.movie_created'))
            ->data(new MovieResource($movie))
            ->send();
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie)
    {
        return apiResponse()
            ->message(__('movie.messages.movie_found'))
            ->data(new MovieResource($movie))
            ->send();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMovieRequest $request, Movie $movie)
    {
        $movie = $this->movieRepository->update($request->validated(), $movie->id, withTrashed: true);
        $movie->genres()->sync($request->genres);
        $movie->crews()->sync($request->crews);

        return apiResponse()
            ->message(__('movie.messages.movie_updated'))
            ->data(new MovieResource($movie))
            ->send();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        $movie = $this->movieRepository->delete($movie->id);

        return apiResponse()
            ->message(__('movie.messages.movie_deleted'))
            ->data([])
            ->send();
    }
}
