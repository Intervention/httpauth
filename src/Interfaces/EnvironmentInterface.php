<?php

declare(strict_types=1);

namespace Intervention\HttpAuth\Interfaces;

use Intervention\HttpAuth\Exceptions\AuthentificationException;

interface EnvironmentInterface
{
    /**
     * Try to parse and return auth token from server environment
     *
     * @throws AuthentificationException
     * @return TokenInterface
     */
    public static function token(): TokenInterface;
}
