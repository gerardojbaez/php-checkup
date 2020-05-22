<?php

use Gerardojbaez\Checker\CheckResult;
use Gerardojbaez\Checker\Contracts\Check;
use Gerardojbaez\Checker\Manager;
use Gerardojbaez\Checker\Status;
use PHPUnit\Framework\TestCase;

final class ManagerTest extends TestCase
{
    public function testCreateInstanceWithChecksArray()
    {
        // Arrange
        $mock = $this->createMock(Check::class);

        // Act
        $manager = new Manager([$mock]);

        // Assert
        $this->assertCount(1, $checks = $manager->checks());
        $this->assertSame($mock, $checks[0]);
    }

    public function testAddCheck()
    {
        // Arrange
        /** @var Check $mock */
        $mock = $this->createMock(Check::class);

        $manager = new Manager;

        // Act
        $return = $manager->add($mock);

        // Assert
        $this->assertSame($manager, $return);
        $this->assertCount(1, $checks = $manager->checks());
        $this->assertSame($mock, $checks[0]);
    }

    public function testGetNewManagerForChecksInGroup()
    {
        // Arrange
        $first = $this->createMock(Check::class);
        $first->expects($this->once())
             ->method('hasAnyGroup')
             ->with($this->equalTo(['a']))
             ->will($this->returnValue(true));

        $second = $this->createMock(Check::class);
        $second->expects($this->once())
             ->method('hasAnyGroup')
             ->with($this->equalTo(['a']))
             ->will($this->returnValue(true));

        $third = $this->createMock(Check::class);
        $third->expects($this->once())
             ->method('hasAnyGroup')
             ->with($this->equalTo(['a']))
             ->will($this->returnValue(false));

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
        $first = $this->createMock(Check::class);
        $first->expects($this->once())
             ->method('hasAnyGroup')
             ->with($this->equalTo(['b', 'c', 'd']))
             ->will($this->returnValue(true));

        $second = $this->createMock(Check::class);
        $second->expects($this->once())
             ->method('hasAnyGroup')
             ->with($this->equalTo(['b', 'c', 'd']))
             ->will($this->returnValue(true));

        $third = $this->createMock(Check::class);
        $third->expects($this->once())
             ->method('hasAnyGroup')
             ->with($this->equalTo(['b', 'c', 'd']))
             ->will($this->returnValue(false));

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
        $passing[0] = $this->createMock(Check::class);
        $passing[0]->method('check')->will($this->returnValue(new CheckResult(Status::passing(), '')));

        $passing[1] = $this->createMock(Check::class);
        $passing[1]->method('check')->will($this->returnValue(new CheckResult(Status::passing(), '')));

        $passing[2] = $this->createMock(Check::class);
        $passing[2]->method('check')->will($this->returnValue(new CheckResult(Status::passing(), '')));

        $notPassing = $passing;
        $notPassing[3] = $this->createMock(Check::class);
        $notPassing[3]->method('check')->will($this->returnValue(new CheckResult(Status::failing(), '')));

        return [
            [true, $passing],
            [false, $notPassing]
        ];
    }
}
