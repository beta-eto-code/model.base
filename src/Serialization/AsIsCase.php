<?php

namespace Model\Base\Serialization;

use Model\Base\Interfaces\SerializeStrategyInterface;

class AsIsCase implements SerializeStrategyInterface
{
    public function getNewKey(string $key): string
    {
        return $key;
    }

    public function getNewValue(mixed $value): mixed
    {
        return $value;
    }
}
