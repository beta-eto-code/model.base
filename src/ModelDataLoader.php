<?php

namespace Model\Base;

use Model\Base\Interfaces\ModelInterface;
use Model\Base\Interfaces\SerializeStrategyInterface;

class ModelDataLoader
{
    public static function loadData(
        ModelInterface $model,
        array $data,
        ?SerializeStrategyInterface $serializeStrategy = null
    ): void {
        $serializeStrategy = $serializeStrategy ?? SerializeStrategy::getDefault();
        foreach ($data as $key => $value) {
            if (!is_string($key)) {
                continue;
            }

            $newKey = $serializeStrategy->getNewKey($key);
            $newValue = $serializeStrategy->getNewKey($value);
            $model->offsetSet($newKey, $newValue);
        }
    }
}
