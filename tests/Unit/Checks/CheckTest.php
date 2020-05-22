<?php

use Gerardojbaez\PhpCheckup\Checks\Php\ExtensionIsLoaded;
use PHPUnit\Framework\TestCase;

final class CheckTest extends TestCase
{
    public function testAddGetGroups()
    {
        // Arrange
        $check = new ExtensionIsLoaded('dummy');
        $check->addGroup('one');
        $check->addGroup('two');

        // Act
        $actual = $check->groups();

        // Assert
        $this->assertSame(['one', 'two'], $actual);
    }

    /** @dataProvider hasAnyGroupProvider */
    public function testHasAnyGroup($expected, $groups)
    {
        // Arrange
        $check = new ExtensionIsLoaded('dummy');
        $check->addGroup('one');
        $check->addGroup('two');
        $check->addGroup('three');

        // Act
        $actual = $check->hasAnyGroup($groups);

        // Assert
        $this->assertSame($expected, $actual);
    }

    public function hasAnyGroupProvider()
    {
        return [
            [true, ['three', 'four']],
            [false, ['four', 'five']],
        ];
    }
}
