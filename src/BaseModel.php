<?php

namespace Model\Base;

use ArrayIterator;
use Iterator;
use Model\Base\Interfaces\ModelInterface;

/**
 * @implements ModelInterface
 */
abstract class BaseModel implements ModelInterface
{
    public function assertValueByKey(string $key, mixed $value): bool
    {
        return $this->getValueByKey($key) == $value;
    }

    public function offsetExists(mixed $offset): bool
    {
        return $this->hasValueKey($offset);
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        if ($this->hasValueKey($offset)) {
            $this->{$offset} = $value;
        }
    }

    public function offsetUnset($offset): void
    {
        if ($this->hasValueKey($offset)) {
            unset($this->{$offset});
        }
    }

    public function hasValueKey(string $key): bool
    {
        return property_exists($this, $key);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->getValueByKey($offset);
    }

    public function getValueByKey(string $key): mixed
    {
        return $this->{$key} ?? null;
    }

    public function getIterator(): Iterator
    {
        return new ArrayIterator($this);
    }

    /**
     * @param callable $fnMap - function($item): array
     * @return mixed
     */
    public function map(callable $fnMap): mixed
    {
        return $fnMap($this);
    }
}
