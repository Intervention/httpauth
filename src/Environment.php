<?php

declare(strict_types=1);

namespace Intervention\HttpAuth;

use Intervention\HttpAuth\Exception\AuthentificationException;
use Intervention\HttpAuth\Interfaces\EnvironmentInterface;
use Intervention\HttpAuth\Interfaces\TokenInterface;

class Environment implements EnvironmentInterface
{
    /**
     * Available auth tokens
     *
     * @var array<string>
     */
    protected static $tokenClassnames = [
        Token\PhpAuthUser::class,
        Token\HttpAuthentification::class,
        Token\RedirectHttpAuthorization::class,
        Token\PhpAuthDigest::class,
        Token\HttpAuthorization::class,
    ];

    /**
     * {@inheritdoc}
     *
     * @see EnvironmentInterface::token()
     */
    public static function token(): TokenInterface
    {
        foreach (static::$tokenClassnames as $classname) {
            try {
                return new $classname();
            } catch (AuthentificationException) {
                // try next
            }
        }

        throw new AuthentificationException();
    }
}
