<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\BranchRequest;
use App\Http\Resources\BranchResource;
use App\Models\Branch;
use App\Repositories\Contracts\BranchRepositoryInterface;
use App\Repositories\contracts\UserRepositoryInterface;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    private $userRepository;
    private $branchRepository;

    public function __construct(BranchRepositoryInterface $branchRepository, UserRepositoryInterface $userRepository)
    {
        $this->branchRepository = $branchRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('index_branches');
        return ResponseHelper::findSuccess("list", BranchResource::collection($this->branchRepository->index()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BranchRequest $request)
    {
        return ResponseHelper::createSuccess("branch", new BranchResource($this->branchRepository->store($request->validated())));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function show(Branch $branch)
    {
        $this->authorize('show_branch');
        $branch->load('branchHead');
        return ResponseHelper::findSuccess("branch", new BranchResource($branch));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function update(BranchRequest $request, Branch $branch)
    {

        return ResponseHelper::updateSuccess("branch", new BranchResource($this->branchRepository->update($branch->id, $request->validated())));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Branch $branch)
    {
        $this->authorize('destroy_branch');
        return ResponseHelper::deleteSuccess("branch", $this->branchRepository->delete($branch->id));
    }
}
