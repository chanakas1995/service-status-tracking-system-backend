<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class BaseRepository implements BaseRepositoryInterface
{
    /**      
     * @var Model      
     */
    protected $model;

    /**      
     * BaseRepository constructor.      
     *      
     * @param Model $model      
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $attributes
     */
    public function store(array $attributes)
    {
        return $this->model->create($attributes);
    }

    /**
     * @param $id
     */
    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @return Collection
     */
    public function all()
    {
        return $this->model->orderBy('created_at', 'desc')->all();
    }

    /**
     * @return Collection
     */
    public function index()
    {
        $indexQuery = $this->model;
        return $this->paginate($indexQuery);
    }

    /**
     * @param array $id
     * @param array $attributes
     */
    public function update($id, array $attributes)
    {
        $data = $this->model->findOrFail($id);
        $data->update($attributes);
        return $data;
    }

    /**
     * @param $id
     */
    public function delete($id)
    {
        $data = $this->model->findOrFail($id);
        return $data->delete($id);
    }

    protected function paginate($searchQuery)
    {
        $perPage = request()->get('perPage');
        $search = request()->get('search');
        if ($search && $search != 'null') {
            $searchQuery = $searchQuery->where(function ($query) use ($search) {
                foreach ($this->model->filters as $filter) {
                    $query = $query->orWhere($filter, 'like', $search . '%');
                }
                return $query;
            });
        }
        if ($this->model->orderBy) {
            foreach ($this->model->orderBy as $column => $type) {
                $searchQuery = $searchQuery->orderBy($column, $type);
            }
        }
        if ($perPage) {
            return $searchQuery->paginate($perPage);
        } else {
            return $searchQuery->get();
        }
    }
}