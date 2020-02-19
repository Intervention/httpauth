<?php

namespace Intervention\Httpauth;

class Key
{
    private $realm;
    private $username;
    private $password;
    private $qop;
    private $nonce;
    private $opaque;
    private $nc;
    private $uri;
    private $cnonce;
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
