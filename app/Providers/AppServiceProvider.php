<?php

namespace App\Providers;

use App\Models\Trip;
use Davidhsianturi\Compass\Contracts\RequestRepository;
use Davidhsianturi\Compass\Contracts\ResponseRepository;
use Davidhsianturi\Compass\Storage\DatabaseRequestRepository;
use Davidhsianturi\Compass\Storage\DatabaseResponseRepository;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
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

        $this->app->singleton(
            ResponseRepository::class, DatabaseResponseRepository::class
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
        Paginator::useBootstrap();

        if(env('FORCE_HTTPS')) {
           \URL::forceScheme('https');
        }
      
    }
}
