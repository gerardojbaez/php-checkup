<?php

declare(strict_types=1);

namespace Gerardojbaez\Checker;

/**
 * Status value object.
 *
 * @method static Status passing()
 * @method static Status failing()
 * @method static Status critical()
 * @method static Status warning()
 * @method static Status informational()
 */
final class Status
{
    public const PASSING = 'passing';
    public const FAILING = 'failing';
    public const CRITICAL = 'critical';
    public const WARNING = 'warning';
    public const INFORMATIONAL = 'informational';

    /**
     * The status value.
     *
     * @var string
     */
    private $status;

    /**
     * Create a new status instance.
     */
    public function __construct(string $status)
    {
        $this->status = $status;
    }

    /**
     * Use status as string.
     */
    public function __toString(): string
    {
        return $this->status;
    }

    /**
     * Create status instance by using static factory methods.
     *
     * @param string $status The status to create.
     * @param any[] $args The arguments for the status; none currently.
     */
    public static function __callStatic(string $status, array $args): Status
    {
        return new static($status);
    }

    /**
     * Determine whether status is passing.
     */
    public function isPassing(): bool
    {
        return $this->status === self::PASSING;
    }

    /**
     * Determine whether status is failing.
     */
    public function isFailing(): bool
    {
        return $this->status === self::FAILING;
    }

    /**
     * Determine whether status is critical.
     */
    public function isCritical(): bool
    {
        return $this->status === self::CRITICAL;
    }

    /**
     * Determine whether status is warning.
     */
    public function isWarning(): bool
    {
        return $this->status === self::WARNING;
    }

    /**
     * Determine whether status is informational.
     */
    public function isInformational(): bool
    {
        return $this->status === self::INFORMATIONAL;
    }

    /**
     * Get the underlying status string value.
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * Determine whether another status is equals to the current one.
     */
    public function equals(Status $status): bool
    {
        return $this->status === $status->getStatus();
    }
}
