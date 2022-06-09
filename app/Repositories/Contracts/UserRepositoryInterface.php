<?php

namespace App\Repositories\contracts;

use App\Models\User;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Find user by username
     * 
     * @param $username
     * @return User
     */
    public function findByUsername($username);
}