<?php

namespace App\Repositories\Eloquent;

use App\Models\GsOffice;
use App\Repositories\Contracts\GsOfficeRepositoryInterface;
use Illuminate\Support\Collection;

class GsOfficeRepository extends BaseRepository implements GsOfficeRepositoryInterface
{
    /**
     * GsOfficeRepository constructor.
     *
     * @param GsOffice $model
     */
    public function __construct(GsOffice $model)
    {
        parent::__construct($model);
    }

    /**
     * @return Collection
     */
    public function index()
    {
        return $this->paginate($this->model->with('gsPermanent'));
    }
}
