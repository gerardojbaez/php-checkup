# PHP Checkup

Framework agnostic application health and requirement checks.

## TL;DR

```php
use \Gerardojbaez\PhpCheckup\Checks\Php\ExtensionIsLoaded;
use \Gerardojbaez\PhpCheckup\Manager;

$checks = new Manager;

// Register checks
$checks->add((new ExtensionIsLoaded('mbstring'))->addGroup('requirements'));
$checks->add((new ExtensionIsLoaded('openssl'))->addGroup('requirements'));
$checks->add((new ExtensionIsLoaded('mailparse'))->addGroup('suggestions'));

// Run checks
$checks->passing();
$checks->group('requirements')->passing();
$checks->group('suggestions')->passing();
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

