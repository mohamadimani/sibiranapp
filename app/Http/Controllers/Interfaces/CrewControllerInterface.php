<?php

namespace App\Http\Controllers\Interfaces;

use App\Http\Requests\StoreCrewRequest;
use App\Http\Requests\UpdateCrewRequest;
use App\Models\Crew;

interface CrewControllerInterface
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     *
     * @OA\Get(
     *     path="/api/crews",
     *     operationId="getCrews",
     *     tags={"Crews"},
     *     summary="List Of Crew",
     *     description="get list of crew",
     *
     *     @OA\Response(response=200,description="Successful operation"),
     *     @OA\Response(response=404,description="Resource Not Found")
     * )
     */
    public function index();

    /**
     * Display a crew of the resource.
     *
     * @return Response
     * @OA\Get(
     *     path="/api/crews/{crew}",
     *     operationId="crew",
     *     tags={"Crews"},
     *     summary="crew list",
     *     description="get a crew by id",
     *      @OA\Parameter(
     *          name="crew",
     *          description="crew id",
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
    public function show(Crew $crew);

    /**
     * Display a listing of the resource.
     *
     * @return Response
     * @OA\Delete(
     *     path="/api/crews/{crew}",
     *     operationId="deleteCrew",
     *     tags={"Crews"},
     *     summary="delete crew",
     *     description="delete crew",
     *      @OA\Parameter(
     *          name="crew",
     *          description="crew id",
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
    public function destroy(Crew $crew);

    /**
     * Display a listing of the resource.
     *
     * @return Response
     * @OA\Post(
     *     path="/api/crews",
     *     operationId="storeCrew",
     *     tags={"Crews"},
     *     summary="store crew",
     *
     *         @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(type="object",
     *                  required={"name", "family", "role", "birthdate"},
     *                  @OA\Property(property="name", type="string"),
     *                  @OA\Property(property="family", type="string"),
     *                  @OA\Property(property="role", type="number"),
     *                  @OA\Property(property="birthdate", type="date"),
     *            ),
     *        ),
     *    ),
     *
     *      @OA\Response(response=201,description="Successful created"),
     *      @OA\Response(response=400,description="Bad Request"),
     *      @OA\Response(response=422,description="Unprocessable Entity"),
     * )
     */
    public function store(StoreCrewRequest $request);

    /**
     * Display a listing of the resource.
     *
     * @param Crew $crew
     * @param UpdateCrewRequest $UpdateCrewRequest
     * @return JsonResponse
     * @OA\Patch (
     *     path="/api/crews/{crew}",
     *     operationId="updateCrew",
     *     tags={"Crews"},
     *     summary="update crew",
     *     description="update crew",
     *     @OA\Parameter(
     *      name="crew",
     *      description="crew id for update",
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
     *                  @OA\Property(property="name", type="string"),
     *                  @OA\Property(property="family", type="string"),
     *                  @OA\Property(property="role", type="number"),
     *                  @OA\Property(property="birthdate", type="date"),
     *           ),
     *       ),
     *   ),
     *
     *     @OA\Response(response=200,description="Successful operation"),
     *     @OA\Response(response=404,description="Resource Not Found"),
     *     @OA\Response(response=401,description="Bad Request"),
     * )
     */
    public function update(UpdateCrewRequest $request, Crew $crew);
}
