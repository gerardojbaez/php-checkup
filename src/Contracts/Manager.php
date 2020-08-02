<?php

declare(strict_types=1);

namespace Gerardojbaez\PhpCheckup\Contracts;

use Gerardojbaez\PhpCheckup\Check;

/**
 * Interface for checks managers to implement.
 *
 * @since 0.1.0
 */
interface Manager
{
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
     * Filter checks by check code.
     *
     * @since 0.5.0
     */
    public function code(string $code): Manager;

    /**
     * Filter checks by a list of codes.
     *
     * @since 0.5.0
     *
     * @param string[] $codes
     */
    public function codes(array $codes): Manager;
}
