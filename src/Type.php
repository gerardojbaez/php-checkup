<?php

declare(strict_types=1);

namespace Gerardojbaez\PhpCheckup;

/**
 * Check's type value object.
 *
 * @since 0.1.0
 */
final class Type
{
    /**
     * @since 0.1.0
     */
    private const TYPE_CRITICAL = 'critical';

    /**
     * @since 0.1.0
     */
    private const TYPE_WARNING = 'warning';

    /**
     * @since 0.1.0
     */
    private const TYPE_INFO = 'informational';

    /**
     * @since 0.1.0
     *
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

    /**
     * Cast instance to string.
     *
     * @since 0.1.0
     */
    public function __toString(): string
    {
        return $this->type;
    }

    /**
     * Create new critical type instance.
     *
     * @since 0.1.0
     */
    public static function critical(): Type
    {
        return new static(self::TYPE_CRITICAL);
    }

    /**
     * Create new warning type instance.
     *
     * @since 0.1.0
     */
    public static function warning(): Type
    {
        return new static(self::TYPE_WARNING);
    }

    /**
     * Create new informational type instance.
     *
     * @since 0.1.0
     */
    public static function informational(): Type
    {
        return new static(self::TYPE_INFO);
    }

    /**
     * Alias for Type::informational().
     *
     * @since 0.1.0
     */
    public static function info(): Type
    {
        return self::informational();
    }

    /**
     * Determine whether type is critical.
     *
     * @since 0.1.0
     */
    public function isCritical(): bool
    {
        return $this->type === self::TYPE_CRITICAL;
    }

    /**
     * Determine whether type is warning.
     *
     * @since 0.1.0
     */
    public function isWarning(): bool
    {
        return $this->type === self::TYPE_WARNING;
    }

    /**
     * Determine whether type is informational.
     *
     * @since 0.1.0
     */
    public function isInformational(): bool
    {
        return $this->type === self::TYPE_INFO;
    }

    /**
     * Get the underlying type value.
     *
     * @since 0.1.0
     */
    public function getType(): string
    {
        return $this->type;
    }
}
