<?php

namespace Model\Base\Serialization;

use Model\Base\Interfaces\SerializeStrategyInterface;

class CamelCase implements SerializeStrategyInterface
{
    public function getNewKey(string $key): string
    {
        $normalizedKey = '';
        $keyParts = explode('_', $key);
        foreach ($keyParts as $i => $part) {
            $normalizedKey .= $i > 0 ? ucfirst($part) : $part;
        }

        return lcfirst($normalizedKey);
    }

    public function getNewValue(mixed $value): mixed
    {
        return $value;
    }
}
