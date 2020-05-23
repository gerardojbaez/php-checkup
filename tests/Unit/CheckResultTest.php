<?php

use Gerardojbaez\PhpCheckup\CheckResult;
use Gerardojbaez\PhpCheckup\Type;
use PHPUnit\Framework\TestCase;

class CheckResultTest extends TestCase
{
    public function testGetters()
    {
        // Arrange
        $type = Type::critical();

        $result = new CheckResult(
            'My check', $type, true, 'Failing'
        );

        // Assert
        $this->assertSame('My check', $result->name());
        $this->assertSame('Failing', $result->message());
        $this->assertSame($type, $result->type());
        $this->assertTrue($result->isPassing());
        $this->assertFalse($result->isFailing());
    }
}
