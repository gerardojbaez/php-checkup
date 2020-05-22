<?php

declare(strict_types=1);

namespace Gerardojbaez\Checker\Contracts;

use Gerardojbaez\Checker\CheckResult;

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
     * Determine if check has any of the provided groups.
     *
     * @param string[] $names
     */
    public function hasAnyGroup(array $names): bool;

    /**
     * Get the check's name.
     */
    public function name(): string;

    /**
     * Run check.
     */
    public function check(): CheckResult;
}
