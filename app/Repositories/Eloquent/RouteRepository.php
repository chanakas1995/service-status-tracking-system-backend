<?php

namespace App\Repositories\Eloquent;

use App\Models\Route;
use App\Repositories\Contracts\RouteRepositoryInterface;
use Illuminate\Support\Collection;

class RouteRepository extends BaseRepository implements RouteRepositoryInterface
{
    /**
     * RouteRepository constructor.
     *
     * @param Route $model
     */
    public function __construct(Route $model)
    {
        parent::__construct($model);
    }

    /**
     * @return Collection
     */
    public function index()
    {
        return $this->paginate($this->model->with('startLocation','endLocation'));
    }
}