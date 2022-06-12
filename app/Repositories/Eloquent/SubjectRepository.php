<?php

namespace App\Repositories\Eloquent;

use App\Models\Subject;
use App\Repositories\Contracts\SubjectRepositoryInterface;
use Illuminate\Support\Collection;

class SubjectRepository extends BaseRepository implements SubjectRepositoryInterface
{
    /**
     * SubjectRepository constructor.
     *
     * @param Subject $model
     */
    public function __construct(Subject $model)
    {
        parent::__construct($model);
    }

    /**
     * @return Collection
     */
    public function index()
    {
        return $this->paginate($this->model->with('branch'));
    }
}
