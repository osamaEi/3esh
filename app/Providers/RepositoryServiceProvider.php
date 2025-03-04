<?php

namespace App\Providers;

use App\Repositories\UserRepository;
use App\Repositories\BranchRepository;
use App\Repositories\VendorRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\CategoryRepository;
use App\Repositories\EmployeeRepository;
use App\Repositories\SubscribtionRepository;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\BranchRepositoryInterface;
use App\Repositories\Contracts\VendorRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\EmployeeRepositoryInterface;
use App\Repositories\Contracts\SubscriptionRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            CategoryRepositoryInterface::class,
            CategoryRepository::class
        );
        $this->app->bind(
           VendorRepositoryInterface::class,
            VendorRepository::class
        );
        $this->app->bind(
            BranchRepositoryInterface::class,
            BranchRepository::class
         );
         $this->app->bind(
            EmployeeRepositoryInterface::class,
            EmployeeRepository::class
         );

         $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
         );
         
         $this->app->bind(
            SubscriptionRepositoryInterface::class,
            SubscribtionRepository::class
         );
         
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}