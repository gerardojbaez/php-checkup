<?php

use Gerardojbaez\PhpCheckup\Status;
use PHPUnit\Framework\TestCase;

class StatusTest extends TestCase
{
    public function testPassing()
    {
        // Arrange
        $status = Status::passing();

        // Assert
        $this->assertTrue($status->isPassing());
        $this->assertFalse($status->isFailing());
        $this->assertFalse($status->isSkipping());
    }

    public function testFailing()
    {
        // Arrange
        $status = Status::failing();

        // Assert
        $this->assertFalse($status->isPassing());
        $this->assertTrue($status->isFailing());
        $this->assertFalse($status->isSkipping());
    }

    public function testSkipping()
    {
        // Arrange
        $status = Status::skipping();

        // Assert
        $this->assertFalse($status->isPassing());
        $this->assertFalse($status->isFailing());
        $this->assertTrue($status->isSkipping());
    }

    /** @dataProvider statusDataProvider */
    public function testToString(string $string)
    {
        // Arrange
        $status = new Status($string);

        // Act
        $result = (string) $status;

        // Assert
        $this->assertSame($string, $result);
    }

    public function statusDataProvider()
    {
        return [
            ['passing'],
            ['failing'],
            ['skipping'],
        ];
    }
}
