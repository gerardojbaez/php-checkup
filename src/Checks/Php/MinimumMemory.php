<?php

declare(strict_types=1);

namespace Gerardojbaez\PhpCheckup\Checks\Php;

use Gerardojbaez\PhpCheckup\Contracts\Check;

/**
 * Check whether PHP's memory limit meets a minimum.
 *
 * @since 0.1.0
 */
final class MinimumMemory implements Check
{
    /**
     * The minimum memory allowed.
     *
     * @since 0.1.0
     *
     * @var int
     */
    private $memory;

    /**
     * The current memory limit value.
     *
     * @since 0.2.0
     *
     * @var string
     */
    private $actualMemory;

    /**
     * Create a new check instance.
     *
     * @param int $memory The minimum allowed memory, in Bytes.
     * @param string $actualMemory The current memory_limit value.
     */
    public function __construct(int $memory, string $actualMemory)
    {
        $this->memory = $memory;
        $this->actualMemory = $actualMemory;
    }

    /**
     * Run check.
     *
     * @since 0.1.0
     */
    public function check(): bool
    {
        $limit = $this->actualMemory;

        // If limit is unlimited, there's nothing else to do here...
        if ((int) $limit === -1) {
            return true;
        }

        return $this->toBytes((string) $limit) >= $this->memory;
    }

    /**
     * Get data related to this check, which can be used to
     * format check message.
     *
     * @since 0.1.0
     *
     * @return string|int[]
     */
    public function data(): array
    {
        return [
            'target_memory' => $this->memory,
            'memory_limit' => $this->actualMemory,
        ];
    }

    /**
     * Normalize raw memory limit value into bytes.
     *
     * @since 0.1.0
     */
    private function toBytes(string $limit): int
    {
        $shorthand = strtoupper(substr($limit, -1, 1));
        $bytes = ['K' => 1024, 'M' => 1048576, 'G' => 1073741824];

        if (isset($bytes[$shorthand])) {
            $size = (int) str_replace($shorthand, '', $limit);

            return $size * $bytes[$shorthand];
        }

        return (int) $limit;
    }
}
