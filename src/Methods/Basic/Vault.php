<?php

namespace Intervention\Httpauth\Methods\Basic;

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

    public function getDirective(): Directive
    {
        return new Directive('basic', [
            'realm' => $this->getRealm(),
            'charset' => 'UTF-8',
        ]);
    }
}