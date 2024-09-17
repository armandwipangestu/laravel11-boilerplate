<?php

namespace App\Providers;

use App\Repositories\Test\Interfaces\TestRepositoryInterface;
use App\Repositories\Test\TestRepository;

use App\Repositories\User\Interfaces\UserRepositoryInterface;
use App\Repositories\User\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(TestRepositoryInterface::class, TestRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
