<?php

namespace Intervention\Httpauth\Token;

use Intervention\Httpauth\Key;
use Exception;

abstract class AbstractToken implements TokenInterface
{
    public function __construct()
    {
        if ($this->parse() === false) {
            throw new Exception('Failed to parse token');
        }
    }

    protected function parse()
    {
        return false;
    }

    protected function getArrayValue($data, $key)
    {
        if (array_key_exists($key, $data)) {
            return $data[$key];
        }

        return null;
    }
}
