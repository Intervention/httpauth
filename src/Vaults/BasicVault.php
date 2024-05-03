<?php

declare(strict_types=1);

namespace Intervention\HttpAuth\Vaults;

use Intervention\HttpAuth\Directive;
use Intervention\HttpAuth\Exceptions\AuthentificationException;
use Intervention\HttpAuth\Interfaces\DirectiveInterface;
use Intervention\HttpAuth\Interfaces\TokenInterface;
use Intervention\HttpAuth\Type;

class BasicVault extends AbstractVault
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

        if ($token->password() !== $this->password()) {
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
        return Type::BASIC;
    }

    /**
     * Return auth directive
     *
     * @return Directive
     */
    public function directive(): DirectiveInterface
    {
        return new Directive([
            'realm' => $this->realm(),
            'charset' => 'UTF-8',
        ]);
    }
}
