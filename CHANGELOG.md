# Changelog

## [unreleased]

### Added

- Ability to set check dependencies.
- Class `Gerardojbaez\PhpCheckup\Status`
- Class `Gerardojbaez\PhpCheckup\RunResult`
- Class `Gerardojbaez\PhpCheckup\Runner`
- Method `Gerardojbaez\PhpCheckup\CheckResult::status`

### Changed

- `Gerardojbaez\PhpCheckup\Checks\Check` renamed to `Gerardojbaez\PhpCheckup\Check`.
- Parameter #3 of `Gerardojbaez\PhpCheckup\CheckResult::__construct` now accepts a `Gerardojbaez\PhpCheckup\Status` instance instead of a boolean.

### Removed

- Method `Gerardojbaez\PhpCheckup\Manager::isPassing`
- Method `Gerardojbaez\PhpCheckup\CheckResult::isPassing`
- Method `Gerardojbaez\PhpCheckup\CheckResult::isFailing`
- Method `Gerardojbaez\PhpCheckup\Manager::passing`

## [0.4.0] - 2020-07-26

### Added

- `Gerardojbaez\PhpCheckup\Checks\Filesystem\Readable`

## [0.3.0] - 2020-07-26

### Added

- `Gerardojbaez\PhpCheckup\Checks\Filesystem\Writable`

## [0.2.0] - 2020-05-25

### Changed

- The constructor of `Gerardojbaez\PhpCheckup\Checks\Php\MinimumMemory` now accepts a string value representing the current `memory_limit` value.

### Removed

- `Gerardojbaez\PhpCheckup\Contracts\Repositories\Php\Config\Repository`
- `Gerardojbaez\PhpCheckup\Repositories\Php\Config\Config`

## [0.1.0] - 2020-05-25

### Added

- Initial release
