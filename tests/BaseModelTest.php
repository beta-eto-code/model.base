<?php

namespace Model\Base\Tests;

use Exception;
use Model\Base\Tests\Stub\PersonModel;
use PHPUnit\Framework\TestCase;

class BaseModelTest extends TestCase
{
    public function testInitFromArray()
    {
        $person = PersonModel::initFromArray([
            'name' => 'testName',
            'lastName' => 'testLastName',
            'age' => 31,
            'phone' => '+79888888888',
        ]);

        $this->assertEquals('testName', $person->name);
        $this->assertEquals('testLastName', $person->lastName);
        $this->assertEquals(31, $person->age);
        $this->assertEquals('+79888888888', $person->phone);
    }

    public function testAssertValueByKey()
    {
        $person = new PersonModel();
        $person->name = 'testName';
        $person->lastName = 'testLastName';
        $person->age = 31;
        $person->phone = '+79888888888';

        $this->assertTrue($person->assertValueByKey('name', 'testName'));
        $this->assertTrue($person->assertValueByKey('lastName', 'testLastName'));
        $this->assertTrue($person->assertValueByKey('age', 31));
        $this->assertTrue($person->assertValueByKey('phone', '+79888888888'));
    }

    public function testHasValueKey()
    {
        $person = new PersonModel();
        $person->name = 'testName';
        $person->lastName = 'testLastName';

        $this->assertTrue($person->hasValueKey('name'));
        $this->assertTrue($person->hasValueKey('lastName'));
        $this->assertTrue($person->hasValueKey('age'));
        $this->assertTrue($person->hasValueKey('phone'));
        $this->assertFalse($person->hasValueKey('newField'));
    }

    public function testOffsetGet()
    {
        $person = new PersonModel();
        $person->name = 'testName';
        $person->lastName = 'testLastName';
        $person->age = 31;
        $person->phone = '+79888888888';

        $this->assertEquals('testName', $person->offsetGet('name'));
        $this->assertEquals('testName', $person['name']);

        $this->assertEquals('testLastName', $person->offsetGet('lastName'));
        $this->assertEquals('testLastName', $person['lastName']);

        $this->assertEquals(31, $person->offsetGet('age'));
        $this->assertEquals(31, $person['age']);

        $this->assertEquals('+79888888888', $person->offsetGet('phone'));
        $this->assertEquals('+79888888888', $person['phone']);
    }

    public function testOffsetUnset()
    {
        $person = new PersonModel();
        $person->name = 'testName';
        $person->lastName = 'testLastName';

        $this->assertNotEmpty($person->name);
        $person->offsetUnset('name');
        $this->assertEmpty($person->name ?? null);

        $this->assertNotEmpty($person->lastName);
        unset($person['lastName']);
        $this->assertEmpty($person->lastName ?? null);
    }

    public function testMap()
    {
        $person = new PersonModel();
        $person->name = 'testName';
        $person->lastName = 'testLastName';

        $this->assertEquals(['name' => 'testName testLastName'], $person->map(function (PersonModel $model): array {
            return [
                'name' => $model->name . ' ' . $model->lastName
            ];
        }));
    }

    public function testOffsetExists()
    {
        $person = new PersonModel();
        $person->name = 'testName';
        $person->lastName = 'testLastName';

        $this->assertTrue($person->offsetExists('name'));
        $this->assertArrayHasKey('name', $person);

        $this->assertTrue($person->offsetExists('lastName'));
        $this->assertArrayHasKey('lastName', $person);

        $this->assertTrue($person->offsetExists('age'));
        $this->assertArrayHasKey('age', $person);

        $this->assertTrue($person->offsetExists('phone'));
        $this->assertArrayHasKey('phone', $person);
    }

    /**
     * @throws Exception
     */
    public function testGetIterator()
    {
        $person = new PersonModel();
        $person->name = 'testName';
        $person->lastName = 'testLastName';
        $person->age = 31;
        $person->phone = '+79888888888';

        $iterator = $person->getIterator();
        $this->assertEquals('name', $iterator->key());
        $this->assertEquals('testName', $iterator->current());

        $iterator->next();
        $this->assertEquals('lastName', $iterator->key());
        $this->assertEquals('testLastName', $iterator->current());

        $iterator->next();
        $this->assertEquals('age', $iterator->key());
        $this->assertEquals(31, $iterator->current());

        $iterator->next();
        $this->assertEquals('phone', $iterator->key());
        $this->assertEquals('+79888888888', $iterator->current());
    }

    public function testOffsetSet()
    {
        $person = new PersonModel();
        $person->name = 'testName';
        $this->assertEquals('testName', $person->name);

        $person->offsetSet('name', 'newTestName');
        $this->assertEquals('newTestName', $person->name);

        $person['name'] = 'newTestName2';
        $this->assertEquals('newTestName2', $person->name);
    }

    public function testGetValueByKey()
    {
        $person = new PersonModel();
        $person->name = 'testName';
        $person->lastName = 'testLastName';
        $person->age = 31;
        $person->phone = '+79888888888';

        $this->assertEquals('testName' , $person->getValueByKey('name'));
        $this->assertEquals('testLastName' , $person->getValueByKey('lastName'));
        $this->assertEquals(31 , $person->getValueByKey('age'));
        $this->assertEquals('+79888888888' , $person->getValueByKey('phone'));
    }
}
