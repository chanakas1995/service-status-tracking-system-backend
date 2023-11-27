<?php

namespace App\Repositories\Eloquent;

use App\Models\BusModel;
use App\Repositories\Contracts\BusModelRepositoryInterface;
use Illuminate\Support\Collection;

class BusModelRepository extends BaseRepository implements BusModelRepositoryInterface
{
    /**
     * BusRepository constructor.
     *
     * @param BusModel $model
     */
    public function __construct(BusModel $model)
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