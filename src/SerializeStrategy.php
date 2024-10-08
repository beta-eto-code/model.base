<?php

namespace Model\Base;

use Model\Base\Interfaces\SerializeStrategyInterface;
use Model\Base\Serialization\AsIsCase;
use Model\Base\Serialization\CamelCase;
use Model\Base\Serialization\SnakeCase;

class SerializeStrategy
{
    private static ?SerializeStrategyInterface $asIsCase = null;
    private static ?SerializeStrategyInterface $camelCase = null;
    private static ?SerializeStrategyInterface $snakeCase = null;

    public static function getDefault(): SerializeStrategyInterface
    {
        if (empty(static::$camelCase)) {
            static::$asIsCase = new AsIsCase();
        }
        return static::$asIsCase;
    }

    public static function getCamelCase(): SerializeStrategyInterface
    {
        if (empty(static::$camelCase)) {
            static::$camelCase = new CamelCase();
        }
        return static::$camelCase;
    }

    public static function getSnakeCase(): SerializeStrategyInterface
    {
        if (empty(static::$snakeCase)) {
            static::$snakeCase = new SnakeCase();
        }
        return static::$snakeCase;
    }
}
