<?php

declare(strict_types=1);

namespace Gerardojbaez\PhpCheckup\Contracts\Repositories\Php\Config;

/**
 * @since 0.1.0
 */
interface Repository
{
    /**
     * Get a config from the repository.
     *
     * @since 0.1.0
     */
    public function get(string $name): string;
}
