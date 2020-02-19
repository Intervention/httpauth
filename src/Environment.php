<?php

namespace Intervention\Httpauth;

use Exception;

class Environment
{
    protected $tokenClassnames = [
        Token\PhpAuthUser::class,
        Token\HttpAuthorization::class,
        Token\RedirectHttpAuthorization::class,
        Token\PhpAuthDigest::class,
        Token\HttpAuthorization::class,
    ];

    public function getToken(): TokenInterface
    {
        foreach ($this->tokenClassnames as $classname) {
            if ($auth = $this->getActiveToken($classname)) {
                return $auth;
            }
        }

        return new Token\NullToken;
    }

    private function getActiveToken($classname)
    {
        try {
            $auth = new $classname;
        } catch (Exception $e) {
            $auth = null;
        }

        return $auth;
    }
}
