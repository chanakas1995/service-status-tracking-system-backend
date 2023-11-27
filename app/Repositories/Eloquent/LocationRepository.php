<?php

namespace App\Repositories\Eloquent;

use App\Models\Location;
use App\Repositories\Contracts\LocationRepositoryInterface;
use Illuminate\Support\Collection;

class LocationRepository extends BaseRepository implements LocationRepositoryInterface
{
    /**
     * LocationRepository constructor.
     *
     * @param Location $model
     */
    public function __construct(Location $model)
    {
        parent::__construct($model);
    }

    /**
     * @return Collection
     */
    public function index()
    {
        return $this->paginate($this->model);
    }
}