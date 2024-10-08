<?php

namespace Model\Base\Tests\Serialization;

use Model\Base\Serialization\CamelCase;
use PHPUnit\Framework\TestCase;

class CamelCaseTest extends TestCase
{
    public function testGetNeValue()
    {
        $serializeStrategy = new CamelCase();
        $this->assertEquals('lastName', $serializeStrategy->getNewKey('last_name'));
        $this->assertEquals('lastName', $serializeStrategy->getNewKey('Last_Name'));
        $this->assertEquals('lastNamE', $serializeStrategy->getNewKey('Last_NamE'));
    }

    public function testGetNewKey()
    {
        $serializeStrategy = new CamelCase();
        $this->assertEquals('new_value', $serializeStrategy->getNewValue('new_value'));
        $this->assertEquals(31, $serializeStrategy->getNewValue(31));
        $this->assertEquals('NewValue', $serializeStrategy->getNewValue('NewValue'));
    }
}
