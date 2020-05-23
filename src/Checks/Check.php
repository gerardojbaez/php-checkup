<?php

declare(strict_types=1);

namespace Gerardojbaez\PhpCheckup\Checks;

use Gerardojbaez\PhpCheckup\CheckResult;
use Gerardojbaez\PhpCheckup\Contracts\Check as CheckInterface;
use Gerardojbaez\PhpCheckup\Type;

final class Check
{
    /**
     * The groups for the check.
     *
     * @var string[]
     */
    private $groups = [];

    /**
     * The check to be executed.
     *
     * @var CheckInterface
     */
    private $check;

    /**
     * The name of the check.
     *
     * @var string
     */
    private $name;

    /**
     * The message to be used if check passes.
     *
     * @var string
     */
    private $passingMessage = 'Passing';

    /**
     * The message to be used when check fails.
     *
     * @var string
     */
    private $failingMessage = 'Failing';

    /**
     * Type of check.
     *
     * @var Type
     */
    private $type;

    /**
     * Create a check instance.
     */
    public function __construct(string $name, CheckInterface $check)
    {
        $this->name = $name;
        $this->check = $check;

        $this->type = Type::critical();
    }

    /**
     * Get check's name.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the type of the check.
     */
    public function getType(): Type
    {
        return $this->type;
    }

    /**
     * @return string[]
     */
    public function getGroups(): array
    {
        return $this->groups;
    }

    /**
     * Add a new group.
     */
    public function group(string $name): Check
    {
        $this->groups[] = $name;

        return $this;
    }

    /**
     * Set message to be used when check passes.
     */
    public function passing(string $pass): Check
    {
        $this->passingMessage = $pass;

        return $this;
    }

    /**
     * Set the message to be used when check fails.
     */
    public function failing(string $message): Check
    {
        $this->failingMessage = $message;

        return $this;
    }

    /**
     * Mark check as critical.
     */
    public function critical(): Check
    {
        $this->type = Type::critical();

        return $this;
    }

    /**
     * Mark check as warning type.
     */
    public function warning(): Check
    {
        $this->type = Type::warning();

        return $this;
    }

    /**
     * Mark check as informational.
     */
    public function informational(): Check
    {
        $this->type = Type::info();

        return $this;
    }

    /**
     * Run check and get the result.
     */
    public function check(): CheckResult
    {
        return new CheckResult(
            $this->name,
            $this->type,
            $passing = $this->check->check(),
            $passing ? $this->passingMessage : $this->failingMessage
        );
    }
}
