<?php

use PHPUnit\Framework\MockObject\MockObject;
use Gerardojbaez\PhpCheckup\Checks\Php\MinimumMemory;
use Gerardojbaez\PhpCheckup\Contracts\Php\Config\Repository;
use PHPUnit\Framework\TestCase;

final class MinimumMemoryTest extends TestCase
{
    /** @dataProvider checkProvider */
    public function testCheck($expected, $minMemory, $actualMemory)
    {
        // Arrange
        $repository = $this->createRepository($actualMemory);

        $check = new MinimumMemory($minMemory, $repository);

        // Act
        $actual = $check->check();

        // Assert
        $this->assertSame($expected, $actual);
    }

    /** @dataProvider dataProvider */
    public function testData($expected, $minMemory, $actualMemory)
    {
        // Arrange
        $repository = $this->createRepository($actualMemory);

        $check = new MinimumMemory($minMemory, $repository);

        // Act
        $actual = $check->data();

        // Assert
        $this->assertSame($expected, $actual);
    }

    public function checkProvider()
    {
        return [
            // #0 - Testing 1KB min, actual limit is -1 (int), passing.
            [true, 1024, -1],

            // #1 - Testing 1KB min, actual limit is -1 (str), passing.
            [true, 1024, '-1'],

            // #2 - Testing 2048 bytes min, actual limit is 1024 bytes (bytes), failing.
            [false, 2048, 1024],

            // #3 - Testing 2048 bytes min, actual limit is 2048 bytes (bytes), passing.
            [true, 2048, 2048],

            // #4 - Testing 2048 bytes min, actual limit is 3072 bytes (bytes), passing.
            [true, 2048, 2048],

            // #5 - Testing 2048 bytes min, actual limit is 1 kilobyte (K shorthand), failing.
            [false, 2048, '1K'],

            // #6 - Testing 2048 bytes min, actual limit is 2 kilobytes (K shorthand), passing.
            [true, 2048, '2K'],

            // #7 - Testing 2048 bytes min, actual limit is 3 kilobytes (K shorthand), passing.
            [true, 2048, '3K'],

            // #8 - Testing 2097152 bytes min, actual limit is 1 megabyte (M shorthand), failing.
            [false, 2097152, '1M'],

            // #9 - Testing 2097152 bytes min, actual limit is 2 megabytes (M shorthand), passing.
            [true, 2097152, '2M'],

            // #10 - Testing 2097152 bytes min, actual limit is 3 megabytes (M shorthand), passing.
            [true, 2097152, '3M'],

            // #11 - Testing 2147483648 bytes min, actual limit is 1 gigabyte (G shorthand), failing.
            [false, 2147483648, '1G'],

            // #12 - Testing 2147483648 bytes min, actual limit is 2 gigabytes (G shorthand), passing.
            [true, 2147483648, '2G'],

            // #13 - Testing 2147483648 bytes min, actual limit is 3 gigabytes (G shorthand), passing.
            [true, 2147483648, '3G'],
        ];
    }

    public function dataProvider()
    {
        return [
            [['memory_limit' => '-1'], 1024, '-1'], // data set #0
            [['memory_limit' => '-1'], 1024, '-1'], // data set #1
            [['memory_limit' => '1024'], 1024, '1024'], // data set #2
        ];
    }

    private function createRepository($actualMemory)
    {
        /** @var Repository|MockObject */
        $repository = $this->createMock(Repository::class);
        $repository->expects($this->once())
            ->method('get')
            ->with($this->equalTo('memory_limit'))
            ->will($this->returnValue((string) $actualMemory));

        return $repository;
    }
}
