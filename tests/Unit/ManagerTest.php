<?php

use Gerardojbaez\PhpCheckup\Checks\Check;
use Gerardojbaez\PhpCheckup\Contracts\Check as CheckInterface;
use Gerardojbaez\PhpCheckup\Manager;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class ManagerTest extends TestCase
{
    public function testCreateInstanceWithChecksArray()
    {
        // Arrange
        $check = $this->createCheck();

        // Act
        $manager = new Manager([$check]);

        // Assert
        $this->assertCount(1, $checks = $manager->checks());
        $this->assertSame($check, $checks[0]);
    }

    public function testAddCheck()
    {
        // Arrange
        $check = $this->createCheck();

        $manager = new Manager;

        // Act
        $return = $manager->add($check);

        // Assert
        $this->assertSame($manager, $return);
        $this->assertCount(1, $checks = $manager->checks());
        $this->assertSame($check, $checks[0]);
    }

    public function testGetNewManagerForChecksInGroup()
    {
        // Arrange
        $first = $this->createCheck();
        $first->group('a');

        $second = $this->createCheck();
        $second->group('a');
        $second->group('b');

        $third = $this->createCheck();
        $third->group('c');

        $manager = new Manager([
            $first, $second, $third
        ]);

        // Act
        $actual = $manager->group('a');

        // Assert
        $this->assertInstanceOf(Manager::class, $actual);

        $this->assertCount(2, $singularChecks = $actual->checks());
        $this->assertSame($first, $singularChecks[0]);
        $this->assertSame($second, $singularChecks[1]);
    }

    public function testGetNewManagerForChecksInGroups()
    {
        // Arrange
        $first = $this->createCheck();
        $first->group('b');

        $second = $this->createCheck();
        $second->group('b');
        $second->group('c');
        $second->group('d');

        $third = $this->createCheck();
        $third->group('e');

        $manager = new Manager([
            $first, $second, $third
        ]);

        // Act
        $actual = $manager->groups(['b', 'c', 'd']);

        // Assert
        $this->assertInstanceOf(Manager::class, $actual);

        $this->assertCount(2, $pluralChecks = $actual->checks());
        $this->assertSame($first, $pluralChecks[0]);
        $this->assertSame($second, $pluralChecks[1]);
    }

    /** @dataProvider isPassingProvider */
    public function testPassingReturnsNumberOfPassingChecks($isPassing, $checks)
    {
        // Arrange
        $manager = new Manager($checks);

        // Act
        $actual = $manager->passing();

        // Assert
        $this->assertSame(3, $actual);
    }

    /** @dataProvider isPassingProvider */
    public function testIsPassing($expected, $checks)
    {
        // Arrange
        $manager = new Manager($checks);

        // Act
        $actual = $manager->isPassing();

        // Assert
        $this->assertSame($expected, $actual);
    }

    public function isPassingProvider()
    {
        $passing = [
            $this->createCheck(true),
            $this->createCheck(true),
            $this->createCheck(true),
        ];

        $notPassing = $passing;
        $notPassing[3] = $this->createCheck(false);

        return [
            [true, $passing],
            [false, $notPassing]
        ];
    }

    public function createCheck(bool $isPassing = true)
    {
        /** @var CheckInterface|MockObject $check */
        $check = $this->createMock(CheckInterface::class);
        $check->method('check')->will($this->returnValue($isPassing));

        return new Check('My check', $check);
    }
}
