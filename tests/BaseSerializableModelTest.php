<?php

namespace Model\Base\Tests;

use Model\Base\SerializeStrategy;
use Model\Base\Tests\Stub\PersonModel;
use PHPUnit\Framework\TestCase;

class BaseSerializableModelTest extends TestCase
{
    public function testJsonSerialize()
    {
        $person = new PersonModel();
        $person->name = 'testName';
        $person->lastName = 'testLastName';
        $person->age = 31;
        $person->phone = '+79888888888';
        $person->one_more_phone = '1234';
        $this->assertEquals([
            'name' => 'testName',
            'lastName' => 'testLastName',
            'age' => 31,
            'phone' => '+79888888888',
            'one_more_phone' => '1234'
        ], $person->jsonSerialize());

        $person->setSerializeStrategy(SerializeStrategy::getSnakeCase());
        $this->assertEquals([
            'name' => 'testName',
            'last_name' => 'testLastName',
            'age' => 31,
            'phone' => '+79888888888',
            'one_more_phone' => '1234'
        ], $person->jsonSerialize());

        $person->setSerializeStrategy(SerializeStrategy::getCamelCase());
        $this->assertEquals([
            'name' => 'testName',
            'lastName' => 'testLastName',
            'age' => 31,
            'phone' => '+79888888888',
            'oneMorePhone' => '1234'
        ], $person->jsonSerialize());

    }
}
