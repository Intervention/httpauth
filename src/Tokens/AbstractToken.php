<?php

declare(strict_types=1);

namespace Intervention\HttpAuth\Tokens;

use Intervention\HttpAuth\Interfaces\TokenInterface;

abstract class AbstractToken implements TokenInterface
{
    /**
     * Token properties
     *
     * @var array<string, string>
     */
    protected array $properties = [];

    /**
     * Create new token
     *
     * @return void
     */
    public function __construct()
    {
        $this->properties = $this->parse();
    }

    /**
     * {@inheritdoc}
     *
     * @see TokenInterface::username()
     */
    public function username(): ?string
    {
        return $this->getArrayValue($this->properties, 'username');
    }

    /**
     * {@inheritdoc}
     *
     * @see TokenInterface::password()
     */
    public function password(): ?string
    {
        return $this->getArrayValue($this->properties, 'password');
    }

    /**
     * {@inheritdoc}
     *
     * @see TokenInterface::cnonce()
     */
    public function cnonce(): ?string
    {
        return $this->getArrayValue($this->properties, 'cnonce');
    }

    /**
     * {@inheritdoc}
     *
     * @see TokenInterface::nc()
     */
    public function nc(): ?string
    {
        return $this->getArrayValue($this->properties, 'nc');
    }

    /**
     * {@inheritdoc}
     *
     * @see TokenInterface::nonce()
     */
    public function nonce(): ?string
    {
        return $this->getArrayValue($this->properties, 'nonce');
    }

    /**
     * {@inheritdoc}
     *
     * @see TokenInterface::qop()
     */
    public function qop(): ?string
    {
        return $this->getArrayValue($this->properties, 'qop');
    }

    /**
     * {@inheritdoc}
     *
     * @see TokenInterface::response()
     */
    public function response(): ?string
    {
        return $this->getArrayValue($this->properties, 'response');
    }

    /**
     * {@inheritdoc}
     *
     * @see TokenInterface::uri()
     */
    public function uri(): ?string
    {
        return $this->getArrayValue($this->properties, 'uri');
    }

    /**
     * {@inheritdoc}
     *
     * @see TokenInterface::realm()
     */
    public function realm(): ?string
    {
        return $this->getArrayValue($this->properties, 'realm');
    }

    /**
     * {@inheritdoc}
     *
     * @see TokenInterface::opaque()
     */
    public function opaque(): ?string
    {
        return $this->getArrayValue($this->properties, 'opaque');
    }

    /**
     * Return the value of given key in given array data.
     * Returns null if key doesn't exists
     *
     * @param array<mixed> $data
     * @param mixed $key
     * @return mixed
     */
    protected function getArrayValue(array $data, mixed $key): mixed
    {
        if (array_key_exists($key, $data)) {
            return $data[$key];
        }

        return null;
    }
}
