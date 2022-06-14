<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\EnrollmentRequest;
use App\Http\Resources\EnrollmentResource;
use App\Models\Enrollment;
use App\Repositories\Contracts\EnrollmentRepositoryInterface;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    private $enrollmentRepository;

    public function __construct(EnrollmentRepositoryInterface $enrollmentRepository)
    {
        $this->enrollmentRepository = $enrollmentRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('index_enrollments');
        return ResponseHelper::findSuccess("list", EnrollmentResource::collection($this->enrollmentRepository->index()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EnrollmentRequest $request)
    {
        $this->authorize('store_enrollment');
        return ResponseHelper::createSuccess("enrollment", new EnrollmentResource($this->enrollmentRepository->store($request->validated())));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Enrollment  $enrollment
     * @return \Illuminate\Http\Response
     */
    public function show(Enrollment $enrollment)
    {
        $this->authorize('show_enrollment');
        $enrollment->load('enrollmentHead');
        return ResponseHelper::findSuccess("enrollment", new EnrollmentResource($enrollment));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Enrollment  $enrollment
     * @return \Illuminate\Http\Response
     */
    public function update(EnrollmentRequest $request, Enrollment $enrollment)
    {
        $this->authorize('update_enrollment');
        return ResponseHelper::updateSuccess("enrollment", new EnrollmentResource($this->enrollmentRepository->update($enrollment->id, $request->validated())));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Enrollment  $enrollment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Enrollment $enrollment)
    {
        $this->authorize('destroy_enrollment');
        return ResponseHelper::deleteSuccess("enrollment", $this->enrollmentRepository->delete($enrollment->id));
    }
}
