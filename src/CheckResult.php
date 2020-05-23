<?php

declare(strict_types=1);

namespace Gerardojbaez\PhpCheckup;

final class CheckResult
{
    /**
     * Check's name.
     *
     * @var string
     */
    private $name;

    /**
     * Check's final status.
     *
     * @var bool
     */
    private $passing;

    /**
     * The check type.
     *
     * @var Type
     */
    private $type;

    /**
     * The check result message.
     *
     * @var string
     */
    private $message;

    /**
     * Create a new check result instance.
     */
    public function __construct(
        string $name,
        Type $type,
        bool $passing,
        string $message
    ) {
        $this->name = $name;
        $this->type = $type;
        $this->passing = $passing;
        $this->message = $message;
    }

    /**
     * Get the check's name.
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * Whether the check is passing.
     */
    public function isPassing(): bool
    {
        return $this->passing;
    }

    /**
     * Whether the check is failing.
     */
    public function isFailing(): bool
    {
        return $this->passing === false;
    }

    /**
     * Get the check type.
     */
    public function type(): Type
    {
        return $this->type;
    }

    /**
     * Get the message.
     */
    public function message(): string
    {
        return $this->message;
    }
}
