<?php

declare(strict_types=1);

// Use the same namespace as the class under test so we can
// mock its function dependencies.
namespace Gerardojbaez\PhpCheckup\Checks;

use PHPUnit\Framework\TestCase;
use Gerardojbaez\PhpCheckup\CheckResult;
use Gerardojbaez\PhpCheckup\Status;
use Gerardojbaez\PhpCheckup\Checks\PhpExtensionIsLoaded;

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
    public function testName($status, $message, $extension)
    {
        // Arrange
        $check = new PhpExtensionIsLoaded($extension);

        // Act
        $name = $check->name();

        // Assert
        $this->assertSame(
            sprintf('Check whether PHP extension "%s" is loaded', $extension),
            $name
        );
    }

    /** @dataProvider checkProvider */
    public function testCheck($status, $message, $extension)
    {
        // Arrange
        $check = new PhpExtensionIsLoaded($extension);

        // Act
        $result = $check->check();

        // Assert
        $this->assertInstanceOf(CheckResult::class, $result);
        $this->assertTrue($status->equals($result->status()));
        $this->assertSame($message, $result->message());
    }

    public function checkProvider()
    {
        return [
            [Status::passing(), 'PHP extension "mbstring" was found.', 'mbstring'],
            [Status::failing(), 'PHP extension "mailparse" was not found.', 'mailparse']
        ];
    }
}
