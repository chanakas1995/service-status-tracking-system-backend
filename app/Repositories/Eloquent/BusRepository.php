<?php

namespace App\Repositories\Eloquent;

use App\Models\Bus;
use App\Repositories\Contracts\BusRepositoryInterface;
use Illuminate\Support\Collection;

class BusRepository extends BaseRepository implements BusRepositoryInterface
{
    /**
     * BusRepository constructor.
     *
     * @param Bus $model
     */
    public function __construct(Bus $model)
    {
        parent::__construct($model);
    }

    /**
     * @return Collection
     */
    public function index()
    {
        return $this->paginate($this->model->with('busModel'));
    }
}