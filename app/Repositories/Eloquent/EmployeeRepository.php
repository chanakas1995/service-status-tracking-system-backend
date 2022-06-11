<?php

namespace App\Repositories\Eloquent;

use App\Models\Employee;
use App\Repositories\Contracts\EmployeeRepositoryInterface;
use Illuminate\Support\Collection;

class EmployeeRepository extends BaseRepository implements EmployeeRepositoryInterface
{
    /**
     * EmployeeRepository constructor.
     *
     * @param Employee $model
     */
    public function __construct(Employee $model)
    {
        parent::__construct($model);
    }

    /**
     * @return Collection
     */
    public function index()
    {
        $query = $this->model;
        if (request()->get('employee_type')) {
            $query = $query->whereHas('employeeType', function ($q) {
                return $q->where('type', ucwords(str_replace("_", " ", request()->get('employee_type'))));
            });
        } else {
            $query = $query->with('user')->with('employeeType');
        }
        return $this->paginate($query);
    }
}
