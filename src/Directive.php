<?php

namespace Intervention\HttpAuth;

class Directive
{
    /**
     * Create new instance
     *
     * @param string $type
     * @param array $parameters
     * @return void
     */
    public function __construct(
        protected string $type,
        protected array $parameters = []
    ) {
        $this->type = $type;
        $this->parameters = $parameters;
    }

    /**
     * Format current instance
     *
     * @return string
     */
    public function format(): string
    {
        return sprintf(
            '%s %s',
            ucfirst(strtolower($this->type)),
            $this->getParametersString()
        );
    }

    /**
     * Return current type
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Return value of given key from all parameters, if existing
     *
     * @param  mixed $key
     * @return mixed
     */
    public function getParameter($key)
    {
        return array_key_exists($key, $this->parameters) ? $this->parameters[$key] : null;
    }

    /**
     * Format current parameters as string
     *
     * @return string
     */
    private function getParametersString(): string
    {
        return implode(', ', array_map(function ($key, $value) {
            return sprintf('%s="%s"', $key, $value);
        }, array_keys($this->parameters), $this->parameters));
    }

    /**
     * Cast object to string
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->format();
    }
}
