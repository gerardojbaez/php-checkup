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
     */
    public function check(): bool;
}
