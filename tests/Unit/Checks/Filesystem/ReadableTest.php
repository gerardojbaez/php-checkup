<?php

declare(strict_types=1);

// Use the same namespace as the class under test so we can
// mock its function dependencies.
namespace Gerardojbaez\PhpCheckup\Checks\Filesystem;

use PHPUnit\Framework\TestCase;
use Gerardojbaez\PhpCheckup\Checks\Filesystem\Readable;

/**
 * Mock PHP function.
 *
 * @param string $path
 * @return bool
 */
function is_readable($path) {
    return $path === 'storage/private.key';
}

final class ReadableTest extends TestCase
{
    public function testData()
    {
        // Arrange
        $check = new Readable('storage');

        // Act
        $result = $check->data();

        // Assert
        $this->assertSame([], $result);
    }

    /** @dataProvider checkProvider */
    public function testCheck($expected, $path)
    {
        // Arrange
        $check = new Readable($path);

        // Act
        $result = $check->check();

        // Assert
        $this->assertSame($expected, $result);
    }

    public function checkProvider()
    {
        return [
            [true, 'storage/private.key'],
            [false, 'storage/public.key']
        ];
    }
}
