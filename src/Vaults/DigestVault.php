<?php

declare(strict_types=1);

namespace Intervention\HttpAuth\Vaults;

use Intervention\HttpAuth\Directive;
use Intervention\HttpAuth\Exceptions\AuthentificationException;
use Intervention\HttpAuth\Interfaces\DirectiveInterface;
use Intervention\HttpAuth\Interfaces\TokenInterface;
use Intervention\HttpAuth\Type;

class DigestVault extends AbstractVault
{
    /**
     * {@inheritdoc}
     *
     * @see VaultInterface::verify()
     */
    public function verify(TokenInterface $token): void
    {
        if ($token->username() !== $this->username()) {
            throw new AuthentificationException();
        }

        if ($token->response() !== $this->tokenHash($token)) {
            throw new AuthentificationException();
        }
    }

    /**
     * {@inheritdoc}
     *
     * @see VaultInterface::type()
     */
    public function type(): Type
    {
        return Type::DIGEST;
    }

    /**
     * {@inheritdoc}
     *
     * @see VaultInterface::directive()
     */
    public function directive(): DirectiveInterface
    {
        return new Directive([
            'realm' => $this->realm(),
            'qop' => 'auth',
            'nonce' => uniqid(),
            'opaque' => md5($this->realm()),
        ]);
    }

    /**
     * Build and return hash from given token
     *
     * @param TokenInterface $token
     * @return string
     */
    private function tokenHash(TokenInterface $token): string
    {
        $method = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';

        return md5(implode(':', [
            md5(sprintf('%s:%s:%s', $token->username(), $this->realm(), $this->password())),
            $token->nonce(),
            $token->nc(),
            $token->cnonce(),
            $token->qop(),
            md5(sprintf('%s:%s', $method, $token->uri())),
        ]));
    }
}
