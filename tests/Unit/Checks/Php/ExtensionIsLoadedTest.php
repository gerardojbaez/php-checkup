<?php

declare(strict_types=1);

// Use the same namespace as the class under test so we can
// mock its function dependencies.
namespace Gerardojbaez\PhpCheckup\Checks\Php;

use PHPUnit\Framework\TestCase;
use Gerardojbaez\PhpCheckup\CheckResult;
use Gerardojbaez\PhpCheckup\Status;
use Gerardojbaez\PhpCheckup\Checks\Php\ExtensionIsLoaded;

/**
 * Mock PHP function.
 *
 * @param string $name
 * @return bool
 */
function extension_loaded($name) {
    return $name === 'mbstring';
}

final class PhpExtensionIsLoadedTest extends TestCase
{
    /** @dataProvider checkProvider */
    public function testCheck($expected, $extension)
    {
        // Arrange
        $check = new ExtensionIsLoaded($extension);

        // Act
        $result = $check->check();

        // Assert
        $this->assertSame($expected, $result);
    }

    public function checkProvider()
    {
        return [
            [true, 'mbstring'],
            [false, 'mailparse']
        ];
    }
}
