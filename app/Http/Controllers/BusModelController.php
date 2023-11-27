<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Resources\BusModelResource;
use App\Repositories\Contracts\BusModelRepositoryInterface;
use Illuminate\Http\Request;

class BusModelController extends Controller
{
    
    private $busModelRepository;

    public function __construct(BusModelRepositoryInterface $busModelRepository)
    {
        $this->busModelRepository = $busModelRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('index_bus_models');
        return ResponseHelper::findSuccess("list", BusModelResource::collection($this->busModelRepository->index()));
    }

    
}