# Create new checks

Simply create a class that implements `\Gerardojbaez\PhpCheckup\Contracts\Check` interface:

```php
<?php

namespace App\PhpCheckup\Checks\MyCheck;

use Gerardojbaez\PhpCheckup\Contracts\Check;

class MyCheck implements Check
{
    /**
     * Run check.
     */
    public function check(): bool
    {
        return true;
    }

    /**
     * Get data related to this check, which can be used to
     * format check message.
     *
     * @return string|int[]
     */
    public function data(): array
    {
        return [];
    }
}
```
