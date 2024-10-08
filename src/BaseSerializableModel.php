<?php

namespace Model\Base;

use Model\Base\Interfaces\ModelInterface;
use Model\Base\Interfaces\SerializeStrategyInterface;

/**
 * @implements ModelInterface
 */
abstract class BaseSerializableModel extends BaseModel
{
    private SerializeStrategyInterface $serializeStrategy;

    public function __construct(?SerializeStrategyInterface $serializeStrategy = null)
    {
        $this->serializeStrategy = $serializeStrategy ?? SerializeStrategy::getDefault();
    }

    public function setSerializeStrategy(SerializeStrategyInterface $serializeStrategy): void
    {
        $this->serializeStrategy = $serializeStrategy;
    }

    public function jsonSerialize(): array
    {
        $result = [];
        foreach ($this as $key => $value) {
            if (!is_string($key)) {
                continue;
            }

            $newKey = $this->serializeStrategy->getNewKey($key);
            $newValue = $this->serializeStrategy->getNewValue($value);
            $result[$newKey] = $newValue;
        }
        return $result;
    }
}
