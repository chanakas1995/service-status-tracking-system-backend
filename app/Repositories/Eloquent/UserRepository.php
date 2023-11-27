<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * UserRepository constructor.
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * Find user by username
     * 
     * @param $username
     * @return User
     */
    public function findByUsername($username)
    { 
        return User::where('username', $username)->firstOrFail();
    }

    /**
     * @return Collection
     */
    public function index()
    {
        $indexQuery = $this->model->with('roles')->whereHas(('roles'), function ($query) {
            return $query->whereNotIn('name', ["Super Admin"]);
        });
        return $this->paginate($indexQuery);
    }
}