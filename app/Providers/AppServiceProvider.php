<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class AppServiceProvider
 *
 * Provides application service registration and bootstrapping.
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * This method is used to bind services into the service container.
     * It is called during the service provider registration phase.
     */
    public function register(): void
    {
        // Register any application services here
    }

    /**
     * Bootstrap any application services.
     *
     * This method is used to perform any actions required during the bootstrapping phase.
     * It is called after all other service providers have been registered.
     */
    public function boot(): void
    {
        // Bootstrap any application services here
    }
}
