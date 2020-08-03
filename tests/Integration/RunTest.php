<?php

use Gerardojbaez\PhpCheckup\Check;
use Gerardojbaez\PhpCheckup\Contracts\Check as CheckInterface;
use Gerardojbaez\PhpCheckup\Manager;
use Gerardojbaez\PhpCheckup\Runner;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class RunTest extends TestCase
{
    public function testRunSimpleListOfPassingChecks()
    {
        // Arrange
        $manager = new Manager([
            $this->createCheck('Check one'),
            $this->createCheck('Check two')
        ]);

        $runner = new Runner();

        // Act
        $result = $runner->run($manager);

        // Assert
        $this->assertTrue($result->isPassing());
        $this->assertFalse($result->isFailing());
        $this->assertFalse($result->isSkipping());
    }

    public function testRunListWithOneLevelDependencyAndFailingParents()
    {
        // Arrange
        $manager = new Manager([
            $this->createCheck('Parent check', false)->code('parent'),
            $this->createCheck('Child check', true)->dependsOn('parent', 'Skipping due to failing parent'),
            $this->createCheck('Regular check', true)
        ]);

        $runner = new Runner();

        // Act
        $result = $runner->run($manager);

        // Assert
        $this->assertFalse($result->isPassing());
        $this->assertTrue($result->isFailing());
        $this->assertTrue($result->isSkipping());
        $this->assertSame(1, $result->getFailingCount());
        $this->assertCount(1, $result->getFailingChecks());
        $this->assertSame(1, $result->getSkippingCount());
        $this->assertCount(1, $result->getSkippingChecks());
        $this->assertSame(1, $result->getPassingCount());
        $this->assertCount(1, $result->getPassingChecks());
    }

    public function testRunListWithOneLevelDependencyAndPassingParents()
    {
        // Arrange
        $manager = new Manager([
            $this->createCheck('Parent check', true)->code('parent'),
            $this->createCheck('Child check', true)->dependsOn('parent', 'Skipping due to failing parent'),
            $this->createCheck('Regular check', true)
        ]);

        $runner = new Runner();

        // Act
        $result = $runner->run($manager);

        // Assert
        $this->assertTrue($result->isPassing());
        $this->assertFalse($result->isFailing());
        $this->assertFalse($result->isSkipping());
        $this->assertSame(0, $result->getFailingCount());
        $this->assertCount(0, $result->getFailingChecks());
        $this->assertSame(0, $result->getSkippingCount());
        $this->assertCount(0, $result->getSkippingChecks());
        $this->assertSame(3, $result->getPassingCount());
        $this->assertCount(3, $result->getPassingChecks());
    }

    public function testRunListWithTwoLevelDependencyAndFailingParents()
    {
        // Arrange
        $manager = new Manager([
            $this->createCheck('Parent check', false)->code('parent'),
            $this->createCheck('Child & Parent check', true)->code('child-parent')->dependsOn('parent'),
            $this->createCheck('Child check', true)->dependsOn('child-parent'),
            $this->createCheck('Regular check', true)
        ]);

        $runner = new Runner();

        // Act
        $result = $runner->run($manager);

        // Assert
        $this->assertCount(4, $result->getChecksResult());
        $this->assertFalse($result->isPassing());
        $this->assertTrue($result->isFailing());
        $this->assertTrue($result->isSkipping());
        $this->assertSame(1, $result->getFailingCount());
        $this->assertCount(1, $result->getFailingChecks());
        $this->assertSame(2, $result->getSkippingCount());
        $this->assertCount(2, $result->getSkippingChecks());
        $this->assertSame(1, $result->getPassingCount());
        $this->assertCount(1, $result->getPassingChecks());
    }

    public function testRunListWithTwoLevelDependencyAndPassingParents()
    {
        // Arrange
        $manager = new Manager([
            $this->createCheck('Parent check', true)->code('parent'),
            $this->createCheck('Child & Parent check', true)->code('child-parent')->dependsOn('parent'),
            $this->createCheck('Child check', true)->dependsOn('child-parent'),
            $this->createCheck('Regular check', true)
        ]);

        $runner = new Runner();

        // Act
        $result = $runner->run($manager);

        // Assert
        $this->assertTrue($result->isPassing());
        $this->assertFalse($result->isFailing());
        $this->assertFalse($result->isSkipping());
        $this->assertSame(0, $result->getFailingCount());
        $this->assertCount(0, $result->getFailingChecks());
        $this->assertSame(0, $result->getSkippingCount());
        $this->assertCount(0, $result->getSkippingChecks());
        $this->assertSame(4, $result->getPassingCount());
        $this->assertCount(4, $result->getPassingChecks());
    }

    public function createCheck($name, bool $isPassing = true): Check
    {
        /** @var CheckInterface|MockObject */
        $check = $this->createStub(CheckInterface::class);
        $check->method('check')->willReturn($isPassing);

        return new Check($name, $check);
    }
}
