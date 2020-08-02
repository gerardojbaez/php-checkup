<?php

declare(strict_types=1);

namespace Gerardojbaez\PhpCheckup;

final class RunResult
{
    /**
     * The checks result.
     *
     * @var CheckResult[]
     */
    private $checks = [];

    /**
     * Create a new run result instance.
     *
     * @param CheckResult[] $checksResult
     */
    public function __construct(array $checksResult)
    {
        $this->checks = $checksResult;
    }

    /**
     * @return CheckResult[]
     */
    public function getChecksResult(): array
    {
        return $this->checks;
    }

    public function isPassing(): bool
    {
        return $this->getPassingCount() === count($this->checks);
    }

    public function isFailing(): bool
    {
        return $this->getFailingCount() > 0;
    }

    public function isSkipping(): bool
    {
        return $this->getSkippingCount() > 0;
    }

    public function getPassingCount(): int
    {
        return count($this->getPassingChecks());
    }

    /**
     * @return CheckResult[]
     */
    public function getPassingChecks(): array
    {
        return array_filter($this->checks, static function ($result) {
            return $result->status()->isPassing();
        });
    }

    public function getFailingCount(): int
    {
        return count($this->getFailingChecks());
    }

    /**
     * @return CheckResult[]
     */
    public function getFailingChecks(): array
    {
        return array_filter($this->checks, static function ($result) {
            return $result->status()->isFailing();
        });
    }

    public function getSkippingCount(): int
    {
        return count($this->getSkippingChecks());
    }

    /**
     * @return CheckResult[]
     */
    public function getSkippingChecks(): array
    {
        return array_filter($this->checks, static function ($result) {
            return $result->status()->isSkipping();
        });
    }
}
