<?php

namespace App\Repositories\Eloquent;

use App\Models\ServiceType;
use App\Repositories\Contracts\ServiceTypeRepositoryInterface;
use Illuminate\Support\Collection;

class ServiceTypeRepository extends BaseRepository implements ServiceTypeRepositoryInterface
{
    /**
     * ServiceTypeRepository constructor.
     *
     * @param ServiceType $model
     */
    public function __construct(ServiceType $model)
    {
        parent::__construct($model);
    }
}
