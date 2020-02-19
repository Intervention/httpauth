<?php

namespace Intervention\HttpAuth\Token;

use Intervention\HttpAuth\Exception\AuthentificationException;
use Intervention\HttpAuth\Key;
use Intervention\HttpAuth\TokenInterface;

class NullToken implements TokenInterface
{
    public function __construct()
    {
        if ($this->parse() === false) {
            throw new AuthentificationException('Failed to parse token');
        }
    }

    public function toKey(): Key
    {
        return new Key;
    }

    protected function parse(): bool
    {
        return true;
    }

    protected function getArrayValue($data, $key)
    {
        if (array_key_exists($key, $data)) {
            return $data[$key];
        }

        return null;
    }
}
