<?php

use Gerardojbaez\PhpCheckup\Checks\MinimumSemver;
use PHPUnit\Framework\TestCase;

class MinimumSemverTest extends TestCase
{
    /** @dataProvider checkProvider */
    public function testCheck($expected, $targetVersion, $currentVersion)
    {
        // Arrange
        $check = new MinimumSemver($targetVersion, $currentVersion);

        // Act
        $actual = $check->check();

        // Assert
        $this->assertSame($expected, $actual);
    }

    /** @dataProvider dataProvider */
    public function testData($targetVersion, $currentVersion)
    {
        // Arrange
        $check = new MinimumSemver($targetVersion, $currentVersion);

        // Act
        $actual = $check->data();

        // Assert
        $this->assertSame([
            'target_version' => $targetVersion,
            'current_version' => $currentVersion
        ], $actual);
    }

    public function checkProvider()
    {
        return [
            [false, '7.1.0', '7.0.0'],
            [true, '7.1.0', '7.1.0'],
            [true, '7.1.0', '7.2.0'],
            [true, '7.1.0', '8.1.0'],
        ];
    }

    public function dataProvider()
    {
        return [
            ['7.1.0', '7.0.0'],
            ['7.1.0', '7.1.0'],
            ['7.1.0', '7.2.0'],
            ['7.1.0', '8.1.0'],
        ];
    }
}
