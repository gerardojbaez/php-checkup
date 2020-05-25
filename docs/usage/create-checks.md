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

And [register it](/usage/check-list.html) as you register any other check.

The `check()` method is where you will place the check's logic, and return `true` when it passes, or `false` otherwise. The `data()` method is used to format the check's passing or failing message.
