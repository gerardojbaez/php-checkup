<?php

declare(strict_types=1);

namespace Gerardojbaez\Checker;

use Gerardojbaez\Checker\Contracts\Check;
use Gerardojbaez\Checker\Contracts\Manager as ManagerInterface;

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
                return $check->hasAnyGroup($groups);
            }
        ));
    }

    /**
     * Get the count of passing checks.
     *
     * @since 0.1.0
     */
    public function passing(): int
    {
        return array_sum(array_map(static function ($check) {
            return $check->check()->status()->isPassing() ? 1 : 0;
        }, $this->checks));
    }

    /**
     * Determine whether all checks are passing.
     *
     * @since 0.1.0
     */
    public function isPassing(): bool
    {
        return $this->passing() === count($this->checks());
    }
}
