<?php

namespace App\Repositories\Eloquent;

use App\Models\Branch;
use App\Repositories\Contracts\BranchRepositoryInterface;
use Illuminate\Support\Collection;

class BranchRepository extends BaseRepository implements BranchRepositoryInterface
{
    /**
     * BranchRepository constructor.
     *
     * @param Branch $model
     */
    public function __construct(Branch $model)
    {
        parent::__construct($model);
    }

    /**
     * @return Collection
     */
    public function index()
    {
        return $this->paginate($this->model->with('branchHead'));
    }
}
