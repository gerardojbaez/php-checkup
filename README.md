# PHP Checkup

Framework agnostic application health and requirement checks.

## TL;DR

```php
use \Gerardojbaez\PhpCheckup\Checks\Php\ExtensionIsLoaded;
use \Gerardojbaez\PhpCheckup\Checks\Php\MinimumMemory;
use \Gerardojbaez\PhpCheckup\Manager;
use Gerardojbaez\PhpCheckup\Contracts\Php\Config\Repository;

$checks = new Manager;

// Register checks
$checks->add(
    (new Check('Required PHP extension "mbstring" is installed', new ExtensionIsLoaded('mbstring')))
        ->group('requirements')
        ->passing('The extension installed')
        ->failing('The extension is not installed. Please install or enable it before proceeding.')
        ->critical()
);

$checks->add(
    (new Check('Recommended PHP extension "mailparse" is installed', new ExtensionIsLoaded('mailparse')))
        ->group('recommended')
        ->passing('The extension installed')
        ->failing('The extension is not installed, while it is not required, we recommend you to install or enable it for a proper inbound-email handling.')
        ->warning()
);

$checks->add(
    (new Check('50MB PHP\'s minimum memory limit', new MinimumMemory(1048576 * 50, new Repository)))
        ->group('recommended')
        ->passing('You are using :memory_limit')
        ->failing('Please set PHP\'s memory_limit to at least 50MB. For example memory_limit=50M. The current value is memory_limit=:memory_limit.')
        ->critical()
);

// Run checks
$checks->isPassing();
$checks->group('requirements')->isPassing();
$checks->group('suggestions')->isPassing();
```

## Why

When developing self-hosted applications, it is common to provide users with a check-list of things that they must complete before installing an application on their servers. Or, you give them an easy way to view a global picture of how the application and server are performing at any given time — improving error debugging and communication with developers. PhpCheckup gives developers a quick and easy way to build such check-lists as a stand-alone package or directly integrated into their applications.

## Use cases
- Application pre-installation checks
    - For example, to make sure that the server meets all the minimum requirements
- Application post-installation checks
    - For example, make sure that the front-page and API are returning 200 status code, and
    - oAuth server is properly configured, and
    - Installer is disabled
- Application post-update checks
- A webpage inside an administrative system showing all the health checks of the application.
- A stand-alone package so users can check whether their server meet a minimum set of requirements for a particular application, before purchasing.
- Application performance check-list and suggestions.
- Perform environment-specific checks

## Example health checks
- URL HTTP Status
- Database connection
- Database type
- Database version
- PHP version
- PHP installed extensions
- PHP memory limit
- PHP INI settings (more commonly used for suggestions and security checks)
- Queue status
- Last cronjob executed (maybe show a warning when last cronjob is older than a specified date)
- Writable directory or file
- Expected directory structure
- Presence/absence of a file or directory
- Payment gateway connection
- Email service connection
- Make sure private files like .env aren’t accessible publicly
- Warn about debug flag on a production environment
- SSL Check
- Warn about permissive file-permissions

## Health check results export options

**Built-in export options**

- JSON
- PHP Array

**Plugin/extension based export options**

- JSON
- PDF
- Plain text
- HTML

## Health check output options
- Console

