<?php

declare(strict_types=1);

// Use the same namespace as the class under test so we can
// mock its function dependencies.
namespace Gerardojbaez\PhpCheckup\Checks\Filesystem;

use PHPUnit\Framework\TestCase;
use Gerardojbaez\PhpCheckup\Checks\Filesystem\Writable;

/**
 * Mock PHP function.
 *
 * @param string $path
 * @return bool
 */
function is_writable($path) {
    return $path === 'storage';
}

final class WritableTest extends TestCase
{
    public function testData()
    {
        // Arrange
        $check = new Writable('storage');

        // Act
        $result = $check->data();

        // Assert
        $this->assertSame([], $result);
    }

    /** @dataProvider checkProvider */
    public function testCheck($expected, $path)
    {
        // Arrange
        $check = new Writable($path);

        // Act
        $result = $check->check();

        // Assert
        $this->assertSame($expected, $result);
    }

    public function checkProvider()
    {
        return [
            [true, 'storage'],
            [false, '.env']
        ];
    }
}
