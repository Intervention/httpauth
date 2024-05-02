<?php

namespace Intervention\HttpAuth;

use Intervention\HttpAuth\Exception\AuthentificationException;

class Environment
{
    /**
     * Available auth tokens
     *
     * @var array<string>
     */
    protected $tokenClassnames = [
        Token\PhpAuthUser::class,
        Token\HttpAuthentification::class,
        Token\RedirectHttpAuthorization::class,
        Token\PhpAuthDigest::class,
        Token\HttpAuthorization::class,
    ];

    /**
     * Get first active auth token from all available tokens
     *
     * @return Key
     */
    public function getKey(): Key
    {
        foreach ($this->tokenClassnames as $classname) {
            try {
                $key = (new $classname())->getKey();
                return $key;
            } catch (AuthentificationException) {
                // try next
            }
        }

        return new Key(); // empty key - no auth
    }
}
