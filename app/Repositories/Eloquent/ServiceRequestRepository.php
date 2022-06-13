<?php

namespace App\Repositories\Eloquent;

use App\Models\ServiceRequest;
use App\Repositories\Contracts\ServiceRequestRepositoryInterface;
use Illuminate\Support\Collection;

class ServiceRequestRepository extends BaseRepository implements ServiceRequestRepositoryInterface
{
    /**
     * ServiceRequestRepository constructor.
     *
     * @param ServiceRequest $model
     */
    public function __construct(ServiceRequest $model)
    {
        parent::__construct($model);
    }

    /**
     * @return Collection
     */
    public function index()
    {
        return $this->paginate($this->model->with(
            'serviceType',
            'serviceType.initialSubject',
            'serviceType.initialSubject.branch',
            'customer',
        ));
    }
}
