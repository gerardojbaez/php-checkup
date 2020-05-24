<?php

declare(strict_types=1);

namespace Gerardojbaez\PhpCheckup\Repositories\Php\Config;

use Gerardojbaez\PhpCheckup\Contracts\Repositories\Php\Config\Repository;

/**
 * PHP's INI configuration repository implementation.
 *
 * @since 0.1.0
 */
final class Config implements Repository
{
    /**
     * Get a config from the repository.
     *
     * @codeCoverageIgnore
     *
     * @since 0.1.0
     */
    public function get(string $name): string
    {
        return ini_get($name);
    }
}
