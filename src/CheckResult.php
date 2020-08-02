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
     * Check's code.
     *
     * @since 0.1.0
     *
     * @var string
     */
    private $code;

    /**
     * The status.
     *
     * @since 0.5.0
     *
     * @var Status
     */
    private $status;

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
        ?string $code,
        Type $type,
        Status $status,
        string $message
    ) {
        $this->name = $name;
        $this->code = $code;
        $this->type = $type;
        $this->status = $status;
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
     * Get the check's code.
     *
     * @since 0.5.0
     */
    public function code(): string
    {
        return $this->code;
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
     * Get the check status.
     *
     * @since 0.5.0
     */
    public function status(): Status
    {
        return $this->status;
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
