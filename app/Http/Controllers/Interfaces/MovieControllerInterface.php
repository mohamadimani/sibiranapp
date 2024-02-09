<?php

namespace App\Http\Controllers\Interfaces;

use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Models\Movie;

interface MovieControllerInterface
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     *
     * @OA\Get(
     *     path="/api/movies",
     *     operationId="getMovies",
     *     tags={"Movies"},
     *     summary="List Of Movie",
     *     description="get list of movie",
     *
     *     @OA\Response(response=200,description="Successful operation"),
     *     @OA\Response(response=404,description="Resource Not Found")
     * )
     */
    public function index();

    /**
     * Display a movie of the resource.
     *
     * @return Response
     * @OA\Get(
     *     path="/api/movies/{movie}",
     *     operationId="getMovie",
     *     tags={"Movies"},
     *     summary="movie list",
     *     description="get a movie by id",
     *      @OA\Parameter(
     *          name="movie",
     *          description="movie id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Response(response=200,description="Successful operation"),
     *     @OA\Response(response=400,description="Bad Request"),
     *     @OA\Response(response=404,description="Resource Not Found")
     * )
     */
    public function show(Movie $movie);

    /**
     * Display a listing of the resource.
     *
     * @return Response
     * @OA\Delete(
     *     path="/api/movies/{movie}",
     *     operationId="deleteMovie",
     *     tags={"Movies"},
     *     summary="delete movie",
     *     description="delete movie",
     *      @OA\Parameter(
     *          name="movie",
     *          description="movie id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(response=200,description="Successful operation"),
     *      @OA\Response(response=400,description="Bad Request"),
     *      @OA\Response(response=404,description="Resource Not Found")
     * )
     */
    public function destroy(Movie $movie);

    /**
     * Display a listing of the resource.
     *
     * @return Response
     * @OA\Post(
     *     path="/api/movies",
     *     operationId="storeMovie",
     *     tags={"Movies"},
     *     summary="store movie",
     *
     *         @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(type="object",
     *                  required={"title", "year", "rank", "description", "genres", "crews"},
     *                  @OA\Property(property="title", type="text"),
     *                  @OA\Property(property="year", type="date"),
     *                  @OA\Property(property="rank", type="number"),
     *                  @OA\Property(property="description", type="text"),
     *                  @OA\Property(property="genres", type="number"),
     *                  @OA\Property(property="crews", type="number"),
     *            ),
     *        ),
     *    ),
     *
     *      @OA\Response(response=201,description="Successful created"),
     *      @OA\Response(response=400,description="Bad Request"),
     *      @OA\Response(response=422,description="Unprocessable Entity"),
     * )
     */
    public function store(StoreMovieRequest $request);

    /**
     * Display a listing of the resource.
     *
     * @param Movie $movie
     * @param UpdateMovieRequest $UpdateMovieRequest
     * @return JsonResponse
     * @OA\Patch (
     *     path="/api/movies/{movie}",
     *     operationId="updateMovie",
     *     tags={"Movies"},
     *     summary="update movie",
     *     description="update movie",
     *     @OA\Parameter(
     *      name="movie",
     *      description="movie id for update",
     *      required=true,
     *      in="path",
     *      @OA\Schema(
     *          type="string",
     *          example="1"
     *      )
     *      ),
     *
     *         @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *              type="object",
     *                  @OA\Property(property="title", type="text"),
     *                  @OA\Property(property="year", type="date"),
     *                  @OA\Property(property="rank", type="number"),
     *                  @OA\Property(property="description", type="text"),
     *                  @OA\Property(property="genres", type="number"),
     *                  @OA\Property(property="crews", type="number"),
     *           ),
     *       ),
     *   ),
     *
     *     @OA\Response(response=200,description="Successful operation"),
     *     @OA\Response(response=404,description="Resource Not Found"),
     *     @OA\Response(response=401,description="Bad Request"),
     * )
     */
    public function update(UpdateMovieRequest $request, Movie $movie);
}
