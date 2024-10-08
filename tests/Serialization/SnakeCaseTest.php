<?php

namespace Model\Base\Tests\Serialization;

use Model\Base\Serialization\SnakeCase;
use PHPUnit\Framework\TestCase;

class SnakeCaseTest extends TestCase
{
    public function testGetNewKey()
    {
        $serializeStrategy = new SnakeCase();
        $this->assertEquals('last_name', $serializeStrategy->getNewKey('lastName'));
        $this->assertEquals('last_name', $serializeStrategy->getNewKey('LastName'));
        $this->assertEquals('last_nam_e', $serializeStrategy->getNewKey('lastNamE'));
    }

    public function testGetNeValue()
    {
        $serializeStrategy = new SnakeCase();
        $this->assertEquals('new_value', $serializeStrategy->getNewValue('new_value'));
        $this->assertEquals(31, $serializeStrategy->getNewValue(31));
        $this->assertEquals('NewValue', $serializeStrategy->getNewValue('NewValue'));
    }
}
