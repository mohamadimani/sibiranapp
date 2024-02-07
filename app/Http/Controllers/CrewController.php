<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCrewRequest;
use App\Http\Requests\UpdateCrewRequest;
use App\Http\Resources\CrewCollection;
use App\Http\Resources\CrewResource;
use App\Models\Crew;
use App\Repositories\Interfaces\CrewRepositoryInterface;

class CrewController extends Controller
{
    public function __construct(public CrewRepositoryInterface $crewRepository)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $crews = $this->crewRepository->paginate(
            perPage: config('settings.global.item_per_page'),
            orderBy: ['created_at', 'desc'],
        );

        return apiResponse()
            ->message(__('crew.messages.crews_list'))
            ->data(new CrewCollection($crews))
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
    public function store(StoreCrewRequest $request)
    {
        $crew = $this->crewRepository->create($request->only('name', 'family', 'role', 'birthdate'));

        return apiResponse()
            ->message(__('crew.messages.crew_created'))
            ->data(new CrewResource($crew))
            ->send();
    }

    /**
     * Display the specified resource.
     */
    public function show(Crew $crew)
    {
        return apiResponse()
        ->message('crew.messages.crew_found')
        ->data(new CrewResource($crew))
        ->send();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Crew $crew)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCrewRequest $request, Crew $crew)
    {
        $crew = $this->crewRepository->update($request->validated(), $crew->id);

        return apiResponse()
            ->message(__('crew.messages.crew_updated'))
            ->data(new CrewResource($crew))
            ->send();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Crew $crew)
    {
        $crew = $this->crewRepository->delete($crew->id);

        return apiResponse()
            ->message(__('crew.messages.crew_deleted'))
            ->data([])
            ->send();
    }
}
