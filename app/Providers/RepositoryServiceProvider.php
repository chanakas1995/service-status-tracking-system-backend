<?php

namespace App\Providers;

use App\Repositories\Contracts\RoleRepositoryInterface;
use App\Repositories\Eloquent\RoleRepository;
use App\Repositories\contracts\UserRepositoryInterface;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Contracts\BusRepositoryInterface;
use App\Repositories\Eloquent\BusRepository;
use App\Repositories\Contracts\BusModelRepositoryInterface;
use App\Repositories\Eloquent\BusModelRepository;
use App\Repositories\Contracts\RouteRepositoryInterface;
use App\Repositories\Eloquent\RouteRepository;
use App\Repositories\Contracts\LocationRepositoryInterface;
use App\Repositories\Eloquent\LocationRepository;
use App\Repositories\Contracts\TripRepositoryInterface;
use App\Repositories\Eloquent\TripRepository;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->bind(BusRepositoryInterface::class, BusRepository::class);
        $this->app->bind(BusModelRepositoryInterface::class, BusModelRepository::class);
        $this->app->bind(RouteRepositoryInterface::class, RouteRepository::class);
        $this->app->bind(LocationRepositoryInterface::class, LocationRepository::class);
        $this->app->bind(TripRepositoryInterface::class, TripRepository::class);
    }
    
}