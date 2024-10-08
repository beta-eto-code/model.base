<?php

namespace Model\Base\Interfaces;

interface SerializeStrategyInterface
{
    public function getNewKey(string $key): string;
    public function getNewValue(mixed $value): mixed;
}
