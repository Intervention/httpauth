<?php

namespace Intervention\HttpAuth\Token;

use Intervention\HttpAuth\Exception\AuthentificationException;

class HttpAuthorization extends AbstractToken
{
    protected function parseProperties(): array
    {
        $value = $this->getArrayValue($_SERVER, 'HTTP_AUTHORIZATION');

        if (strtolower(substr($value, 0, 6)) !== 'digest') {
            throw new AuthentificationException('Failed to parse token.');
        }

        preg_match_all('@(\w+)=(?:(?:")([^"]+)"|([^\s,$]+))@', $value, $matches, PREG_SET_ORDER);

        $properties = [];
        foreach ($matches as $m) {
            $key = $m[1];
            $value = $m[2] ? $m[2] : $m[3];
            $properties[$key] = $value;
        }

        return $properties;
    }
}
