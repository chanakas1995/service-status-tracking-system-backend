<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Interface BaseRepositoryInterface
 * @package App\Repositories
 */
interface BaseRepositoryInterface
{
    /**
     * @return Collection
     */
    public function all();

    /**
     * @return Collection
     */
    public function index();

    /**
     * @param array $attributes
     * @return Model
     */
    public function store(array $attributes);

    /**
     * @param $id
     * @return Model
     */
    public function find($id);

    /**
     * @param array $id
     * @param array $attributes
     * @return Model
     */
    public function update($id, array $attributes);

    /**
     * @param $id
     */
    public function delete($id);
}
