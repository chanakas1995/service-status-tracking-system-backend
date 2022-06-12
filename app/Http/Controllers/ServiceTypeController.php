<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\ServiceTypeRequest;
use App\Http\Resources\ServiceTypeResource;
use App\Models\ServiceType;
use App\Repositories\Contracts\ServiceTypeRepositoryInterface;
use App\Repositories\contracts\UserRepositoryInterface;
use Illuminate\Http\Request;

class ServiceTypeController extends Controller
{
    private $userRepository;
    private $serviceTypeRepository;

    public function __construct(ServiceTypeRepositoryInterface $serviceTypeRepository, UserRepositoryInterface $userRepository)
    {
        $this->serviceTypeRepository = $serviceTypeRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('index_service_types');
        return ResponseHelper::findSuccess("list", ServiceTypeResource::collection($this->serviceTypeRepository->index()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceTypeRequest $request)
    {
        $this->authorize('store_service_type');
        return ResponseHelper::createSuccess("serviceType", new ServiceTypeResource($this->serviceTypeRepository->store($request->validated())));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ServiceType  $serviceType
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceType $serviceType)
    {
        $this->authorize('show_service_type');
        $serviceType->load('initialSubject');
        return ResponseHelper::findSuccess("serviceType", new ServiceTypeResource($serviceType));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ServiceType  $serviceType
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceTypeRequest $request, ServiceType $serviceType)
    {
        $this->authorize('update_service_type');
        return ResponseHelper::updateSuccess("serviceType", new ServiceTypeResource($this->serviceTypeRepository->update($serviceType->id, $request->validated())));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServiceType  $serviceType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceType $serviceType)
    {
        $this->authorize('destroy_service_type');
        return ResponseHelper::deleteSuccess("serviceType", $this->serviceTypeRepository->delete($serviceType->id));
    }
}
