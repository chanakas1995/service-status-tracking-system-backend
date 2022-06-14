<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\ServiceRequestRequest;
use App\Http\Resources\ServiceRequestResource;
use App\Models\ServiceRequest;
use App\Notifications\CreateServiceRequestNotification;
use App\Repositories\Contracts\CustomerRepositoryInterface;
use App\Repositories\Contracts\EnrollmentRepositoryInterface;
use App\Repositories\Contracts\ServiceRequestRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class ServiceRequestController extends Controller
{
    private $serviceRequestRepository;
    private $customerRepository;
    private $enrollmentRepository;

    public function __construct(
        ServiceRequestRepositoryInterface $serviceRequestRepository,
        EnrollmentRepositoryInterface $enrollmentRepository,
        CustomerRepositoryInterface $customerRepository
    ) {
        $this->serviceRequestRepository = $serviceRequestRepository;
        $this->enrollmentRepository = $enrollmentRepository;
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
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $serviceRequest = $this->serviceRequestRepository->store($data);
            $subject = $serviceRequest->serviceType->initialSubject;
            $employeeSubjects = $subject->employeeSubjects;
            $enrollmentData = [
                "service_request_id" => $serviceRequest->id,
                "subject_id" => $subject->id,
                "employee_id" => $employeeSubjects->count() === 1 ? $employeeSubjects->first()->employee_id : null,
                "start_date" => $employeeSubjects->count() === 1 ? now()->toDateTimeString() : null,
                "transferred_date" => now()->toDateTimeString(),
            ];
            if ($employeeSubjects->count() === 1) {
                $serviceRequest = $this->serviceRequestRepository->update($serviceRequest->id, ["start_date" => now()->toDateTimeString()]);
            }
            $this->enrollmentRepository->store($enrollmentData);
            $number = ServiceRequest::withTrashed()->count() + 1;
            $serviceRequest->update(["number" => $number]);
            $customer = $this->customerRepository->find($request->get('customer_id'));
            if (!App::runningUnitTests()) {
                $customer->user->notify(new CreateServiceRequestNotification($serviceRequest));
            }
            return ResponseHelper::createSuccess("serviceRequest", new ServiceRequestResource($serviceRequest));
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
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
