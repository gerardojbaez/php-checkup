<?php

declare(strict_types=1);

namespace Gerardojbaez\PhpCheckup;

/**
 * Check status value object.
 *
 * @since 0.5.0
 */
final class Status
{
    private const STATUS_PASSING = 'passing';
    private const STATUS_FAILING = 'failing';
    private const STATUS_SKIPPING = 'skipping';

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
     * Cast instance to string.
     */
    public function __toString(): string
    {
        return $this->status;
    }

    /**
     * Create a new passing status.
     */
    public static function passing(): Status
    {
        return new static(self::STATUS_PASSING);
    }

    /**
     * Create a new failing status.
     */
    public static function failing(): Status
    {
        return new static(self::STATUS_FAILING);
    }

    /**
     * Create a new skipping status.
     */
    public static function skipping(): Status
    {
        return new static(self::STATUS_SKIPPING);
    }

    /**
     * Determine whether status is passing status.
     */
    public function isPassing(): bool
    {
        return $this->status === self::STATUS_PASSING;
    }

    /**
     * Determine whether status is failing status.
     */
    public function isFailing(): bool
    {
        return $this->status === self::STATUS_FAILING;
    }

    /**
     * Determine whether status is skipping status.
     */
    public function isSkipping(): bool
    {
        return $this->status === self::STATUS_SKIPPING;
    }
}
