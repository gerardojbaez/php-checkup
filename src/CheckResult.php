<?php

declare(strict_types=1);

namespace Gerardojbaez\PhpCheckup;

/**
 * Holds a check's result.
 *
 * @since 0.1.0
 */
final class CheckResult
{
    /**
     * Check's name.
     *
     * @since 0.1.0
     *
     * @var string
     */
    private $name;

    /**
     * Whether the check is passing.
     *
     * @since 0.1.0
     *
     * @var bool
     */
    private $passing;

    /**
     * The check type.
     *
     * @since 0.1.0
     *
     * @var Type
     */
    private $type;

    /**
     * The check result message.
     *
     * @since 0.1.0
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
     *
     * @since 0.1.0
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * Whether the check is passing.
     *
     * @since 0.1.0
     */
    public function isPassing(): bool
    {
        return $this->passing;
    }

    /**
     * Whether the check is failing.
     *
     * @since 0.1.0
     */
    public function isFailing(): bool
    {
        return $this->passing === false;
    }

    /**
     * Get the check type.
     *
     * @since 0.1.0
     */
    public function type(): Type
    {
        return $this->type;
    }

    /**
     * Get the message.
     *
     * @since 0.1.0
     */
    public function message(): string
    {
        return $this->message;
    }
}
