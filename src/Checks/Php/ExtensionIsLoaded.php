<?php

declare(strict_types=1);

namespace Gerardojbaez\PhpCheckup\Checks\Php;

use Gerardojbaez\PhpCheckup\Contracts\Check;

final class ExtensionIsLoaded implements Check
{
    /**
     * The extension name to be tested.
     *
     * @var string
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
     */
    public function check(): bool
    {
        return extension_loaded($this->extension);
    }
}
