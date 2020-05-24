<?php

declare(strict_types=1);

namespace Gerardojbaez\PhpCheckup\Contracts;

/**
 * Interface for all checks to implement.
 *
 * @since 0.1.0
 */
interface Check
{
    /**
     * Run check.
     *
     * @since 0.1.0
     */
    public function check(): bool;

    /**
     * Get data related to this check, which can be used to
     * format check message.
     *
     * @return string|int[]
     */
    public function data(): array;
}
