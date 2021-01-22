<?php

namespace Intervention\HttpAuth;

use Exception;

class Environment
{
    /**
     * Available auth tokens
     *
     * @var array
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
     * @return TokenInterface
     */
    public function getToken(): TokenInterface
    {
        foreach ($this->tokenClassnames as $classname) {
            if ($auth = $this->getActiveTokenOrNull($classname)) {
                return $auth;
            }
        }

        return new Token\NullToken();
    }

    /**
     * Try to parse auth token from given classname. Returns token object
     * if token is active and could be parsed or null.
     *
     * @param  string $classname
     * @return TokenInterface|null
     */
    private function getActiveTokenOrNull($classname)
    {
        try {
            $auth = new $classname();
        } catch (Exception $e) {
            $auth = null;
        }

        return $auth;
    }
}
