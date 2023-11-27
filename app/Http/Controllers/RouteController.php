<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\RouteRequest;
use App\Http\Resources\RouteResource;
use App\Models\Route;
use App\Repositories\Contracts\RouteRepositoryInterface;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    private $routeRepository;

    public function __construct(RouteRepositoryInterface $routeRepository)
    {
        $this->routeRepository = $routeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $this->authorize('index_routes');
        return ResponseHelper::findSuccess("list", RouteResource::collection($this->routeRepository->index()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RouteRequest $request)
    { 
        $this->authorize('store_route');
        return ResponseHelper::createSuccess("route", new RouteResource($this->routeRepository->store($request->validated())));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function show(Route $route)
    {
        $this->authorize('show_route');
        $route->load('startLocation');
        $route->load('endLocation');
        return ResponseHelper::findSuccess("route", new RouteResource($route));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function update(RouteRequest $request, Route $route)
    {
        $this->authorize('update_route');
        return ResponseHelper::updateSuccess("route", new RouteResource($this->routeRepository->update($route->id, $request->validated())));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function destroy(Route $route)
    {
        $this->authorize('destroy_route');
        return ResponseHelper::deleteSuccess("route", $this->routeRepository->delete($route->id));
    }
}