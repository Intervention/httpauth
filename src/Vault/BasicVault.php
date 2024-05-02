<?php

declare(strict_types=1);

namespace Intervention\HttpAuth\Vault;

use Intervention\HttpAuth\AbstractVault;
use Intervention\HttpAuth\Directive;
use Intervention\HttpAuth\Key;

class BasicVault extends AbstractVault
{
    /**
     * Determine if given key is able to unlock (access) vault.
     *
     * @param Key $key
     * @return bool
     */
    public function unlocksWithKey(Key $key): bool
    {
        $username_match = $this->username() == $key->username();
        $password_match = $this->password() == $key->password();

        return $username_match && $password_match;
    }

    /**
     * Return auth directive
     *
     * @return Directive
     */
    public function getDirective(): Directive
    {
        return new Directive('basic', [
            'realm' => $this->realm(),
            'charset' => 'UTF-8',
        ]);
    }
}
