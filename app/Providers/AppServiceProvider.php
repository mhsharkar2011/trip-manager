<?php

namespace App\Providers;

use Davidhsianturi\Compass\Contracts\RequestRepository;
use Davidhsianturi\Compass\Storage\DatabaseRequestRepository;
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
        /**
         * the package davidhsianturi/laravel-compass started throwing bindning error at some point
         * couldn't figure out what affected it
         * so temporarily copied the binding from its service provider class here which solves it apparently
         */
        $this->app->singleton(
            RequestRepository::class, DatabaseRequestRepository::class
        );

        $this->app->when(DatabaseRequestRepository::class)
        ->needs('$connection')
        ->give(config('compass.storage.database.connection'));
        /* END davidhsianturi/laravel-compass */

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(env('FORCE_HTTPS')) {
           \URL::forceScheme('https');
        }
    }
}
