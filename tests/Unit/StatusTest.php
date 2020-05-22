<?php

use Gerardojbaez\Checker\Status;
use PHPUnit\Framework\TestCase;

final class StatusTest extends TestCase
{
    /** @dataProvider statusProvider */
    public function testStaticFactory($status)
    {
        // Act
        $instance = Status::$status();

        // Assert
        $this->assertInstanceOf(Status::class, $instance);
        $this->assertSame($status, $instance->getStatus());
    }

    /** @dataProvider statusProvider */
    public function testGetStatus($status)
    {
        // Act
        $instance = new Status($status);

        // Assert
        $this->assertSame($status, $instance->getStatus());
    }

    /** @dataProvider statusProvider */
    public function testToString($status)
    {
        // Act
        $actual = (string) new Status($status);

        // Assert
        $this->assertSame($status, $actual);
    }

    /** @dataProvider equalsProvider */
    public function testEquals($expected, $statusOne, $statusTwo)
    {
        // Arrange
        $status = new Status($statusOne);

        // Act
        $actual = $status->equals(new Status($statusTwo));

        // Assert
        $this->assertSame($expected, $actual);
    }

    /** @dataProvider equalsProvider */
    public function testIsGivenStatus($expected, $statusOne, $statusTwo)
    {
        // Arrange
        $method = 'is'.ucfirst($statusTwo);

        // Act
        $actual = (new Status($statusOne))->$method();

        // Assert
        $this->assertSame($expected, $actual);
    }

    public function statusProvider()
    {
        return [
            ['passing'],
            ['failing'],
            ['critical'],
            ['warning'],
            ['informational'],
        ];
    }

    public function equalsProvider()
    {
        return [
            [true, 'passing', 'passing'],
            [true, 'failing', 'failing'],
            [true, 'critical', 'critical'],
            [true, 'warning', 'warning'],
            [true, 'informational', 'informational'],
            [false, 'failing', 'critical'],
            [false, 'passing', 'warning'],
            [false, 'random string', 'informational'],
        ];
    }
}
