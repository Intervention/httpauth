<?php

namespace Intervention\HttpAuth\Token;

use Intervention\HttpAuth\Exception\AuthentificationException;
use Intervention\HttpAuth\Key;
use Intervention\HttpAuth\TokenInterface;

class NullToken implements TokenInterface
{
    /**
     * Create new instance
     */
    public function __construct()
    {
        if ($this->parse() === false) {
            throw new AuthentificationException('Failed to parse token');
        }
    }

    /**
     * Transform current instance to key object
     *
     * @return Key
     */
    public function toKey(): Key
    {
        return new Key();
    }

    /**
     * Parse environment variables and store value in object
     *
     * @return bool "true" if value was found or "false"
     */
    protected function parse(): bool
    {
        return true;
    }

    /**
     * Return the value of given key in given array data.
     * Returns null if key doesn't exists
     *
     * @param  array  $data
     * @param  mixed  $key
     * @return mixed
     */
    protected function getArrayValue($data, $key)
    {
        if (array_key_exists($key, $data)) {
            return $data[$key];
        }

        return null;
    }
}
