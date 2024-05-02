<?php

declare(strict_types=1);

namespace Intervention\HttpAuth\Token;

use Intervention\HttpAuth\Key;

abstract class AbstractToken
{
    /**
     * Parse array of properties of current environment auth token
     *
     * @return array<string, string>
     */
    abstract protected function parseProperties(): array;

    /**
     * Return key for parsed properties
     *
     * @return Key
     */
    public function getKey(): Key
    {
        $authKey = new Key();
        foreach ($this->parseProperties() as $key => $value) {
            $authKey->setProperty($key, $value);
        }

        return $authKey;
    }

    /**
     * Return the value of given key in given array data.
     * Returns null if key doesn't exists
     *
     * @param array<mixed> $data
     * @param mixed $key
     * @return mixed
     */
    protected function getArrayValue(array $data, mixed $key): mixed
    {
        if (array_key_exists($key, $data)) {
            return $data[$key];
        }

        return null;
    }
}
