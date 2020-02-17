<?php

namespace Intervention\Httpauth\Digest;

use Intervention\Httpauth\AbstractCredentials;

class Credentials extends AbstractCredentials
{
    /**
     * Determine if current credentials match given credentials
     *
     * @param  AbstractCredentials $credentials
     * @return bool
     */
    public function matches(AbstractCredentials $credentials): bool
    {
        return $this->getHash() == $credentials->getHash();
    }

    /**
     * Build hash from current obj
     *
     * @return string
     */
    protected function getHash()
    {
        $u1 = md5(implode(':', [
            $this->get('username'),
            $this->get('realm'),
            $this->get('password'),
        ]));

        $u2 = md5(implode(':', [
            $this->getRequestMethod(),
            $this->get('uri'),
        ]));

        return md5(implode(':', [
            $u1,
            $this->get('nonce'),
            $this->get('nc'),
            $this->get('cnonce'),
            $this->get('qop'),
            $u2,
        ]));
    }

    /**
     * Return request method
     *
     * @return string
     */
    private function getRequestMethod()
    {
        return isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';
    }
}
