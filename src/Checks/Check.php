<?php

declare(strict_types=1);

namespace Gerardojbaez\PhpCheckup\Checks;

use Gerardojbaez\PhpCheckup\CheckResult;
use Gerardojbaez\PhpCheckup\Contracts\Check as CheckInterface;

abstract class Check implements CheckInterface
{
    /**
     * The groups associated to the check.
     *
     * @var string[]
     */
    private $groups = [];

    /**
     * Get groups.
     *
     * @return string[]
     */
    public function groups(): array
    {
        return $this->groups;
    }

    /**
     * Add group.
     */
    public function addGroup(string $name): CheckInterface
    {
        $this->groups[] = $name;

        return $this;
    }

    /**
     * Determine if check has any of the provided groups.
     *
     * @param string[] $names
     */
    public function hasAnyGroup(array $names): bool
    {
        $names = array_filter($names, 'is_string');

        foreach ($names as $group) {
            if (in_array($group, $this->groups)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get the check's name.
     */
    abstract public function name(): string;

    /**
     * Run check.
     */
    abstract public function check(): CheckResult;
}
