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

    /**
     * Return current username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Return current password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Return current qop
     *
     * @return string
     */
    public function getQop()
    {
        return $this->qop;
    }

    /**
     * Return current nonce
     *
     * @return string
     */
    public function getNonce()
    {
        return $this->nonce;
    }

    /**
     * Return current opaque
     *
     * @return string
     */
    public function getOpaque()
    {
        return $this->opaque;
    }

    /**
     * Return current uri
     *
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * Return current nc
     *
     * @return string
     */
    public function getNc()
    {
        return $this->nc;
    }

    /**
     * Return current cnonce
     *
     * @return string
     */
    public function getCnonce()
    {
        return $this->cnonce;
    }

    /**
     * Return current response
     *
     * @return string
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Set property to given value on current instance
     *
     * @param string $name
     * @param mixed  $value
     * @return Key
     */
    public function setProperty($name, $value): Key
    {
        if (property_exists($this, $name)) {
            $this->{$name} = $value;
        }

        return $this;
    }
}
