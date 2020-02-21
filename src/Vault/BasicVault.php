<?php

namespace Intervention\HttpAuth\Vault;

use Intervention\HttpAuth\AbstractVault;
use Intervention\HttpAuth\Directive;
use Intervention\HttpAuth\Key;

class BasicVault extends AbstractVault
{
    /**
     * Transform and return current vault to basic vault
     *
     * @param string $type
     */
    public function basic(): BasicVault
    {
        return $this;
    }

    /**
     * Transform and return current vault to digest vault
     *
     * @param string $type
     */
    public function digest(): DigestVault
    {
        return $this->setType('digest');
    }

    /**
     * Determine if given key is able to unlock (access) vault.
     *
     * @param  Key    $key
     * @return bool
     */
    public function unlocksWithKey(Key $key): bool
    {
        $username_match = $this->getUsername() == $key->getUsername();
        $password_match = $this->getPassword() == $key->getPassword();

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
            'realm' => $this->getRealm(),
            'charset' => 'UTF-8',
        ]);
    }
}
