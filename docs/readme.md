---
home: true
heroImage: /banner2.png
actionText: Getting started
actionLink: /getting-started/introduction.html
features:
- title: Easy to use
  details: Configure the checks that are the most relevant for your application and done.
- title: Flexible
  details: Use built-in checks or create your own. Add as many checks as you need, easily.
- title: Standalone
  details: Framework-agnostic; use it with any framework, or as a standalone package.
footer: MIT Licensed | Copyright © 2020 Gerardo J. Báez
---

## Quick start
```php
use \Gerardojbaez\PhpCheckup\Checks\Php\ExtensionIsLoaded;
use \Gerardojbaez\PhpCheckup\Manager;

$checks = new Manager;

// Register checks
$checks->add(
    (new Check('Required PHP extension "mbstring" is installed', new ExtensionIsLoaded('mbstring')))
        ->group('requirements')
        ->passing('The extension installed')
        ->failing('The extension is not installed. Please install or enable it before proceeding.')
        ->critical()
);

// Run checks
$checks->isPassing();
```


::: warning Development
This package is still under active development. The public API is not considered stable and is expected to change between releases.
:::
