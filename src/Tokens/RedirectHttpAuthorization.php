<?php

declare(strict_types=1);

namespace Intervention\HttpAuth\Tokens;

use Intervention\HttpAuth\Exceptions\AuthentificationException;

class RedirectHttpAuthorization extends AbstractToken
{
    /**
     * Parse array of properties of current environment auth token
     *
     * @throws AuthentificationException
     * @return array{username: string, password: string}
     */
    public function parse(): array
    {
        $value = $this->getArrayValue($_SERVER, 'REDIRECT_HTTP_AUTHORIZATION');

        if (is_null($value)) {
            throw new AuthentificationException('Failed to parse token.');
        }

        if (strtolower(substr((string) $value, 0, 5)) !== 'basic') {
            throw new AuthentificationException('Failed to parse token.');
        }

        [$username, $password] = explode(':', base64_decode(substr((string) $value, 6)));

        return [
            'username' => $username,
            'password' => $password,
        ];
    }
}
