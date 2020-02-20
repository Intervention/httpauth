<?php

namespace Intervention\HttpAuth;

class HttpAuth
{
    /**
     * Create HTTP auth instance and configure via given array or callback
     *
     * @param  mixed $config
     * @return AbstractVault
     */
    public static function make($config = null): AbstractVault
    {
        return self::getConfigurator($config)->getVault();
    }

    /**
     * Create HTTP basic auth instance
     *
     * @return AbstractVault
     */
    public static function basic(): AbstractVault
    {
        return self::make(['type' => 'basic']);
    }

    /**
     * Create HTTP digest auth instance
     *
     * @return AbstractVault
     */
    public static function digest(): AbstractVault
    {
        return self::make(['type' => 'digest']);
    }

    /**
     * Magic method to catch static calls
     *
     * @param  string $name
     * @param  array  $arguments
     * @return AbstractVault
     */
    public static function __callStatic($name, $arguments): AbstractVault
    {
        $argument = isset($arguments[0]) ? $arguments[0] : null;

        return self::make([$name => $argument]);
    }

    /**
     * Return configurator matching to given config type
     *
     * @param  mixed $config
     * @return ConfiguratorInterface
     */
    private static function getConfigurator($config): ConfiguratorInterface
    {
        switch (true) {
            case is_callable($config):
                return new Configurator\CallbackConfigurator($config);

            case is_array($config):
                return new Configurator\ArrayConfigurator($config);
            
            default:
                return new Configurator\ArrayConfigurator;
        }
    }
}
