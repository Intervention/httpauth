<?php

namespace Intervention\HttpAuth\Laravel;

use Illuminate\Support\ServiceProvider;
use Intervention\HttpAuth\HttpAuth;

class HttpAuthServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('httpauth.php')
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // merge default config
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php',
            'httpauth'
        );

        // register singleton
        $this->app->singleton('httpauth', function ($app) {
            return HttpAuth::make($app['config']->get('httpauth'));
        });

        // bind classname
        $this->app->bind('Intervention\HttpAuth\HttpAuth', function ($app) {
            return HttpAuth::make($app['config']->get('httpauth'));
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['httpauth'];
    }
}
