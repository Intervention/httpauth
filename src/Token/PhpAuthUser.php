<?php

namespace Intervention\Httpauth\Token;

use Intervention\Httpauth\Key;

class PhpAuthUser extends AbstractToken
{
    protected $username;
    protected $password;

    public function toKey(): Key
    {
        $key = new Key;
        $key->setProperty('username', $this->username);
        $key->setProperty('password', $this->password);

        return $key;
    }

    protected function parse(): bool
    {
        if ($username = $this->getArrayValue($_SERVER, 'PHP_AUTH_USER')) {
            $this->username = $username;
            $this->password = array_key_exists('PHP_AUTH_PW', $_SERVER) ? $_SERVER['PHP_AUTH_PW'] : null;

            return true;
        }
        
        return false;
    }
}
