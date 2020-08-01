<?php

declare(strict_types=1);

namespace Gerardojbaez\PhpCheckup\Checks\Filesystem;

use Gerardojbaez\PhpCheckup\Contracts\Check;

/**
 * Check whether a path is writable.
 *
 * @since 0.4.0
 */
final class Readable implements Check
{
    /**
     * The path to check.
     *
     * @var string
     */
    private $path;

    /**
     * Create a new check instance.
     */
    public function __construct(string $path)
    {
        $this->path = $path;
    }

    /**
     * Run check.
     */
    public function check(): bool
    {
        return is_readable($this->path);
    }

    /**
     * Get data related to this check, which can be used to
     * format check message.
     *
     * @return string|int[]
     */
    public function data(): array
    {
        return [];
    }
}
