<?php

namespace App\Repositories\Eloquent;

use App\Models\EmployeeSubject;
use App\Repositories\Contracts\EmployeeSubjectRepositoryInterface;
use Illuminate\Support\Collection;

class EmployeeSubjectRepository extends BaseRepository implements EmployeeSubjectRepositoryInterface
{
    /**
     * EmployeeSubjectRepository constructor.
     *
     * @param EmployeeSubject $model
     */
    public function __construct(EmployeeSubject $model)
    {
        parent::__construct($model);
    }
}
