<?php

namespace Intervention\HttpAuth;

interface ConfiguratorInterface
{
    /**
     * Return ready configured vault
     *
     * @return AbstractVault
     */
    public function getVault(): AbstractVault;

    /**
     * Configure instance with given config
     *
     * @param  mixed $config
     * @return ConfiguratorInterface
     */
    public function configure($config): ConfiguratorInterface;
}
