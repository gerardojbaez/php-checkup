<?php

declare(strict_types=1);

namespace Gerardojbaez\PhpCheckup;

use Gerardojbaez\PhpCheckup\Contracts\Check as CheckInterface;

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
     * The check's code.
     *
     * @var string
     */
    private $code;

    /**
     * The check's messages based on status.
     *
     * @var string[]
     */
    private $messages = [
        'passing' => 'Passing',
        'failing' => 'Failing',
        'skipping' => 'Skipping',
    ];

    /**
     * The check's parent checks.
     *
     * @var string[]
     */
    private $dependsOn = [];

    /**
     * Type of check.
     *
     * @var Type
     */
    private $type;

    /**
     * Whether check should be skipped.
     *
     * @var bool
     */
    private $skip = false;

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
     * Get check's code.
     */
    public function getCode(): ?string
    {
        return $this->code;
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
     * @return string[]
     */
    public function getDependsOn(): array
    {
        return $this->dependsOn;
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
     * Set check's code.
     */
    public function code(string $code): Check
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Set check's dependencies.
     */
    public function dependsOn(string $code, string $message = 'Skipping'): Check
    {
        $this->dependsOn[$code] = $message;

        return $this;
    }

    /**
     * Set message to be used when check passes.
     */
    public function passing(string $pass): Check
    {
        $this->messages['passing'] = $pass;

        return $this;
    }

    /**
     * Set the message to be used when check fails.
     */
    public function failing(string $message): Check
    {
        $this->messages['failing'] = $message;

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

    public function skip(bool $skip, string $skipping): Check
    {
        $this->skip = $skip;
        $this->messages['skipping'] = $skipping;

        return $this;
    }

    /**
     * Run check and get the result.
     */
    public function check(): CheckResult
    {
        if ($this->skip) {
            $status = Status::skipping();
        } else {
            $status = $this->check->check()
                ? Status::passing()
                : Status::failing();
        }

        $message = $this->message($status);

        return new CheckResult(
            $this->name, $this->code, $this->type, $status, $message
        );
    }

    /**
     * Get a message based on status.
     */
    private function message(Status $status): string
    {
        $keys = array_map(static function ($key) {
            return ":${key}";
        }, array_keys($this->check->data()));

        $values = array_values($this->check->data());

        return str_replace($keys, $values, $this->messages[(string) $status]);
    }
}
