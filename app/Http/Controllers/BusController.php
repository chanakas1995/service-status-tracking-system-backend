<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\BusRequest;
use App\Http\Resources\BusResource;
use App\Models\Bus;
use App\Repositories\Contracts\BusRepositoryInterface;
use Illuminate\Http\Request;

class BusController extends Controller
{
    private $busRepository;

    public function __construct(BusRepositoryInterface $busRepository)
    {
        $this->busRepository = $busRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $this->authorize('index_buses');
        return ResponseHelper::findSuccess("list", BusResource::collection($this->busRepository->index()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BusRequest $request)
    {
        $this->authorize('store_bus');
        return ResponseHelper::createSuccess("bus", new BusResource($this->busRepository->store($request->validated())));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function show(Bus $bus)
    {
        $this->authorize('show_bus');
        $bus->load('busModel');
        return ResponseHelper::findSuccess("bus", new BusResource($bus));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function update(BusRequest $request, Bus $bus)
    {
        $this->authorize('update_bus');
        return ResponseHelper::updateSuccess("bus", new BusResource($this->busRepository->update($bus->id, $request->validated())));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bus $bus)
    {
        $this->authorize('destroy_bus');
        return ResponseHelper::deleteSuccess("bus", $this->busRepository->delete($bus->id));
    }
}