<?php

namespace App\Providers;

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
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
