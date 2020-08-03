<?php

declare(strict_types=1);

namespace Gerardojbaez\PhpCheckup\Contracts;

use Gerardojbaez\PhpCheckup\RunResult;

interface Runner
{
    /**
     * Run checks.
     */
    public function run(Manager $manager): RunResult;
}
