<?php

declare(strict_types=1);

namespace Gerardojbaez\PhpCheckup;

/**
 * Check's type value object.
 */
final class Type
{
    private const TYPE_CRITICAL = 'critical';
    private const TYPE_WARNING = 'warning';
    private const TYPE_INFO = 'informational';

    /**
     * @var string
     */
    private $type;

    /**
     * Create a new type instance.
     */
    public function __construct(string $type)
    {
        $this->type = $type;
    }

    public function __toString(): string
    {
        return $this->type;
    }

    /**
     * Create new critical type instance.
     */
    public static function critical(): Type
    {
        return new static(self::TYPE_CRITICAL);
    }

    /**
     * Create new warning type instance.
     */
    public static function warning(): Type
    {
        return new static(self::TYPE_WARNING);
    }

    /**
     * Create new informational type instance.
     */
    public static function informational(): Type
    {
        return new static(self::TYPE_INFO);
    }

    /**
     * Alias for Type::informational().
     */
    public static function info(): Type
    {
        return self::informational();
    }

    /**
     * Determine whether type is critical.
     */
    public function isCritical(): bool
    {
        return $this->type === self::TYPE_CRITICAL;
    }

    /**
     * Determine whether type is warning.
     */
    public function isWarning(): bool
    {
        return $this->type === self::TYPE_WARNING;
    }

    /**
     * Determine whether type is informational.
     */
    public function isInformational(): bool
    {
        return $this->type === self::TYPE_INFO;
    }

    /**
     * Get the underlying type value.
     */
    public function getType(): string
    {
        return $this->type;
    }
}
