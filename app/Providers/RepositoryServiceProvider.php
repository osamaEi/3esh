<?php

namespace App\Providers;

use App\Repositories\BranchRepository;
use App\Repositories\VendorRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\CategoryRepository;
use App\Repositories\Contracts\BranchRepositoryInterface;
use App\Repositories\Contracts\VendorRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;

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
        // You can register other repositories here
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