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
     * @param $uuid
     * @return Model
     */
    public function find($uuid);

    /**
     * @param array $uuid
     * @param array $attributes
     * @return Model
     */
    public function update($uuid, array $attributes);

    /**
     * @param $uuid
     */
    public function delete($uuid);
}
