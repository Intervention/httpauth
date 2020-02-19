<?php

namespace Intervention\HttpAuth;

class Directive
{
    protected $type;
    protected $parameters = [];

    public function __construct($type, $parameters = [])
    {
        $this->type = $type;
        $this->parameters = $parameters;
    }

    public function format()
    {
        return sprintf(
            '%s %s',
            ucfirst(strtolower($this->type)),
            $this->getParametersString()
        );
    }

    public function getType()
    {
        return $this->type;
    }

    public function getParameter($key)
    {
        return array_key_exists($key, $this->parameters) ? $this->parameters[$key] : null;
    }

    private function getParametersString()
    {
        return implode(', ', array_map(function ($key, $value) {
            return sprintf('%s="%s"', $key, $value);
        }, array_keys($this->parameters), $this->parameters));
    }

    public function __toString()
    {
        return $this->format();
    }
}
