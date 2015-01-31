<?php

namespace Intervention\Httpauth;

use Illuminate\Support\ServiceProvider;

class HttpauthServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('intervention/httpauth');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app['httpauth'] = $this->app->share(function($app) {
            return new Httpauth($app['config']->get('httpauth::config'));
        });
    }
}
