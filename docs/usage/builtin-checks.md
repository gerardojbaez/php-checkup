# Built-in checks

These are the built-in checks included with PHP Checkup; along with their configuration options which can vary from check to check. To learn how to *register* and *use* any of these checks, take a look at [this guide](/usage/check-list.html).

## PHP Extension Loaded

Use `Gerardojbaez\PhpCheckup\Checks\Php\ExtensionIsLoaded` when checking for loaded PHP extensions. Each extension requires a new instance.

The constructor accepts one argument, which is a `string` representing the name of the extension you are checking.

This check doesn't return any formatting data.

Example:

```php
use Gerardojbaez\PhpCheckup\Checks\Php\ExtensionIsLoaded;

$mbstring = new ExtensionIsLoaded('mbstring');
$mailparse = new ExtensionIsLoaded('mailparse');
```

## PHP Minimum Memory Limit

Use `Gerardojbaez\PhpCheckup\Checks\Php\MinimumMemory` when checking for a minimum of PHP's Memory Limit.

The constructor accepts two arguments, the first one is an `int` representing the minimum bytes to check, the second argument is an instance of `Gerardojbaez\PhpCheckup\Contracts\Repositories\Php\Config\Repository`, which can be `Gerardojbaez\PhpCheckup\Repositories\Php\Config\Config`.

This check returns formatting data with the following values:

- `memory_limit`: The memory limit currently set.

Example:

```php
use Gerardojbaez\PhpCheckup\Checks\Php\MinimumMemory;
use Gerardojbaez\PhpCheckup\Repositories\Php\Config\Config;

// 50MB minimum
$memory = new MinimumMemory(1024 * 50, new Config);
$data = $memory->data(); // E.g., ['memory_limit' => '-1']
```
