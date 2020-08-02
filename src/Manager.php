<?php

declare(strict_types=1);

namespace Gerardojbaez\PhpCheckup;

use Gerardojbaez\PhpCheckup\Contracts\Manager as ManagerInterface;

/**
 * Check's manager class.
 *
 * @since 0.1.0
 */
final class Manager implements ManagerInterface
{
    /**
     * List of checks to be executed.
     *
     * @var Check[]
     */
    private $checks = [];

    /**
     * Create a new check manager.
     *
     * @param Check[] $checks
     */
    public function __construct(array $checks = [])
    {
        foreach ($checks as $check) {
            $this->add($check);
        }
    }

    /**
     * Add a check to the manager.
     *
     * @since 0.1.0
     *
     * @return string[]
     */
    public function add(Check $check): ManagerInterface
    {
        $this->checks[] = $check;

        return $this;
    }

    /**
     * Get registered checks.
     *
     * @since 0.1.0
     *
     * @return Check[]
     */
    public function checks(): array
    {
        return $this->checks;
    }

    /**
     * Get checks under a particular group.
     *
     * This method is an alias for groups(['group']).
     *
     * @since 0.1.0
     */
    public function group(string $group): ManagerInterface
    {
        return $this->groups([$group]);
    }

    /**
     * Get checks under at least one of the provided groups.
     *
     * @since 0.1.0
     *
     * @param string[] $groups
     */
    public function groups(array $groups): ManagerInterface
    {
        return new static(array_filter(
            $this->checks, static function ($check) use ($groups) {
                return count(array_intersect($check->getGroups(), $groups));
            }
        ));
    }

    /**
     * Filter checks by check code.
     *
     * @since 0.5.0
     */
    public function code(string $code): ManagerInterface
    {
        return $this->codes([$code]);
    }

    /**
     * Filter checks by a list of codes.
     *
     * @since 0.5.0
     *
     * @param string[] $codes
     */
    public function codes(array $codes): ManagerInterface
    {
        return new static(array_filter(
            $this->checks, static function ($check) use ($codes) {
                return in_array($check->getCode(), $codes);
            }
        ));
    }
}
