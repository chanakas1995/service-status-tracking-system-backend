<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\ServiceRequestRequest;
use App\Http\Resources\ServiceRequestResource;
use App\Models\ServiceRequest;
use App\Notifications\CreateServiceRequestNotification;
use App\Repositories\Contracts\CustomerRepositoryInterface;
use App\Repositories\Contracts\ServiceRequestRepositoryInterface;
use Illuminate\Http\Request;

class ServiceRequestController extends Controller
{
    private $serviceRequestRepository;
    private $customerRepository;

    public function __construct(ServiceRequestRepositoryInterface $serviceRequestRepository, CustomerRepositoryInterface $customerRepository)
    {
        $this->serviceRequestRepository = $serviceRequestRepository;
        $this->customerRepository = $customerRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('index_service_requests');
        return ResponseHelper::findSuccess("list", ServiceRequestResource::collection($this->serviceRequestRepository->index()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequestRequest $request)
    {
        $this->authorize('store_service_request');
        $data = $request->validated();
        $data["start_date"] = now()->toDateTimeString();
        $serviceRequest = $this->serviceRequestRepository->store($data);
        $number = ServiceRequest::withTrashed()->count() + 1;
        $serviceRequest->update(["number" => $number]);
        $customer = $this->customerRepository->find($request->get('customer_id'));
        $customer->user->notify(new CreateServiceRequestNotification($serviceRequest));
        return ResponseHelper::createSuccess("serviceRequest", new ServiceRequestResource($serviceRequest));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ServiceRequest  $serviceRequest
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceRequest $serviceRequest)
    {
        $this->authorize('show_service_request');
        // $serviceRequest->load('initialSubject');
        return ResponseHelper::findSuccess("serviceRequest", new ServiceRequestResource($serviceRequest));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ServiceRequest  $serviceRequest
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceRequestRequest $request, ServiceRequest $serviceRequest)
    {
        $this->authorize('update_service_request');
        return ResponseHelper::updateSuccess("serviceRequest", new ServiceRequestResource($this->serviceRequestRepository->update($serviceRequest->id, $request->validated())));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServiceRequest  $serviceRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceRequest $serviceRequest)
    {
        $this->authorize('destroy_service_request');
        return ResponseHelper::deleteSuccess("serviceRequest", $this->serviceRequestRepository->delete($serviceRequest->id));
    }
}
