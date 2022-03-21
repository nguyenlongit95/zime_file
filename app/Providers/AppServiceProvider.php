<?php

namespace App\Providers;

use App\Repositories\Files\FileEloquentRepository;
use App\Repositories\Files\FileRepositoryInterface;
use App\Repositories\Packages\PackageEloquentRepository;
use App\Repositories\Packages\PackageRepositoryInterface;
use App\Repositories\Users\UserEloquentRepository;
use App\Repositories\Users\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            UserRepositoryInterface::class,
            UserEloquentRepository::class
        );
        $this->app->bind(
            FileRepositoryInterface::class,
            FileEloquentRepository::class
        );
        $this->app->bind(
            PackageRepositoryInterface::class,
            PackageEloquentRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
