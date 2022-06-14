<?php

namespace App\Providers;

use App\Repositories\Contracts\BranchRepositoryInterface;
use App\Repositories\Contracts\CustomerRepositoryInterface;
use App\Repositories\Contracts\EmployeeRepositoryInterface;
use App\Repositories\Contracts\EmployeeSubjectRepositoryInterface;
use App\Repositories\Contracts\EmployeeTypeRepositoryInterface;
use App\Repositories\Contracts\EnrollmentRepositoryInterface;
use App\Repositories\Contracts\GsOfficeRepositoryInterface;
use App\Repositories\Contracts\RoleRepositoryInterface;
use App\Repositories\Contracts\ServiceRequestRepositoryInterface;
use App\Repositories\Contracts\ServiceTypeRepositoryInterface;
use App\Repositories\Contracts\SubjectRepositoryInterface;
use App\Repositories\contracts\UserRepositoryInterface;
use App\Repositories\Eloquent\BranchRepository;
use App\Repositories\Eloquent\CustomerRepository;
use App\Repositories\Eloquent\EmployeeRepository;
use App\Repositories\Eloquent\EmployeeSubjectRepository;
use App\Repositories\Eloquent\EmployeeTypeRepository;
use App\Repositories\Eloquent\EnrollmentRepository;
use App\Repositories\Eloquent\GsOfficeRepository;
use App\Repositories\Eloquent\RoleRepository;
use App\Repositories\Eloquent\ServiceRequestRepository;
use App\Repositories\Eloquent\ServiceTypeRepository;
use App\Repositories\Eloquent\SubjectRepository;
use App\Repositories\Eloquent\UserRepository;
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
        $this->app->bind(EmployeeTypeRepositoryInterface::class, EmployeeTypeRepository::class);
        $this->app->bind(EmployeeRepositoryInterface::class, EmployeeRepository::class);
        $this->app->bind(BranchRepositoryInterface::class, BranchRepository::class);
        $this->app->bind(SubjectRepositoryInterface::class, SubjectRepository::class);
        $this->app->bind(GsOfficeRepositoryInterface::class, GsOfficeRepository::class);
        $this->app->bind(ServiceTypeRepositoryInterface::class, ServiceTypeRepository::class);
        $this->app->bind(CustomerRepositoryInterface::class, CustomerRepository::class);
        $this->app->bind(EmployeeSubjectRepositoryInterface::class, EmployeeSubjectRepository::class);
        $this->app->bind(ServiceRequestRepositoryInterface::class, ServiceRequestRepository::class);
        $this->app->bind(EnrollmentRepositoryInterface::class, EnrollmentRepository::class);
    }
}
