<?php

namespace App\Providers;

use App\Repositories\CrewRepository;
use App\Repositories\Interfaces\CrewRepositoryInterface;
use App\Repositories\Interfaces\MovieRepositoryInterface;
use App\Repositories\MovieRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(MovieRepositoryInterface::class , MovieRepository::class);
        $this->app->bind(CrewRepositoryInterface::class , CrewRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
