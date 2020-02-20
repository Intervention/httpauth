<?php

namespace Intervention\HttpAuth\Token;

use Intervention\HttpAuth\Key;

class HttpAuthentification extends NullToken
{
    /**
     * Parsed authentification value
     *
     * @var string
     */
    protected $value;

    /**
     * Transform current instance to key object
     *
     * @return Key
     */
    public function toKey(): Key
    {
        list($username, $password) = explode(':', base64_decode(substr($this->value, 6)));

        $key = new Key;
        $key->setProperty('username', $username);
        $key->setProperty('password', $password);

        return $key;
    }

    /**
     * Parse environment variables and store value in object
     *
     * @return bool "true" if value was found or "false"
     */
    protected function parse(): bool
    {
        $value = $this->getArrayValue($_SERVER, 'HTTP_AUTHENTICATION');
        if (strtolower(substr($value, 0, 5)) === 'basic') {
            $this->value = $value;

            return true;
        }

        return false;
    }
}
