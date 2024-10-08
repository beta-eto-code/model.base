<?php

namespace Model\Base\Interfaces;

use ArrayAccess;
use Collection\Base\Interfaces\CollectionItemInterface;
use Collection\Base\Interfaces\MappableInterface;
use IteratorAggregate;

/**
 * @template T of ModelInterface
 */
interface ModelInterface extends ArrayAccess, IteratorAggregate, CollectionItemInterface, MappableInterface
{
    /**
     * @param array $data
     * @return static
     */
    public static function initFromArray(array $data): ModelInterface;
}
