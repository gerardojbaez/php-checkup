<?php

declare(strict_types=1);

namespace Gerardojbaez\PhpCheckup\Checks\Php;

use Gerardojbaez\PhpCheckup\Contracts\Check;

/**
 * Check whether a PHP extension is loaded.
 *
 * @since 0.1.0
 */
final class ExtensionIsLoaded implements Check
{
    /**
     * The extension name to be tested.
     *
     * @var string
     *
     * @since 0.1.0
     */
    private $extension;

    /**
     * Create a new check instance.
     */
    public function __construct(string $extension)
    {
        $this->extension = $extension;
    }

    /**
     * Run check.
     *
     * @since 0.1.0
     */
    public function check(): bool
    {
        return extension_loaded($this->extension);
    }
}
