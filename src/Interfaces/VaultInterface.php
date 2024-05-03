<?php

declare(strict_types=1);

namespace Intervention\HttpAuth\Interfaces;

use Intervention\HttpAuth\Exceptions\AuthentificationException;
use Intervention\HttpAuth\Type;

interface VaultInterface
{
    /**
     * Deny access for non-authenticated users
     *
     * @param null|string $message
     * @return void
     */
    public function secure(?string $message = null): void;

    /**
     * Verify given token hash against the vault's hash and throw exception if
     * verification fails
     *
     * @throws AuthentificationException
     * @return void
     */
    public function verify(TokenInterface $token): void;

    /**
     * Type identifier of vault
     *
     * @return Type
     */
    public function type(): Type;

    /**
     * Build directive for current vault based on credentials and type
     *
     * @return DirectiveInterface
     */
    public function directive(): DirectiveInterface;
}
