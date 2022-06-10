<?php

namespace App\Repositories\Contracts;

use Illuminate\Support\Collection;

interface RoleRepositoryInterface extends BaseRepositoryInterface
{

    /**
     * Find roles by ids
     * 
     * @param array $ids
     * @return Collection
     */
    public function findByIds($ids);
}
