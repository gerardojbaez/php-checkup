# PHP Checkup

Framework agnostic application health and requirement checks.

## TL;DR

```php
use \Gerardojbaez\PhpCheckup\Checks\PhpExtensionIsLoaded;
use \Gerardojbaez\PhpCheckup\Manager;

$checks = new Manager;

// Register checks
$checks->add((new PhpExtensionIsLoaded('mbstring'))->addGroup('requirements'));
$checks->add((new PhpExtensionIsLoaded('openssl'))->addGroup('requirements'));
$checks->add((new PhpExtensionIsLoaded('mailparse'))->addGroup('suggestions'));

// Run checks
$checks->passing();
$checks->group('requirements')->passing();
$checks->group('suggestions')->passing();
```

## Why

I needed a way to determine whether an environment meets all the minimum requirements to run an application. For example, does the server has all the required PHP extensions? Is PHP’s memory limit enough? Is the storage directory writable? — Many things need to be checked to ensure an application will run as expected. In addition to checking requirements, I also wanted to perform post-installation and post-update checks and ensure that the application is properly installed or upgraded and that the main components are working as expected.

## Use cases
- App pre-installation checks
    - For example, to make sure that the server meets all the minimum requirements
- App post-installation checks
    - For example, make sure that the front-page and API are returning 200 status code, and
    - oAuth server is properly configured, and
    - Installer is disabled
- App post-update checks
    - For example, perform same checks mentioned in pre-installation and post-installation, so we can make sure that the app still meets the minimum requirements, the main components of the application are still working, and
    - Queue server is running
- A webpage inside an administrative system showing all the health checks of the application.
- Performance suggestions
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

## Health checks details
- Title (based on status, or static)
- Message (details about the result, may contain markdown links, optional)
- Tags (e.g., Security, Performance, etc)
- Groups (e.g., Pre-Install, Post-Install, etc)
- Is passing (boolean)

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

