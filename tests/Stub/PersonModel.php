<?php

namespace Model\Base\Tests\Stub;

use Model\Base\BaseSerializableModel;
use Model\Base\Interfaces\ModelInterface;
use Model\Base\ModelDataLoader;


class PersonModel extends BaseSerializableModel
{
    public string $name;
    public string $lastName;
    public int $age;
    public string $phone;
    public string $one_more_phone;

    /**
     * @param array $data
     * @return static
     */
    public static function initFromArray(array $data): ModelInterface
    {
        $person = new PersonModel();
        ModelDataLoader::loadData($person, $data);
        return $person;
    }
}
