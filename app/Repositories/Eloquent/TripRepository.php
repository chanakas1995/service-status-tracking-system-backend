<?php

namespace App\Repositories\Eloquent;

use App\Models\Trip;
use App\Repositories\Contracts\TripRepositoryInterface;
use Illuminate\Support\Collection;

class TripRepository extends BaseRepository implements TripRepositoryInterface
{
    /**
     * TripRepository constructor.
     *
     * @param Trip $model
     */
    public function __construct(Trip $model)
    {
        parent::__construct($model);
    }

    /**
     * @return Collection
     */
    public function index()
    {
        return $this->paginate($this->model->with('bus','route'));
    }
}