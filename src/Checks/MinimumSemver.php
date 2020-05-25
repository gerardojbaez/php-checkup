<?php

declare(strict_types=1);

namespace Gerardojbaez\PhpCheckup\Checks;

use Gerardojbaez\PhpCheckup\Contracts\Check;

/**
 * Check whether PHP's version meets a minimum.
 *
 * @since 0.2.0
 */
final class MinimumSemver implements Check
{
    /**
     * The minimum version allowed.
     *
     * @since 0.2.0
     *
     * @var string
     */
    private $targetVersion;

    /**
     * The current version to compare.
     *
     * @since 0.2.0
     *
     * @var string
     */
    private $currentVersion;

    /**
     * Create a new check instance.
     *
     * @param int $version The minimum allowed version, in Bytes.
     */
    public function __construct(string $targetVersion, string $currentVersion)
    {
        $this->targetVersion = $targetVersion;
        $this->currentVersion = $currentVersion;
    }

    /**
     * Run check.
     *
     * @since 0.2.0
     */
    public function check(): bool
    {
        return version_compare(
            $this->currentVersion, $this->targetVersion, '>='
        ) === true;
    }

    /**
     * Get data related to this check, which can be used to
     * format check message.
     *
     * @since 0.2.0
     *
     * @return string|int[]
     */
    public function data(): array
    {
        return [
            'target_version' => $this->targetVersion,
            'current_version' => $this->currentVersion,
        ];
    }
}
