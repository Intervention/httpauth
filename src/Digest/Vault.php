<?php

namespace Intervention\Httpauth\Digest;

use Intervention\Httpauth\AbstractVault;
use Intervention\Httpauth\Directive;
use Intervention\Httpauth\Key;

class Vault extends AbstractVault
{
    public function unlocksWithKey(Key $key): bool
    {
        $username_match = $key->getUsername() == $this->getUsername();
        $hash_match = $key->getResponse() == $this->getKeyHash($key);

        return $username_match && $hash_match;
    }

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

    private function getRequestMethod()
    {
        return isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';
    }

    public function decodeKeyValue($value): Key
    {
        $authKey = new Key;
        if (strtolower(substr($value, 0, 6)) === 'digest') {
            preg_match_all('@(\w+)=(?:(?:")([^"]+)"|([^\s,$]+))@', $value, $matches, PREG_SET_ORDER);
            foreach ($matches as $m) {
                $key = $m[1];
                $value = $m[2] ? $m[2] : $m[3];
                $authKey->setProperty($key, $value);
            }
        }

        return $authKey;
    }

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
