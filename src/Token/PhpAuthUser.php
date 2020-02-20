<?php

namespace Intervention\HttpAuth\Token;

use Intervention\HttpAuth\Key;

class PhpAuthUser extends NullToken
{
    /**
     * Parsed authentification username
     *
     * @var string
     */
    protected $username;

    /**
     * Parsed authentification password
     *
     * @var string
     */
    protected $password;

    /**
     * Transform current instance to key object
     *
     * @return Key
     */
    public function toKey(): Key
    {
        $key = new Key;
        $key->setProperty('username', $this->username);
        $key->setProperty('password', $this->password);

        return $key;
    }

    /**
     * Parse environment variables and store value in object
     *
     * @return bool "true" if value was found or "false"
     */
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
