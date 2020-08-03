<?php

use Gerardojbaez\PhpCheckup\Check;
use Gerardojbaez\PhpCheckup\Contracts\Check as CheckInterface;
use Gerardojbaez\PhpCheckup\Contracts\Manager;
use Gerardojbaez\PhpCheckup\Runner;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class RunnerTest extends TestCase
{
    public function testRunSimpleList()
    {
        // Arrange
        $checks = [$this->fakeCheck()];

        /** @var Manager|MockObject */
        $manager = $this->createStub(Manager::class);
        $manager->expects($this->once())
            ->method('checks')
            ->willReturn($checks);

        $runner = new Runner();

        // Act
        $result = $runner->run($manager);

        // Assert
        $this->assertCount(1, $result->getChecksResult());
        $this->assertSame(1, $result->getPassingCount());
        $this->assertSame(0, $result->getFailingCount());
    }

    private function fakeCheck($isPassing = true)
    {
        /** @var CheckInterface|MockObject $check */
        $check = $this->createMock(CheckInterface::class);
        $check->method('check')->will($this->returnValue($isPassing));

        return new Check('My check', $check);
    }
}
