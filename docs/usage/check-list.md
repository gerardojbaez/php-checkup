# Building a check list

First, define your check by constructing a `\Gerardojbaez\PhpCheckup\Checks` instance:

```php
use \Gerardojbaez\PhpCheckup\Check;
use \Gerardojbaez\PhpCheckup\Checks\Php\ExtensionIsLoaded;

$check = new Check('"mbstring" is loaded', new ExtensionIsLoaded('mbstring'));
```

Optionally customize the check's type, success, and fail message:

```php
$check->critical();
$check->passing('"mbstring" is loaded');
$check->failing('Please make sure "mbstring" is installed and enabled');
```

Finally, register your check with the check's manager:

```php
use \Gerardojbaez\PhpCheckup\Manager;

$checks = new Manager;
$checks->add($check);
```
