<?php

namespace App\Services\Clockify;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class ClockifyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        if (!$this->get_api_key() || !$this->get_workspace_id()) {
            throw new \Error('Clockify API key or Clockify workspace ID not found in config.');
        }        

        $this->app->singleton('Clockify\Http', function($app) {
            $api_base = 'https://api.clockify.me/api/v1/workspaces/' . $this->get_workspace_id();

            return Http::withHeaders([
                'X-Api-Key' => $this->get_api_key(),
            ])->baseUrl($api_base);
        });

        $this->app->singleton('Clockify\Report\Http', function($app) {
            $api_base = 'https://reports.api.clockify.me/v1/workspaces/' . $this->get_workspace_id() . '/reports';

            return Http::withHeaders([
                'X-Api-Key' => $this->get_api_key(),
            ])->baseUrl($api_base);
        });        
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

    public function get_api_key()
    {
        return config('clockify.api_key');
    }

    public function get_workspace_id()
    {
        return config('clockify.workspace_id');
    }    
}
