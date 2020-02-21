<?php

namespace Intervention\HttpAuth\Vault;

use Intervention\HttpAuth\AbstractVault;
use Intervention\HttpAuth\Directive;
use Intervention\HttpAuth\Key;

class DigestVault extends AbstractVault
{
    /**
     * Determine if given key is able to unlock (access) vault.
     *
     * @param  Key    $key
     * @return bool
     */
    public function unlocksWithKey(Key $key): bool
    {
        $username_match = $key->getUsername() == $this->getUsername();
        $hash_match = $key->getResponse() == $this->getKeyHash($key);

        return $username_match && $hash_match;
    }

    /**
     * Build and return hash from given key/vault
     *
     * @param  Key    $key
     * @return string
     */
    private function getKeyHash(Key $key): string
    {
        return md5(implode(':', [
            md5(sprintf('%s:%s:%s', $key->getUsername(), $this->getRealm(), $this->getPassword())),
            $key->getNonce(),
            $key->getNc(),
            $key->getCnonce(),
            $key->getQop(),
            md5(sprintf('%s:%s', $this->getRequestMethod(), $key->getUri())),
        ]));
    }

    /**
     * Return HTTP request method
     *
     * @return string
     */
    private function getRequestMethod()
    {
        return isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';
    }

    /**
     * Return auth directive
     *
     * @return Directive
     */
    public function getDirective(): Directive
    {
        return new Directive('digest', [
            'realm' => $this->getRealm(),
            'qop' => 'auth',
            'nonce' => uniqid(),
            'opaque' => md5($this->getRealm()),
        ]);
    }
}
