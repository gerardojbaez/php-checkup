<?php

declare(strict_types=1);

namespace Gerardojbaez\PhpCheckup\Checks\Php;

use Gerardojbaez\PhpCheckup\CheckResult;
use Gerardojbaez\PhpCheckup\Checks\Check;
use Gerardojbaez\PhpCheckup\Status;

final class ExtensionIsLoaded extends Check
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
     * Get the check's name.
     */
    public function name(): string
    {
        return sprintf(
            'Check whether PHP extension "%s" is loaded',
            $this->extension
        );
    }

    /**
     * Run check.
     */
    public function check(): CheckResult
    {
        $passing = extension_loaded($this->extension);
        $passingMessage = 'PHP extension "%s" was found.';
        $failingMessage = 'PHP extension "%s" was not found.';

        return new CheckResult(
            $passing ? Status::passing() : Status::failing(),
            sprintf(
                $passing ? $passingMessage : $failingMessage,
                $this->extension
            )
        );
    }
}
