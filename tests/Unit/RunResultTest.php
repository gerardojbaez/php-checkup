<?php

use Gerardojbaez\PhpCheckup\CheckResult;
use Gerardojbaez\PhpCheckup\RunResult;
use Gerardojbaez\PhpCheckup\Status;
use Gerardojbaez\PhpCheckup\Type;
use PHPUnit\Framework\TestCase;

class RunResultTest extends TestCase
{
    public function testGetCheckResult()
    {
        // Arrange
        $checkResult = [
            $this->fakeCheckResult(),
        ];

        $runResult = new RunResult($checkResult);

        // Act
        $actual = $runResult->getChecksResult();

        // Assert
        $this->assertSame($checkResult, $actual);
    }

    public function testIsPassing()
    {
        // Arrange
        $checkResult = [
            $this->fakeCheckResult(),
            $this->fakeCheckResult(),
        ];

        $runResult = new RunResult($checkResult);

        // Act
        $isPassing = $runResult->isPassing();
        $passingCount = $runResult->getPassingCount();

        // Assert
        $this->assertSame(2, $passingCount);
        $this->assertTrue($isPassing);
    }

    public function testGetPassingChecks()
    {
        // Arrange
        $passingCheckResult = [
            $this->fakeCheckResult(),
            $this->fakeCheckResult(),
        ];
        $checkResult = array_merge([
            $this->fakeCheckResult('failing'),
            $this->fakeCheckResult('skipping'),
        ], $passingCheckResult);

        $runResult = new RunResult($checkResult);

        // Act
        $isPassing = $runResult->isPassing();
        $passingCount = $runResult->getPassingCount();
        $passingChecks = $runResult->getPassingChecks();

        // Assert
        $this->assertSame(2, $passingCount);
        $this->assertCount(2, $passingChecks);
        $this->assertSame(array_shift($passingChecks), array_shift($passingCheckResult));
        $this->assertSame(array_shift($passingChecks), array_shift($passingCheckResult));
        $this->assertFalse($isPassing);
    }

    public function testIsFailing()
    {
        // Arrange
        $checkResult = [
            $this->fakeCheckResult(),
            $this->fakeCheckResult('failing'),
        ];

        $runResult = new RunResult($checkResult);

        // Act
        $isFailing = $runResult->isFailing();
        $failingCount = $runResult->getFailingCount();

        // Assert
        $this->assertSame(1, $failingCount);
        $this->assertTrue($isFailing);
    }

    public function testGetFailingChecks()
    {
        // Arrange
        $failingCheckResult = [
            $this->fakeCheckResult('failing'),
            $this->fakeCheckResult('failing'),
        ];
        $checkResult = array_merge([
            $this->fakeCheckResult('skipping'),
            $this->fakeCheckResult('passing'),
        ], $failingCheckResult);

        $runResult = new RunResult($checkResult);

        // Act
        $isFailing = $runResult->isFailing();
        $passingCount = $runResult->getFailingCount();
        $passingChecks = $runResult->getFailingChecks();

        // Assert
        $this->assertSame(2, $passingCount);
        $this->assertCount(2, $passingChecks);
        $this->assertSame(array_shift($passingChecks), array_shift($failingCheckResult));
        $this->assertSame(array_shift($passingChecks), array_shift($failingCheckResult));
        $this->assertTrue($isFailing);
    }

    public function testIsSkipping()
    {
        // Arrange
        $checkResult = [
            $this->fakeCheckResult(),
            $this->fakeCheckResult('skipping'),
        ];

        $runResult = new RunResult($checkResult);

        // Act
        $isSkipping = $runResult->isSkipping();
        $skippingCount = $runResult->getSkippingCount();

        // Assert
        $this->assertSame(1, $skippingCount);
        $this->assertTrue($isSkipping);
    }

    public function testGetSkippingChecks()
    {
        // Arrange
        $skippingCheckResult = [
            $this->fakeCheckResult('skipping'),
            $this->fakeCheckResult('skipping'),
        ];
        $checkResult = array_merge([
            $this->fakeCheckResult('failing'),
            $this->fakeCheckResult('passing'),
        ], $skippingCheckResult);

        $runResult = new RunResult($checkResult);

        // Act
        $isSkipping = $runResult->isSkipping();
        $passingCount = $runResult->getSkippingCount();
        $passingChecks = $runResult->getSkippingChecks();

        // Assert
        $this->assertSame(2, $passingCount);
        $this->assertCount(2, $passingChecks);
        $this->assertSame(array_shift($passingChecks), array_shift($skippingCheckResult));
        $this->assertSame(array_shift($passingChecks), array_shift($skippingCheckResult));
        $this->assertTrue($isSkipping);
    }

    private function fakeCheckResult($status = 'passing')
    {
        return new CheckResult(
            'The check name',
            rand(0, 10),
            Type::critical(),
            new Status($status),
            'The message'
        );
    }
}
