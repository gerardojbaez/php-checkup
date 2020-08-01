<?php

use Gerardojbaez\PhpCheckup\Check;
use Gerardojbaez\PhpCheckup\Contracts\Check as CheckInterface;
use Gerardojbaez\PhpCheckup\Type;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class CheckTest extends TestCase
{
    public function testCriticalTypeByDefault()
    {
        // Arrange
        $check = $this->createCheck();

        // Assert
        $this->assertInstanceOf(Type::class, $check->getType());
        $this->assertTrue($check->getType()->isCritical());
    }

    public function testGetName()
    {
        // Arrange
        $check = $this->createCheck();

        // Act
        $result = $check->getName();

        // Assert
        $this->assertSame('My check', $result);
    }

    public function testSetGetGroups()
    {
        // Arrange
        $check = $this->createCheck();
        $check->group('one');
        $check->group('two');

        // Act
        $actual = $check->getGroups();

        // Assert
        $this->assertSame(['one', 'two'], $actual);
    }

    public function testPassingWithDefaultMessage()
    {
        // Arrange
        $check = $this->createCheck();

        // Act
        $result = $check->check();

        // Assert
        $this->assertSame('Passing', $result->message());
        $this->assertTrue($result->isPassing());
    }

    public function testPassingWithCustomMessage()
    {
        // Arrange
        $check = $this->createCheck();
        $check->passing('My custom passing message');

        // Act
        $result = $check->check();

        // Assert
        $this->assertSame('My custom passing message', $result->message());
        $this->assertTrue($result->isPassing());
    }

    public function testFailingWithDefaultMessage()
    {
        // Arrange
        $check = $this->createCheck(false);

        // Act
        $result = $check->check();

        // Assert
        $this->assertSame('Failing', $result->message());
        $this->assertTrue($result->isFailing());
    }

    public function testFailingWithCustomMessage()
    {
        // Arrange
        $check = $this->createCheck(false);
        $check->failing('My custom failing message - :placeholder');

        // Act
        $result = $check->check();

        // Assert
        $this->assertSame(
            'My custom failing message - value',
            $result->message()
        );

        $this->assertTrue($result->isFailing());
    }

    public function testCritical()
    {
        // Arrange
        $check = $this->createCheck();

        // Act
        $result = $check->critical();

        // Assert
        $this->assertInstanceOf(Check::class, $result);
        $this->assertInstanceOf(Type::class, $check->getType());
        $this->assertTrue($check->getType()->isCritical());
    }

    public function testWarning()
    {
        // Arrange
        $check = $this->createCheck();

        // Act
        $result = $check->warning();

        // Assert
        $this->assertInstanceOf(Check::class, $result);
        $this->assertInstanceOf(Type::class, $check->getType());
        $this->assertTrue($check->getType()->isWarning());
    }

    public function testInformational()
    {
        // Arrange
        $check = $this->createCheck();

        // Act
        $result = $check->informational();

        // Assert
        $this->assertInstanceOf(Check::class, $result);
        $this->assertInstanceOf(Type::class, $check->getType());
        $this->assertTrue($check->getType()->isInformational());
    }

    private function createCheck(bool $isPassing = true)
    {
        /** @var CheckInterface|MockObject */
        $mock = $this->createMock(CheckInterface::class);
        $mock->expects($this->any())
            ->method('check')
            ->will($this->returnValue($isPassing));
        $mock->expects($this->any())
            ->method('data')
            ->will($this->returnValue([
                'placeholder' => 'value'
            ]));

        $check = new Check('My check', $mock);

        return $check;
    }
}
