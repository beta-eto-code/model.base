<?php

namespace Model\Base\Serialization;

use Model\Base\Interfaces\SerializeStrategyInterface;

class SnakeCase implements SerializeStrategyInterface
{
    public function getNewKey(string $key): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $key));
    }

    public function getNewValue(mixed $value): mixed
    {
        return $value;
    }
}
