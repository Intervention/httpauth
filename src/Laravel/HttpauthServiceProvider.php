<?php

namespace Intervention\Httpauth;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Arr;

class HttpauthServiceProvider extends ServiceProvider
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
            // create vault
            $config = $app['config']->get('httpauth');
            $vault = new Httpauth::createVaultByClassname(
                $this->getVaultClassnameByConfigType(data_get($config, 'type'))
            );

            // configure vault
            foreach (Arr::only($config, ['name', 'username', 'password']) as $parameter => $value) {
                call_user_func_array([$value, 'set'.ucfirst($parameter)], [$value])
            }

            return $vault;
        });
    }

    private function getVaultClassnameByConfigType($type)
    {
        return sprintf("Intervention\\Httpauth\\%s\\Vault", ucfirst($type));
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('httpauth');
    }
}
