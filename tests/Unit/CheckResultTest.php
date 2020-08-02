<?php

use Gerardojbaez\PhpCheckup\CheckResult;
use Gerardojbaez\PhpCheckup\Status;
use Gerardojbaez\PhpCheckup\Type;
use PHPUnit\Framework\TestCase;

class CheckResultTest extends TestCase
{
    public function testGetters()
    {
        // Arrange
        $type = Type::critical();

        $result = new CheckResult(
            'My check', 'code', $type, Status::passing(), 'Failing'
        );

        // Assert
        $this->assertSame('My check', $result->name());
        $this->assertSame('code', $result->code());
        $this->assertSame('Failing', $result->message());
        $this->assertSame($type, $result->type());
        $this->assertTrue($result->status()->isPassing());
        $this->assertFalse($result->status()->isFailing());
    }
}
