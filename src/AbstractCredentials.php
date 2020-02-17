<?php

namespace Intervention\Httpauth;

abstract class AbstractCredentials
{
    /**
     * Credential data
     *
     * @var array
     */
    private $data = [];

    /**
     * Determine if current credentials match given credentials
     *
     * @param  AbstractCredentials $credentials
     * @return bool
     */
    abstract public function matches(AbstractCredentials $credentials): bool;
    
    /**
     * Create new instance
     *
     * @param array $data
     */
    public function __construct($data = [])
    {
        $this->fill($data);
    }

    /**
     * Overwrite current credential object with given data
     *
     * @param  array  $data
     * @return AbstractCredentials
     */
    public function fill(array $data): AbstractCredentials
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Overwrite given data on current object
     *
     * @param string $key
     * @param string $value
     * @return AbstractCredentials
     */
    public function set($key, $value): AbstractCredentials
    {
        $this->data[$key] = $value;

        return $this;
    }

    /**
     * Return data from current object
     *
     * @param  string $key
     * @return string
     */
    public function get($key): ?string
    {
        return array_key_exists($key, $this->data) ? strval($this->data[$key]) : null;
    }
}
