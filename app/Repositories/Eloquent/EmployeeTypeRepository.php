<?php

namespace App\Repositories\Eloquent;

use App\Models\EmployeeType;
use App\Repositories\Contracts\EmployeeTypeRepositoryInterface;
use Illuminate\Support\Collection;

class EmployeeTypeRepository extends BaseRepository implements EmployeeTypeRepositoryInterface
{
    /**
     * EmployeeTypeRepository constructor.
     *
     * @param EmployeeType $model
     */
    public function __construct(EmployeeType $model)
    {
        parent::__construct($model);
    }

    /**
     * @return Collection
     */
    public function index()
    {
        return $this->model->all();
    }
}
