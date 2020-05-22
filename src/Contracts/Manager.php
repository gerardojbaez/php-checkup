<?php

declare(strict_types=1);

namespace Gerardojbaez\Checker\Contracts;

/**
 * Interface for checks managers to implement.
 *
 * @since 0.1.0
 */
interface Manager
{
    /**
     * Create a new check manager instance.
     *
     * @param Check[] $checks
     */
    public function __construct(array $checks = []);

    /**
     * Set or get the check groups.
     *
     * @since 0.1.0
     *
     * @return string[]
     */
    public function add(Check $check): Manager;

    /**
     * Get registered checks.
     *
     * @since 0.1.0
     *
     * @return Check[]
     */
    public function checks(): array;

    /**
     * Get checks corresponding to the provided group.
     *
     * This method is an alias for groups(['group']).
     *
     * @since 0.1.0
     *
     * @return static
     */
    public function group(string $group): Manager;

    /**
     * Get checks corresponding to the provided groups.
     *
     * @since 0.1.0
     *
     * @param string[] $groups
     *
     * @return static
     */
    public function groups(array $groups): Manager;

    /**
     * Get the count of passing checks.
     *
     * @since 0.1.0
     */
    public function passing(): int;

    /**
     * Determine whether all checks are passing.
     *
     * @since 0.1.0
     */
    public function isPassing(): bool;
}
