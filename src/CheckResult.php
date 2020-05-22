<?php

declare(strict_types=1);

namespace Gerardojbaez\PhpCheckup;

final class CheckResult
{
    /**
     * Check's final status.
     *
     * @var Status
     */
    private $status;

    /**
     * The check result message.
     *
     * @var string
     */
    private $message;

    /**
     * Create a new check result instance.
     */
    public function __construct(Status $status, string $message)
    {
        $this->status = $status;
        $this->message = $message;
    }

    /**
     * Get the status.
     */
    public function status(): Status
    {
        return $this->status;
    }

    /**
     * Get the message.
     */
    public function message(): string
    {
        return $this->message;
    }
}
