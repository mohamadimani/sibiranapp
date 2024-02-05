<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Http\Resources\MovieResource;
use App\Models\Movie;
use App\Repositories\Interfaces\MovieRepositoryInterface;

class MovieController extends Controller
{
    public function __construct(public MovieRepositoryInterface $movieRepository)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
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
        //
    }
}
