<?php

namespace App\Providers;

use App\src\Entities\UserLocator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(app_path('/src/databases/migrations'));
        $this->app->singleton(UserLocator::class);
    }
}
