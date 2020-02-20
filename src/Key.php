<?php

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

    public function getRealm()
    {
        return $this->realm;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getQop()
    {
        return $this->qop;
    }

    public function getNonce()
    {
        return $this->nonce;
    }

    public function getOpaque()
    {
        return $this->opaque;
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function getNc()
    {
        return $this->nc;
    }

    public function getCnonce()
    {
        return $this->cnonce;
    }

    public function getResponse()
    {
        return $this->response;
    }

    public function setProperty($name, $value)
    {
        if (property_exists($this, $name)) {
            $this->{$name} = $value;
        }

        return $this;
    }
}
