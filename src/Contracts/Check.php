<?php

declare(strict_types=1);

namespace Gerardojbaez\PhpCheckup\Contracts;

use Gerardojbaez\PhpCheckup\CheckResult;

/**
 * Interface for all checks to implement.
 *
 * @since 0.1.0
 */
interface Check
{
    /**
     * Get groups.
     *
     * @return string[]
     */
    public function groups(): array;

    /**
     * Add group.
     */
    public function addGroup(string $name): Check;

    /**
     * Get the check's name.
     */
    public function name(): string;

    /**
     * Run check.
     */
    public function check(): CheckResult;
}
