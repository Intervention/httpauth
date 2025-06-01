<?php

declare(strict_types=1);

namespace Intervention\HttpAuth\Interfaces;

interface TokenInterface
{
    /**
     * Parse array of properties of current environment auth token
     *
     * @return array<string, string>
     */
    public function parse(): array;

    /**
     * Access username of token
     */
    public function username(): ?string;

    /**
     * Access password of token
     */
    public function password(): ?string;

    /**
     * Access cnonce of token
     */
    public function cnonce(): ?string;

    /**
     * Access nc of token
     */
    public function nc(): ?string;

    /**
     * Access nonce of token
     */
    public function nonce(): ?string;

    /**
     * Access qop of token
     */
    public function qop(): ?string;

    /**
     * Access response of token
     */
    public function response(): ?string;

    /**
     * Access uri of token
     */
    public function uri(): ?string;

    /**
     * Access realm of token
     */
    public function realm(): ?string;

    /**
     * Access opaque of token
     */
    public function opaque(): ?string;
}
