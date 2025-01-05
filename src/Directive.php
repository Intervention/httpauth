<?php

declare(strict_types=1);

namespace Intervention\HttpAuth;

use Intervention\HttpAuth\Interfaces\DirectiveInterface;

class Directive implements DirectiveInterface
{
    /**
     * Create new instance
     *
     * @param array<mixed> $parameters
     * @return void
     */
    public function __construct(protected array $parameters = [])
    {
    }

    /**
     * {@inheritdoc}
     *
     * @see DirectiveInterface::__toString()
     */
    public function __toString(): string
    {
        return implode(', ', array_map(
            fn(mixed $key, mixed $value): string => sprintf('%s="%s"', $key, $value),
            array_keys($this->parameters),
            $this->parameters,
        ));
    }
}
