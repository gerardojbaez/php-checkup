<?php

declare(strict_types=1);

namespace Gerardojbaez\PhpCheckup\Checks\Php;

use Gerardojbaez\PhpCheckup\Contracts\Check;
use Gerardojbaez\PhpCheckup\Contracts\Repositories\Php\Config\Repository;

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
     * The config repository instance.
     *
     * @var Repository
     */
    private $config;

    /**
     * Create a new check instance.
     *
     * @param int $memory The minimum allowed memory, in Bytes.
     */
    public function __construct(int $memory, Repository $config)
    {
        $this->memory = $memory;
        $this->config = $config;
    }

    /**
     * Run check.
     *
     * @since 0.1.0
     */
    public function check(): bool
    {
        $limit = $this->getMemoryLimit();

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
     * @return string|int[]
     */
    public function data(): array
    {
        return [
            'memory_limit' => $this->getMemoryLimit(),
        ];
    }

    /**
     * Get the memory limit currenlty set.
     *
     * @since 0.1.0
     */
    private function getMemoryLimit(): string
    {
        return $this->config->get('memory_limit');
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
