<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\SubjectRequest;
use App\Http\Resources\SubjectResource;
use App\Models\Subject;
use App\Repositories\Contracts\SubjectRepositoryInterface;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    private $subjectRepository;

    public function __construct(SubjectRepositoryInterface $subjectRepository)
    {
        $this->subjectRepository = $subjectRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('index_subjects');
        return ResponseHelper::findSuccess("list", SubjectResource::collection($this->subjectRepository->index()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubjectRequest $request)
    {
        $this->authorize('store_subject');
        return ResponseHelper::createSuccess("subject", new SubjectResource($this->subjectRepository->store($request->validated())));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        $this->authorize('show_subject');
        $subject->load('branch');
        return ResponseHelper::findSuccess("subject", new SubjectResource($subject));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(SubjectRequest $request, Subject $subject)
    {
        $this->authorize('update_subject');
        return ResponseHelper::updateSuccess("subject", new SubjectResource($this->subjectRepository->update($subject->id, $request->validated())));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        $this->authorize('destroy_subject');
        return ResponseHelper::deleteSuccess("subject", $this->subjectRepository->delete($subject->id));
    }
}
