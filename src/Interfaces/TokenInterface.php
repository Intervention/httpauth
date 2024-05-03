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
     *
     * @return null|string
     */
    public function username(): ?string;

    /**
     * Access password of token
     *
     * @return null|string
     */
    public function password(): ?string;

    /**
     * Access cnonce of token
     *
     * @return null|string
     */
    public function cnonce(): ?string;

    /**
     * Access nc of token
     *
     * @return null|string
     */
    public function nc(): ?string;

    /**
     * Access nonce of token
     *
     * @return null|string
     */
    public function nonce(): ?string;

    /**
     * Access qop of token
     *
     * @return null|string
     */
    public function qop(): ?string;

    /**
     * Access response of token
     *
     * @return null|string
     */
    public function response(): ?string;

    /**
     * Access uri of token
     *
     * @return null|string
     */
    public function uri(): ?string;

    /**
     * Access realm of token
     *
     * @return null|string
     */
    public function realm(): ?string;

    /**
     * Access opaque of token
     *
     * @return null|string
     */
    public function opaque(): ?string;
}
