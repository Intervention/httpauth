<?php

namespace Intervention\Httpauth\Basic;

use Intervention\Httpauth\AbstractVault;
use Intervention\Httpauth\Directive;
use Intervention\Httpauth\Key;

class Vault extends AbstractVault
{
    public function unlocksWithKey(Key $key): bool
    {
        $username_match = $this->getUsername() == $key->getUsername();
        $password_match = $this->getPassword() == $key->getPassword();

        return $username_match && $password_match;
    }

    public function decodeKeyValue($value): Key
    {
        $username = null;
        $password = null;

        if (strtolower(substr($value, 0, 5)) === 'basic') {
            list($username, $password) = explode(':', base64_decode(substr($value, 6)));
        }

        $key = new Key;
        $key->setProperty('username', $username);
        $key->setProperty('password', $password);

        return $key;
    }

    public function getDirective(): Directive
    {
        return new Directive('basic', [
            'realm' => $this->getRealm(),
            'charset' => 'UTF-8',
        ]);
    }
}
