<?php

namespace Intervention\Httpauth\Token;

use Intervention\Httpauth\Key;

class HttpAuthentification extends NullToken
{
    protected $value;

    public function toKey(): Key
    {
        list($username, $password) = explode(':', base64_decode(substr($this->value, 6)));

        $key = new Key;
        $key->setProperty('username', $username);
        $key->setProperty('password', $password);

        return $key;
    }

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
