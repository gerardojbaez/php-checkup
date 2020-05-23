<?php

use Gerardojbaez\PhpCheckup\Type;
use PHPUnit\Framework\TestCase;

class TypeTest extends TestCase
{
    /** @dataProvider typesProvider */
    public function testConstructor($type)
    {
        // Act
        $instance = new Type($type);

        // Assert
        $this->assertSame($type, (string) $instance);
        $this->assertSame($type, $instance->getType());
    }

    /** @dataProvider statcFactoryMethodsProvider */
    public function testStaticFactoryMethods($method, $type)
    {
        // Act
        $instance = Type::$method();

        // Assert
        $this->assertSame($type, (string) $instance);
        $this->assertSame($type, $instance->getType());
    }

    /** @dataProvider booleanMethodsProvider */
    public function testBooleanMethods($method, $type, $expected)
    {
        // Arrange
        $instance = new Type($type);

        // Act
        $actual = $instance->$method();

        // Assert
        $this->assertSame($expected, $actual);
    }

    public function typesProvider()
    {
        return [
            ['critical'],
            ['warning'],
            ['informational']
        ];
    }

    public function statcFactoryMethodsProvider()
    {
        return [
            ['critical', 'critical'],
            ['warning', 'warning'],
            ['informational', 'informational'],
            ['info', 'informational']
        ];
    }

    public function booleanMethodsProvider()
    {
        return [
            ['isCritical', 'critical', true],
            ['isCritical', 'warning', false],
            ['isCritical', 'informational', false],

            ['isWarning', 'critical', false],
            ['isWarning', 'warning', true],
            ['isWarning', 'informational', false],

            ['isInformational', 'critical', false],
            ['isInformational', 'warning', false],
            ['isInformational', 'informational', true],
        ];
    }
}
