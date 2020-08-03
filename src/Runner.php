<?php

declare(strict_types=1);

namespace Gerardojbaez\PhpCheckup;

use Gerardojbaez\PhpCheckup\Contracts\Manager;
use Gerardojbaez\PhpCheckup\Contracts\Runner as RunnerInterface;

final class Runner implements RunnerInterface
{
    /**
     * The runner instance.
     *
     * @var Manager
     */
    private $manager;

    /**
     * Run checks.
     */
    public function run(Manager $manager): RunResult
    {
        $this->manager = $manager;

        return $this->runChecks($this->manager->checks());
    }

    /**
     * @param Check[] $checks
     */
    private function runChecks(array $checks): RunResult
    {
        return new RunResult(
            array_map(function ($check) {
                return $this->runCheck($check);
            }, $checks)
        );
    }

    /**
     * Run individual checks.
     */
    private function runCheck(Check $check): CheckResult
    {
        $skipping = [];
        $dependsOn = $check->getDependsOn();
        $parents = $this->runChecks(
            $this->manager->codes(array_keys($dependsOn))->checks()
        )->getChecksResult();
        $parents = array_filter($parents, static function ($parent) {
            return $parent->status()->isPassing() === false;
        });

        foreach ($parents as $result) {
            if ($result->code()) {
                $skipping[] = $dependsOn[$result->code()];
            }
        }

        return $check->skip(
            count($skipping) > 0, implode("\n", $skipping)
        )->check();
    }
}
