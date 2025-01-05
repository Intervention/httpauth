<?php

declare(strict_types=1);

namespace Intervention\HttpAuth\Tokens;

use Intervention\HttpAuth\Exceptions\AuthentificationException;

class HttpAuthorization extends AbstractToken
{
    /**
     * Parse array of properties of current environment auth token
     *
     * @throws AuthentificationException
     * @return array<string, string>
     */
    public function parse(): array
    {
        $value = $this->getArrayValue($_SERVER, 'HTTP_AUTHORIZATION');

        if (is_null($value)) {
            throw new AuthentificationException('Failed to parse token.');
        }

        if (strtolower(substr((string) $value, 0, 6)) !== 'digest') {
            throw new AuthentificationException('Failed to parse token.');
        }

        preg_match_all('@(\w+)=(?:(?:")([^"]+)"|([^\s,$]+))@', (string) $value, $matches, PREG_SET_ORDER);

        $properties = [];
        foreach ($matches as $m) {
            $key = $m[1];
            $value = $m[2] ?: $m[3];
            $properties[$key] = $value;
        }

        return $properties;
    }
}
