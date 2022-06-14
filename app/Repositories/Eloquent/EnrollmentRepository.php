<?php

namespace App\Repositories\Eloquent;

use App\Models\Enrollment;
use App\Repositories\Contracts\EnrollmentRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class EnrollmentRepository extends BaseRepository implements EnrollmentRepositoryInterface
{
    /**
     * EnrollmentRepository constructor.
     *
     * @param Enrollment $model
     */
    public function __construct(Enrollment $model)
    {
        parent::__construct($model);
    }

    /**
     * @return Collection
     */
    public function index()
    {
        return $this->model->where('employee_id', Auth::user()->employee->id)->with(
            'serviceRequest',
            'serviceRequest.customer',
            'employee',
            'subject'
        )->get();
    }
}
