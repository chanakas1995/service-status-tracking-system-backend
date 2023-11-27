<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\TripRequest;
use App\Http\Resources\TripResource;
use App\Models\Trip;
use App\Repositories\Contracts\TripRepositoryInterface;
use Illuminate\Http\Request;

class TripController extends Controller
{
    private $tripRepository;

    public function __construct(TripRepositoryInterface $tripRepository)
    {
        $this->tripRepository = $tripRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $this->authorize('index_trips');
        return ResponseHelper::findSuccess("list", TripResource::collection($this->tripRepository->index()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TripRequest $request)
    { 
        $this->authorize('store_trip');
        return ResponseHelper::createSuccess("trip", new TripResource($this->tripRepository->store($request->validated())));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function show(Trip $trip)
    {
        $this->authorize('show_trip');
        $trip->load('bus');
        $trip->load('route');
        return ResponseHelper::findSuccess("trip", new TripResource($trip));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function update(TripRequest $request, Trip $trip)
    {
        $this->authorize('update_trip');
        return ResponseHelper::updateSuccess("trip", new TripResource($this->tripRepository->update($trip->id, $request->validated())));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trip $trip)
    {
        $this->authorize('destroy_trip');
        return ResponseHelper::deleteSuccess("trip", $this->tripRepository->delete($trip->id));
    }
   
}