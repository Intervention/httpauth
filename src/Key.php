<?php

declare(strict_types=1);

namespace Intervention\HttpAuth;

class Key
{
    /**
     * Realm
     *
     * @var string
     */
    private $realm;

    /**
     * Username
     *
     * @var string
     */
    private $username;

    /**
     * Password
     *
     * @var string
     */
    private $password;

    /**
     * QOP
     *
     * @var string
     */
    private $qop;

    /**
     * Nonce
     *
     * @var string
     */
    private $nonce;

    /**
     * Opaque
     *
     * @var string
     */
    private $opaque;

    /**
     * NC
     *
     * @var string
     */
    private $nc;

    /**
     * uri
     *
     * @var string
     */
    private $uri;

    /**
     * cnonce
     *
     * @var string
     */
    private $cnonce;

    /**
     * Response
     *
     * @var string
     */
    private $response;

    /**
     * Return current name of realm
     *
     * @return string
     */
    public function getRealm(): ?string
    {
        return $this->realm;
    }

    /**
     * Return current username
     *
     * @return string
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * Return current password
     *
     * @return string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * Return current qop
     *
     * @return string
     */
    public function getQop(): ?string
    {
        return $this->qop;
    }

    /**
     * Return current nonce
     *
     * @return string
     */
    public function getNonce(): ?string
    {
        return $this->nonce;
    }

    /**
     * Return current opaque
     *
     * @return string
     */
    public function getOpaque(): ?string
    {
        return $this->opaque;
    }

    /**
     * Return current uri
     *
     * @return string
     */
    public function getUri(): ?string
    {
        return $this->uri;
    }

    /**
     * Return current nc
     *
     * @return string
     */
    public function getNc(): ?string
    {
        return $this->nc;
    }

    /**
     * Return current cnonce
     *
     * @return string
     */
    public function getCnonce(): ?string
    {
        return $this->cnonce;
    }

    /**
     * Return current response
     *
     * @return string
     */
    public function getResponse(): ?string
    {
        return $this->response;
    }

    /**
     * Set property to given value on current instance
     *
     * @param string $name
     * @param mixed $value
     * @return Key
     */
    public function setProperty($name, $value): self
    {
        if (property_exists($this, $name)) {
            $this->{$name} = $value;
        }

        return $this;
    }
}
