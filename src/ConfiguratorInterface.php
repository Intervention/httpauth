<?php

namespace Intervention\HttpAuth;

interface ConfiguratorInterface
{
    public function getVault(): AbstractVault;
    public function configure($config): ConfiguratorInterface;
}
