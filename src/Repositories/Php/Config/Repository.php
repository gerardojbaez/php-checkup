<?php

declare(strict_types=1);

namespace Gerardojbaez\PhpCheckup\Repositories\Php\Config;

use Gerardojbaez\PhpCheckup\Contracts\Repositories\Php\Config\Repository as Contract;

final class Repository implements Contract
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
